<?php

namespace Drupal\katy_ai\Controller;

use Drupal\katy_ai\Entity\Katy_Knowledge;
use Drupal\katy_ai\Helper\ExternalCalls;

class KatyController
{

  public function __construct(){}

	public function processText($message, $userOptions) {
      $messageResponse = '';
      $Katy = new Katy_Knowledge();
      // Get the regex check going.
      $match = null;
      foreach($Katy->messages as $key => $action) {
        $reg = $action['regex'];
        preg_match('/' . $reg . '/i', $message, $matches);
        if(count($matches) > 0) {
          $match = $action;
          break;
        }
      }

      if (!is_null($match)) {
        // Process the message.
        $messageResponse = $match['response'];
        $options = json_decode($match['options'], TRUE);
        if(!empty($options['params'])) {
          foreach($options['params'] as $key => $v) {
            $messageResponse = str_replace($key, $v, $messageResponse);
          }
        }
        if(!empty($options['function'])) {
          // Run the function.
          switch($options['function']) {
            case 'getWeather' :
              // get the location from the message.
              $location = $matches[2];
              $params = [
                '{{ weatherReport }}' => ExternalCalls::getWeather($location),
                '{{ location }}' => $location,
              ];
              break;
            default:
              break;
          }
          foreach($params as $key => $v) {
            $messageResponse = str_replace($key, $v, $messageResponse);
          }
        }
        // Replace static mark ups.
        $messageResponse = str_replace('{{ author }}', $userOptions['author'], $messageResponse);
        $messageResponse = str_replace('{{ time }}', date('h:i A'), $messageResponse);
        $messageResponse = str_replace('{{ date }}', date('F j, Y h:i A'), $messageResponse);
      }
      else {
        $messageResponse = 'I\'m sorry, I could not process that request.';
      }
      return $messageResponse;
	}
}
