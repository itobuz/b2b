<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>


<div class="row-fluid">
    <div class="span9">
        <h2> Latest 10 Listings</h2>
        <?php
        $sugarUrl = Yii::app()->createUrl('/site/loadListingGrid/datatype/sugar');
        $riceUrl = Yii::app()->createUrl('/site/loadListingGrid/datatype/rice');
        $goldUrl = Yii::app()->createUrl('/site/loadListingGrid/datatype/gold');
        $silverUrl = Yii::app()->createUrl('/site/loadListingGrid/datatype/silver');

        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs' => array(
                'Sugar' => array('ajax' => $sugarUrl , 'id' => 'tab1'),
                'Rice' => array('ajax' => $riceUrl, 'id' => 'tab2'),
                'Gold' => array('id' => 'tab3' , 'ajax' => $goldUrl),
                'Silver' => array('ajax' => $silverUrl, 'id' => 'tab4'),
            ),
            // additional javascript options for the tabs plugin
            'options' => array(
                'collapsible' => true,
            ),
            'id' => 'categorytabs',
        ));
        ?>

    </div>
    <div class="span3">
        <? Weather::getWeather($this); ?>

    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <h2> Latest News</h2>
        <?php
        Yii::import('application.controllers.PriceindexController');
        $this->widget('zii.widgets.grid.CGridView', array(
            /* 'type'=>'striped bordered condensed', */
            'htmlOptions' => array('class' => 'table'),
            'dataProvider' => $newsDataProvider,
            'columns' => array(
                    array('type' => 'raw', 'header' => 'Title', 'value' => 'rawurldecode($data->title)'),
                  array('type' => 'raw', 'header' => 'Link', 'value' => '"<a href=\'".$data->link."\'>Visit site</a>"'),
              
            ),
        ));

//        $this->widget('BootPager', array(
//            'currentPage' => $pages->getCurrentPage(),
//            'pages' => $pages,
//        ));
        ?>
    </div>


</div>


<div class="row-fluid">
    <div class="span12">
        <h2> NCDEX Live Spot Quotes</h2>
        <?php
        Yii::import('application.controllers.PriceindexController');
        $this->widget('zii.widgets.grid.CGridView', array(
            /* 'type'=>'striped bordered condensed', */
            'htmlOptions' => array('class' => 'table'),
            'dataProvider' => $liveSpotDataProvider,
            'columns' => array(
              //  array('name' => 'id', 'header' => '#', 'sortable' => 'true'),
                array('name' => 'symbol', 'header' => 'Commodity Name', 'sortable' => 'true'),
                array('name' => 'price', 'header' => 'Price', 'sortable' => 'true'),
               // array('name' => 'timeOfPolling', 'header' => 'Time of polling', 'sortable' => 'true'),
                array('type' => 'raw', 'header' => 'Location', 'sortable' => 'true', 'value' => 'ucfirst(City::model()->getNameById($data->location))'),
            ),
        ));

//        $this->widget('BootPager', array(
//            'currentPage' => $pages->getCurrentPage(),
//            'pages' => $pages,
//        ));
        ?>
    </div>


</div>
<div class="row-fluid">
    <div class="span12">
        <h2> NCDEX Live Future Quotes</h2>
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            /* 'type'=>'striped bordered condensed', */
            'htmlOptions' => array('class' => 'table'),
            'dataProvider' => $liveFutureDataProvider,
            'columns' => array(

                array('name' => 'productName', 'header' => 'Commodity Name', 'sortable' => 'true'),
                array('name' => 'expiryDate', 'header' => 'Expiry Date', 'sortable' => 'true'),
              //  array('name' => 'high', 'header' => 'High', 'sortable' => 'true'),
//                array('name' => 'low', 'header' => 'Low', 'sortable' => 'true'),
//                array('name' => 'close', 'header' => 'Close', 'sortable' => 'true'),
//                array('name' => 'lastTradedPrice', 'header' => 'Last Traded Price', 'sortable' => 'true'),
                  array('name' => 'spotPrice', 'header' => 'Spot Price', 'sortable' => 'true'),
                array('name' => 'change', 'header' => 'Change', 'sortable' => 'true'),
//                array('name' => 'changePercentage', 'header' => '% change', 'sortable' => 'true'),
//                array('name' => 'AverageTradePrice', 'header' => 'Average Trade Price', 'sortable' => 'true'),
//              
//                array('name' => 'bestBuy', 'header' => 'Best Buy', 'sortable' => 'true'),
//                array('name' => 'bestSell', 'header' => 'Best Sell', 'sortable' => 'true'),
//                array('name' => 'openInterest', 'header' => 'Open Interest', 'sortable' => 'true'),
//                array('name' => 'close', 'header' => 'Close', 'sortable' => 'true'),
            ),
        ));

//        $this->widget('BootPager', array(
//            'currentPage' => $pages->getCurrentPage(),
//            'pages' => $pages,
//        ));
        ?>
    </div>


</div>
