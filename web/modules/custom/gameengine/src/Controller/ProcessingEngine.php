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

class ProcessingEngine extends ControllerBase
{
	public function processText(Request $request) {
		if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
			$data = json_decode($request->getContent(), TRUE);
			
			$action = $data['action'];
			$target = $data['target'];
			
			$user = User::load(\Drupal::currentUser()->id());
			
			switch(strtolower($action)){
				case 'hello':
					$response['message'] = 'Hello, ' . $user->field_charactername->value . '!';
					break;
				case 'look':
					$response['message'] = 'You look around into the void, and see nothing.';
					break;
				default:
					$response['message'] = $action . ' is not a valid action.';
					break;
			}
			return new JsonResponse($response);
		} else {
			$response['message'] = 'Invalid action.';
			$response['errorMessage'] = 'Not Valid JSON';
			return new JsonResponse($response);
		}
	}
}