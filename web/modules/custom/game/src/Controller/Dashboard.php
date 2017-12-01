<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 11/30/17
 * Time: 1:13 PM
 */


namespace Drupal\game\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\HtmlResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Dashboard extends ControllerBase
{
	public function content(){
		$build = array(
			'#cache' => ['max-age' => 0],
			'#theme' => 'dashboard_page',
			'#tabs' => array()
		);
		
		$build['#attached']['library'][] = 'atlas/game-dashboard';
		
		return $build;
	}
}