<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 1:09 PM
 */

namespace Drupal\class_engine\Entity\Classes;

use Drupal\class_engine\Entity\Player;
use Drupal\user\Entity\User;

class Warrior extends Player
{
	public function __construct(User $user)
	{
		parent::__construct($user);
	}
}
