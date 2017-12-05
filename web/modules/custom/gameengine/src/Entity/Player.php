<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/1/17
 * Time: 9:04 AM
 */

namespace Drupal\gameengine\Entity;

class Player
{
	private $name;
	private $classType;
	private $health;
	private $attack;
	private $defense;
	
	public function __construct($user)
	{
		$this->name = $user['name'];
		$this->classType = $user['class'];
		$this->health = $user['maxhealth'];
		$this->attack = $user['attack'];
		$this->defense = $user['defense'];
	}
}