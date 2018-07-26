<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 8:17 AM
 */

namespace Drupal\gameengine\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\class_engine\Entity\Player;
use Drupal\class_engine\Entity\Classes;
use Drupal\gameengine\Plugin\Content\Item;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProcessingEngine extends ControllerBase
{
	public function processText(Request $request) {
		if (0 === strpos($request->headers->get('Content-Type'),
				'application/json')) {
			$data = json_decode($request->getContent(), TRUE);
      $conn = \Drupal::database();
      $user = User::load(\Drupal::currentUser()->id());

			$message = $data['msgData'];
			$target = $data['action'];
			$author = $user->field_display_name->value;
			$userIp = getClientIp();
			// Write message to the database.
			try {
				$result = $conn->insert('chatlog')
	        ->fields([
	          'author' => $author,
	          'message' => $message['message'],
	          'target' => $target,
						'ip_address' => $userIp,
	        ])
	        ->execute();
	      // Return the message and its count so we can keep track of last messages.
				$testMsg = [
					'message' => [
						"message" => $message['message'],
						"author" => $author,
						"date" => date('c', strtotime($record->timestamp))
					],
	        'lastIndex' => $result
				];
			}
			catch (PDOException $e) {
				$conn->rollback();
				return new JsonResponse(["errorMsg" => "Error sending message."], 400);
			}

			return new JsonResponse($testMsg);
		}
		return new JsonResponse(["errorMsg" => "No Data"], 400);
	}

	public function getLast100Messages() {

		$messageArray = [];

		$conn = \Drupal::database();
    $results = $conn->query(
			'SELECT id, author, message, timestamp FROM chatlog WHERE target = :target ORDER BY id DESC LIMIT 100',
			[
				":target" => "generalmessage",
			]
		);
		$lastIndex = 0;
		foreach($results as $record) {
			$newRecord = [
				"id" => $record->id,
				"author" => $record->author,
				"message" => $record->message,
				"date" => date('c', strtotime($record->timestamp))
			];
			$messageArray[] = $newRecord;
			$lastIndex = ($lastIndex < $record->id ? $record->id : $lastIndex);
		}
		// sort message array by id.
		usort($messageArray, function($a, $b) {
			if ($a['id'] === $b['id']){
				return 0;
			}
			return ($a['id'] > $b['id'] ? 1 : -1);
		});

		return new JsonResponse([
			"lastIndex" => $lastIndex,
			"messages" => $messageArray,
		]);
	}

	public function retrieveMessages($lastIndex) {
		$messageArray = [];
		$lastIndexNew = $lastIndex;
		$conn = \Drupal::database();
    $results = $conn->query(
			'SELECT id, author, message, timestamp FROM chatlog WHERE target = :target AND id > :lastIndex ORDER BY timestamp ASC',
			[
				":target" => "generalmessage",
				":lastIndex" => $lastIndex,
			]
		);

		foreach($results as $record) {
			$messageArray[] = $record;
			$lastIndexNew = ($lastIndexNew < $record->id ? $record->id : $lastIndexNew);
		}

		return new JsonResponse([
			'lastIndex' => $lastIndexNew,
			'messages' => $messageArray,
		]);
	}
}
