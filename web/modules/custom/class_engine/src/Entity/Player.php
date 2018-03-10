<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/1/17
 * Time: 9:04 AM
 */

namespace Drupal\class_engine\Entity;

use Drupal\gameengine\Controller\Inventory;
use Drupal\user\Entity\User;

class Player
{
	private $userID;
	private $name;
	private $classType;
	private $level;
	
	private $health;
	private $attack;
	private $defense;

	private $strength;
	private $constitution;
	private $dexterity;
	private $charisma;
	private $intelligence;
	private $wisdom;

	private $experience;
	private $currency;

	/**
	 * @var array
	 */
	private $inventory;

	public function __construct(User $user)
	{
		$this->name = $user->field_charactername->value;
		$this->classType = $user->field_class->value;
		$this->level = $user->field_character_level->value;
		$this->userID = $user->id();
		$this->inventory = Inventory::getInventory($this->userID);

		$this->strength = $user->field_character_strength->value;
		$this->constitution = $user->field_character_constitution->value;
		$this->dexterity = $user->field_character_dexterity->value;
		$this->charisma = $user->field_character_charisma->value;
		$this->intelligence = $user->field_character_intelligence->value;
		$this->wisdom = $user->field_character_wisdom->value;
		$this->currency = $user->field_currency->value;
		$this->$experience = $user->field_character_experience->value;
	}

	//<editor-fold desc="Getters and Setters">

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getClassType() {
		return $this->classType;
	}

	/**
	 * @param mixed $classType
	 */
	public function setClassType($classType) {
		$this->classType = $classType;
	}

	/**
	 * @return mixed
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param mixed $level
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * @return mixed
	 */
	public function getHealth() {
		return $this->health;
	}

	/**
	 * @param mixed $health
	 */
	public function setHealth($health) {
		$this->health = $health;
	}

	/**
	 * @return mixed
	 */
	public function getAttack() {
		return $this->attack;
	}

	/**
	 * @param mixed $attack
	 */
	public function setAttack($attack) {
		$this->attack = $attack;
	}

	/**
	 * @return mixed
	 */
	public function getDefense() {
		return $this->defense;
	}

	/**
	 * @param mixed $defense
	 */
	public function setDefense($defense) {
		$this->defense = $defense;
	}

	/**
	 * @return mixed
	 */
	public function getStrength() {
		return $this->strength;
	}

	/**
	 * @param mixed $strength
	 */
	public function setStrength($strength) {
		$this->strength = $strength;
	}

	/**
	 * @return mixed
	 */
	public function getConstitution() {
		return $this->constitution;
	}

	/**
	 * @param mixed $constitution
	 */
	public function setConstitution($constitution) {
		$this->constitution = $constitution;
	}

	/**
	 * @return mixed
	 */
	public function getDexterity() {
		return $this->dexterity;
	}

	/**
	 * @param mixed $dexterity
	 */
	public function setDexterity($dexterity) {
		$this->dexterity = $dexterity;
	}

	/**
	 * @return mixed
	 */
	public function getCharisma() {
		return $this->charisma;
	}

	/**
	 * @param mixed $charisma
	 */
	public function setCharisma($charisma) {
		$this->charisma = $charisma;
	}

	/**
	 * @return mixed
	 */
	public function getIntelligence() {
		return $this->intelligence;
	}

	/**
	 * @param mixed $intelligence
	 */
	public function setIntelligence($intelligence) {
		$this->intelligence = $intelligence;
	}

	/**
	 * @return mixed
	 */
	public function getWisdom() {
		return $this->wisdom;
	}

	/**
	 * @param mixed $wisdom
	 */
	public function setWisdom($wisdom) {
		$this->wisdom = $wisdom;
	}

	/**
	 * @return array
	 */
	public function getInventory() {
		return $this->inventory;
	}

	/**
	 * @param array $inventory
	 */
	public function setInventory($inventory) {
		$this->inventory = $inventory;
	}

 /**
 	* @return array
 	*/
	public function getExperience() {
		return $this->$experience;
	}

 /**
  * Add to the character's experience.
	*
	* @param integer $exp
	*/
	public function addToExperience($exp) {
		// Make sure that the experience is a positive value.
		if($exp > 0) {
			$this->$experience += $exp;
		}
	}


	//</editor-fold>

	/**
	 * Have player take damage
	 *
	 * @param $damage
	 *
	 * @return mixed
	 */
	public function takeDamage($damage){
		$actualDamage = $damage - ($this->defense);

		$this->health -= $actualDamage;

		if ($this->health < 0) {
			$this->health = 0;
		}

		return true;
	}

	/**
	 * Calculate how much their damage is
	 *
	 *
	 * @return mixed
	 */
	public function doDamage(){
		// Get their attack power.
		$damage = $this->attack;

		// Apply Class Stat bonuses.


		// Return full damage.
		return $damage;
	}

	/**
	 * Add an item to the player's inventory
	 *
	 * @param $itemId
	 * @param $quantity
	 *
	 * @return bool
	 */
	public function addToInventory($itemId, $quantity = 1){
		$currentInventory = $this->inventory;
		$key = array_search('id', array_column($currentInventory, 'id'));
		if($key !== false) {
			// value is in inventory, add to quantity
			$currentInventory[$key]['quantity'] += $quantity;
		} else {
			// value is not in inventory, add to array
			$currentInventory[] = array(
				'id' => $itemId,
				'quantity' => $quantity
			);
		}

		$this->inventory = $currentInventory;

		return Inventory::saveInventory($this->userID, $this->inventory);
	}

}
