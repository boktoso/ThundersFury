<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/1/17
 * Time: 9:24 AM
 */

namespace Drupal\game\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\HtmlResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Login extends ControllerBase
{
	function content()
	{
		$build = array(
			'#cache' => ['max-age' => 0],
			'#theme' => 'login_page',
			'#tabs' => array()
		);
		
		$build['#attached']['library'][] = 'atlas/game-login';
		
		return $build;
	}
	
	function loginAction()
	{
		return true;
	}
	
	function getTitle()
	{
		return "Thunder's Fury";
	}
}