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
use Drupal\gameengine\Entity\Player;

class ProcessingEngine extends ControllerBase
{
	 private $directions = array(
		'up',
		'down',
		'left',
		'right',
		'north',
		'south',
		'east',
		'west'
	);
	
	public function processText(Request $request) {
		if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
			$data = json_decode($request->getContent(), TRUE);
			
			$action = $data['action'];
			$target = $data['target'];
			
			$user = User::load(\Drupal::currentUser()->id());
			
			$player = new Player($user);
			
			switch(strtolower($action)){
				case 'help':
					$string = "Available Commands: <br />" .
								"help <br />" .
								"hello <br />" .
								"look <br />" .
								"move/go {" . implode(", ", $this->directions) . "} <br />";
					
					$response['message'] = $string;
					break;
				case 'hello':
					$response['message'] = 'Hello, ' . $user->field_charactername->value . '!';
					break;
				case 'look':
					$response['message'] = 'You look around into the void, and see nothing.';
					break;
				case 'move':
				case 'go':
					if(in_array($target, $this->directions)){
						$response['message'] = "You $action $target.";
					} else {
						$response['message'] = "Invalid direction.";
					}
					break;
				case 'status':
					$string = "Status:<br />";
					$string .= "Health: <br />";
					$string .= "Attack: <br />";
					$string .= "Defense: <br />";
					break;
				case 'itsrainingmen':
					$response['message'] = 'Hallelujah!';
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