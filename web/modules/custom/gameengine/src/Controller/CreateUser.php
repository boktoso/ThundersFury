<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 1:07 PM
 */

namespace Drupal\gameengine\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\class_engine\Entity\Player;
use Drupal\gameengine\Plugin\Content\Item;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CreateUser extends ControllerBase
{
	public function content(){
		if (\Drupal::currentUser()->isAnonymous() == false) {
			// Not Anonymous user...
			$response = new RedirectResponse('/');
			$response->send();
			return true;
		}

		$build = array(
			'#cache' => ['max-age' => 0],
			'#theme' => 'create_user_page',
			'#attached' => array(
				'library' => array(
					'atlas/gameengine-create-user'
				)
			)
		);		
		return $build;
	}

	public function checkIfUsernameAvailable($username) {
		$response = array(
			'available' => false
		);

		$user = user_load_by_name($username);

		if(!$user){
			$response['available'] = true;
		} else {
			$response['available'] = false;
		}

		return new JsonResponse($response);
	}

	public function checkIfEmailAvailable($email){
		$response = array(
			'available' => false
		);

		$user = user_load_by_mail($email);

		if(!$user){
			$response['available'] = true;
		} else {
			$response['available'] = false;
		}

		return new JsonResponse($response);
	}
}
