<?php

class ScrapperController extends Controller {

    public $layout = '//layouts/blank';

    public function filters() {
        return array(
            'rights',
        );
    }

    public function actionIndex() {
        $start = microtime();
        if (ob_get_level() == 0) {
            ob_start();
        }

        echo str_pad(' ', 4096) . "<br />\n";
        $ncdex_futures = "http://www.ncdex.com/MarketData/LiveFuturesQuotes.aspx";
        $ncdex_spot = "http://www.ncdex.com/MarketData/LiveSpotQuotes.aspx";
        print "Starting Scrapper...<br />\n";
        flush();
        ob_flush();
        $spot_prices = $this->scrapSpot($ncdex_spot);
        print "Spot prices scrapped. Updating database...<br />\n";
        flush();
        ob_flush();
        if (!empty($spot_prices)) {
            Yii::app()->db->createCommand('TRUNCATE TABLE livespot')->execute();
            foreach ($spot_prices as $value) {
                $model = new Livespot();
                $model->attributes = $value;
                $model->save();
                unset($model);
            }
        }
        print "Spot prices updated. Starting Future prices scrapper...<br />\n";
        flush();
        ob_flush();

        $future_prices = $this->scrapFuture($ncdex_futures);
        print "Future prices scrapped. Updating database...<br />\n";
        flush();
        ob_flush();
        if (!empty($future_prices)) {
            Yii::app()->db->createCommand('TRUNCATE TABLE livefuture')->execute();
            foreach ($future_prices as $value) {
                $model = new Livefuture();
                $model->attributes = $value;
                $model->save() or die("error!!");
                unset($model);
            }
        }

        $news = $this->scrapNews();
        print "news scrapped. Updating database...<br />\n";
        flush();
        ob_flush();
        if (!empty($news)) {
            Yii::app()->db->createCommand('TRUNCATE TABLE news')->execute();
            foreach ($news as $value) {
                $model = new News();

                $model->attributes = $value;
                @$model->save();
                unset($model);
            }
        }
        ob_end_flush();

        print "All records have been updated... exiting cron script....<br>\n";
    }

    protected function scrapNews() {
        $feed_url = 'http://brazil-trade-business.blogspot.com/feeds/posts/default';
        $results = (array) simplexml_load_file($feed_url);
        $return = array();
        $i = 0;
        foreach ($results['entry'] as $result) {

            $titlearray = NULL;
            $titlearray = (array) $result->title;

            $return[$i]['title'] = str_replace('\'', '', @$titlearray['0']);
            $linkarray = NULL;
            $linkarray = (array) $result->link[4];
            $return[$i]['link'] = $linkarray['@attributes']['href'];
            $return[$i]['content'] = "";
            $i++;
        }
        return $return;
    }

    protected function scrapSpot($url) {
        set_time_limit(0);
        if (empty($url))
            return FALSE;
        $current_time = date('Y-m-d h:i:s');
        Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');
        $simpleHTML = new SimpleHTMLDOM;
        $html = $simpleHTML->file_get_html($url);
        $spot = array();
        $i = 0;
        foreach ($html->find('#ctl00_ContentPlaceHolder3_gvSpotQuotes tbody tr') as $element) {
            if (is_object($element)) {

                $spot[$i]['symbol'] = trim($element->find('td', 1)->plaintext);
                $spot[$i]['location'] = City::model()->getIdByName(trim($element->find('td', 3)->plaintext));
                $spot[$i]['timeOfPolling'] = $this->convertTimeStamp(trim($element->find('td', 4)->plaintext));
                $spot[$i]['price'] = trim($element->find('td', 5)->plaintext);
            }
            $i++;
        }
        return $spot;
    }

    protected function scrapFuture($url) {
        set_time_limit(0);
        if (empty($url))
            return FALSE;
        $current_time = date('Y-m-d h:i:s');
        Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');
        $simpleHTML = new SimpleHTMLDOM;
        $html = $simpleHTML->file_get_html($url);
        $future = array();
        $i = 0;
        foreach ($html->find('#ctl00_ContentPlaceHolder3_dgLiveFuturesQuotes tbody tr') as $element) {
            if (is_object($element) && !empty($element)) {
                if (is_object($element->find('td', 0)))
                    $future[$i]['productName'] = trim($element->find('td', 0)->plaintext);
                if (is_object($element->find('td', 1)))
                    $future[$i]['expiryDate'] = date('Y-m-d', strtotime(trim($element->find('td', 1)->plaintext)));
                if (is_object($element->find('td', 2)))
                    $future[$i]['open'] = trim($element->find('td', 2)->plaintext);
                if (is_object($element->find('td', 3)))
                    $future[$i]['high'] = trim($element->find('td', 3)->plaintext);
                if (is_object($element->find('td', 4)))
                    $future[$i]['low'] = trim($element->find('td', 4)->plaintext);
                if (is_object($element->find('td', 5)))
                    $future[$i]['close'] = trim($element->find('td', 5)->plaintext);
                if (is_object($element->find('td', 6)))
                    $future[$i]['lastTradedPrice'] = trim($element->find('td', 6)->plaintext);
                if (is_object($element->find('td', 7)))
                    $future[$i]['change'] = (float) trim($element->find('td', 7)->plaintext);
                if (is_object($element->find('td', 8)))
                    $future[$i]['changePercentage'] = (float) trim($element->find('td', 8)->plaintext);
                if (is_object($element->find('td', 9)))
                    $future[$i]['AverageTradePrice'] = trim($element->find('td', 9)->plaintext);
                if (is_object($element->find('td', 10)))
                    $future[$i]['spotPrice'] = trim($element->find('td', 10)->plaintext);
                if (is_object($element->find('td', 11)))
                    $future[$i]['bestBuy'] = trim($element->find('td', 11)->plaintext);
                if (is_object($element->find('td', 12)))
                    $future[$i]['bestSell'] = trim($element->find('td', 12)->plaintext);
                if (is_object($element->find('td', 12)))
                    $future[$i]['openInterest'] = trim($element->find('td', 13)->plaintext);
            }
            $i++;
        }
        //echo "<pre>"; print_r($future);
        return $future;
    }

    protected function convertTimeStamp($stamp) {
        return date('Y-m-d h:i:s', strtotime(str_replace('-', '', $stamp)));
    }

}
