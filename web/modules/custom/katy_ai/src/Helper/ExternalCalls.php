<?php

namespace Drupal\katy_ai\Helper;

use \GuzzleHttp\Client;

class ExternalCalls {

  const WEATHER_API_KEY = '917efa7918624f985f2d1232880fbae0';

  public static function getWeather($location, $countryCode = 'us'){
    $client = new Client();
    $res = $client->get('https://api.openweathermap.org/data/2.5/weather?units=imperial&q=' . $location . ',' . $countryCode . '&appid=' . self::WEATHER_API_KEY);

    $response = $res->getBody();
    $response = json_decode($response, TRUE);
    $weather = $response['weather'][0];
    $main = $response['main'];
    $message = $main['temp'] . '&deg;F with a low of ' . $main['temp_min'] . '&deg;F and a high of ' . $main['temp_max'] . '&deg;F with ' . $weather['description'] . '.';

    return $message;
  }

}
