<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/1/17
 * Time: 9:04 AM
 */

namespace Drupal\gameengine\Entity;

use Drupal\user\Entity\User;

class Player
{
	private $name;
	private $classType;
	private $health;
	private $attack;
	private $defense;
	
	public function __construct(User $user)
	{
		$this->name = $user->field_charactername->value;
		$this->classType = $user->field_class->value;
		$this->health = $user->field_health->value;
		$this->attack = $user->field_attack->value;
		$this->defense = $user->field_defense->value;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getClass(){
		return $this->classType;
	}
	
	public function getHealth(){
		return $this->health;
	}
	
	public function getAttack() {
		return $this->attack;
	}
	
	public function getDefense() {
		return $this->defense;
	}
}