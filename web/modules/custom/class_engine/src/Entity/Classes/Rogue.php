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

// Base Attack and multipliers
const BASE_ATTACK = 3;
const ATTACK_MODIFIER_MULTIPLIER = 1.5;

// Base Defense and multipliers
const BASE_DEFENSE = 1;
const DEFENSE_MODIFIER_MULTIPLIER = 1.5;

class Rogue extends Player
{

	public function __construct(User $user)
	{
		parent::__construct($user);
	}

	/**
	 * Get the attack power of the player.
	 *
	 * @return string
	 *   Attack power of the player.
	 */
	public function getAttack(){
		$attack = BASE_ATTACK
			+ ($this->getDexterity() * ATTACK_MODIFIER_MULTIPLIER);

		return $attack;
	}
	
	/**
	 * Get the defense of the player.
	 *
	 * @return string
	 *   Defense power of the character.
	 */
	public function getDefense() {
		$defense = BASE_DEFENSE
			+ ($this->getDexterity() * DEFENSE_MODIFIER_MULTIPLIER);
		
		return $defense;
	}
}
