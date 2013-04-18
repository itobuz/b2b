<?php

class Weather extends CApplicationComponent {

    static function getWeather($link) {
        $location = $_SERVER['REMOTE_ADDR']; //'223.223.149.138'
        $default_location = 'delhi'; // useful when there isn't any result
        //
        if (isset($_POST['location'])) {
            if (!empty($_POST['location'])) {
                $cookie_location = (string) $_POST['location'];
                Yii::app()->request->cookies['weather_location'] = new CHttpCookie('weather_location', $cookie_location);
                Yii::app()->request->redirect('/site/index');
            }
        }
        if (!isset(Yii::app()->request->cookies['weather_location'])) {
            $city_name_api_url = "http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip={$location}";
            $response_city = Weather::getCurl($city_name_api_url);
            $response_array = Weather::csv_decode($response_city, ";");
            $location = isset($response_array[0][6]) ? (!empty($response_array[0][6]) ? strtolower($response_array[0][6]) : $default_location ) : $default_location;
        } else {
            if (!empty(Yii::app()->request->cookies['weather_location'])) {
                $location = Yii::app()->request->cookies['weather_location'];
            } else {
                $city_name_api_url = "http://api.ipinfodb.com/v3/ip-city/?key=20b96dca8b9a5d37b0355e9461c66e76eed30a2274422fa6213d9de6ffb2b34e&ip={$location}";
                $response_city = Weather::getCurl($city_name_api_url);
                $response_array = Weather::csv_decode($response_city, ";");
                $location = isset($response_array[0][6]) ? (!empty($response_array[0][6]) ? strtolower($response_array[0][6]) : $default_location ) : $default_location;
            }
        }

        $api_url = "http://free.worldweatheronline.com/feed/weather.ashx?format=json&num_of_days=1&key=abd4a15407135412130802&q={$location}";
        $server_output = Weather::getCurl($api_url);
        $weather_array = json_decode($server_output, true);

        if (isset($weather_array['data']['error'])) {
            $location = $default_location;
            $api_url = "http://free.worldweatheronline.com/feed/weather.ashx?format=json&num_of_days=1&key=abd4a15407135412130802&q={$location}";
            $server_output = Weather::getCurl($api_url);
            $weather_array = json_decode($server_output, true);
        }
        if (isset($weather_array['data']['error'])) {
            return false; // must be some other errors like api usage limit etc. In that case stop the processing
        }

        $current_condition = $weather_array['data']['current_condition'][0];
        $forecast = $weather_array['data']['weather'][0];
        $location = $weather_array['data']['request'][0]['query'];
        $icon = $current_condition['weatherIconUrl'][0]['value'];
        $condition_phrase = $current_condition['weatherDesc'][0]['value'];
        $current_temperature = $current_condition['temp_C'];
        $max_temperature = $forecast['tempMaxC'];
        $min_temperature = $forecast['tempMinC'];
        $wind_speed = $current_condition['windspeedKmph'];
//        echo "<pre>";
//        print_r($forecast);
//        print_r($current_condition);
//        echo "</pre>";
        ?>
        <h2> Weather Report</h2>
        <div class="summary">&nbsp;</div>
        <?php
        $link->beginWidget('zii.widgets.CPortlet', array(
            'title' => "<img src='{$icon}' height='32' width='32'/> Location: {$location}",
        ));
        ?>
        <div>
            Current weather condition is : <b><i><?= $condition_phrase ?></i></b><br>
            Current temperature is :<b><i><?= $current_temperature ?>&deg;C</i></b><br>
            Current Wind Speed:  <b><i><?= $wind_speed ?> KM/hour</i></b><br>
            Max/Min temperature Forecast : <b><i><?= $max_temperature ?>&deg;C / <?= $min_temperature ?>&deg;C</i></b><br>
            <br>


        </div>
        <?php $link->endWidget(); ?>
        <?
    }

    static function getCurl($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    static function csv_decode($string, $delimiter = ',') {
        $csv_array = null;
        if (is_string($string)) {

            if ($string == "" || $string == null) {
                return NULL;
            }

            $string = preg_replace('~\r[\n]?~', "_", $string);
            $rows = explode("_", $string);
            $cols = Array();

            $c = 0;
            foreach ($rows as $columns) {
                $cols[$c] = explode($delimiter, $columns);
                $c++;
            }
            $csv_array = $cols;
        } else
            return false;
        return $csv_array;
    }

}