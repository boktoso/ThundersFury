<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 8:05 AM
 */

namespace Drupal\class_engine\Entity\Classes;

use Drupal\class_engine\Entity\Player;
use Drupal\user\Entity\User;

class Paladin extends Player
{
	public function __construct(User $user)
	{
		parent::__construct($user);
	}
}
