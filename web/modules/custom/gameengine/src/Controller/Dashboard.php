<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 11/30/17
 * Time: 1:13 PM
 */

namespace Drupal\gameengine\Controller;

use Drupal\Core\Controller\ControllerBase;

class Dashboard extends ControllerBase
{
	public function content() {
		$build = array(
			'#cache' => ['max-age' => 0],
			'#theme' => 'dashboard_page',
			'#test' => time(),
			'#attached' => array(
				'library' => array(
					'atlas/gameengine-dashboard'
				)
			)
		);
		
		return $build;
	}
}