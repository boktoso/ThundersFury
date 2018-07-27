<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 8:07 AM
 */

namespace Drupal\class_engine\Entity\Classes;

use Drupal\class_engine\Entity\Player;
use Drupal\user\Entity\User;

class Archer extends Player
{
	public function __construct(User $user)
	{
		parent::__construct($user);
	}
}
