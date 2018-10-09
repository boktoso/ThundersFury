<?php

namespace Drupal\katy_ai\Entity;

class Katy_Knowledge {

  public $messages;

  public function __construct(){
    $this->messages = [
      [
        'regex' => '((Hello|Hi) Katy){1}',
        'triggerText' => 'hello',
        'response' => 'Hello %1, how can I help you today?',
        'options' => '{"params":{"%1":"{{ author }}"}}',
        'helper' => 'This is just a simple hello.',
      ],
      [
        'regex' => '(what day is it|what is the date|what is today|tell me the date){1}',
        'triggerText' => 'date',
        'response' => 'The date is %1',
        'options' => '{"params":{"%1":"{{ date }}"}}',
        'helper' => 'This retuns the current date and time.',
      ],
      [
        'regex' => '(what time is it|what is the time|what is the current time|tell me the time){1}',
        'triggerText' => 'time',
        'response' => 'The time is %1',
        'options' => '{"params":{"%1":"{{ time }}"}}',
        'helper' => 'This retuns the current time.',
      ],
      [
        'regex' => '(what is the weather for ){1}([a-zA-Z0-9\,\s]*)',
        'triggerText' => 'weather',
        'response' => 'The weather for %1 is %2',
        'options' => '{"params":{"%1":"{{ location }}","%2":"{{ weatherReport }}"}, "function":"getWeather"}',
        'helper' => 'This returns the weather for a location.  Should be used as "Katy, what is the weather for LOCATION"',
      ],
    ];
    // $this->conn = \Drupal::database();
    // $results = $this->conn->query('SELECT uid, regex, trigger, response, options, helper FROM katy_ai_messages');
    //
    // foreach($results as $record) {
		// 	$this->messages[] = $record;
		// }
  }
}
