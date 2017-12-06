<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/1/17
 * Time: 9:04 AM
 */

namespace Drupal\gameengine\Entity;

use Drupal\gameengine\Controller\Inventory;
use Drupal\user\Entity\User;

class Player
{
	private $userID;
	private $name;
	private $classType;
	private $health;
	private $attack;
	private $defense;
	
	private $strength;
	private $constitution;
	private $dexterity;
	
	/**
	 * @var array
	 */
	private $inventory;
	
	public function __construct(User $user)
	{
		$this->name = $user->field_charactername->value;
		$this->classType = $user->field_class->value;
		$this->userID = $user->id();
		$this->inventory = Inventory::getInventory($this->userID);
	}
	
	//<editor-fold desc="Getters">
	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @return mixed
	 */
	public function getClassType() {
		return $this->classType;
	}
	
	/**
	 * @return mixed
	 */
	public function getHealth() {
		return $this->health;
	}
	
	/**
	 * @return mixed
	 */
	public function getAttack() {
		return $this->attack;
	}
	
	/**
	 * @return mixed
	 */
	public function getDefense() {
		return $this->defense;
	}
	
	/**
	 * @return mixed
	 */
	public function getStrength() {
		return $this->strength;
	}
	
	/**
	 * @return mixed
	 */
	public function getConstitution() {
		return $this->constitution;
	}
	
	/**
	 * @return mixed
	 */
	public function getDexterity() {
		return $this->dexterity;
	}
	
	/**
	 * @return mixed
	 */
	public function getInventory() {
		return $this->inventory;
	}
	//</editor-fold>
	
	//<editor-fold desc="Setters">
	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @param mixed $classType
	 */
	public function setClassType($classType) {
		$this->classType = $classType;
	}
	
	/**
	 * @param mixed $health
	 */
	public function setHealth($health) {
		$this->health = $health;
	}
	
	/**
	 * @param mixed $attack
	 */
	public function setAttack($attack) {
		$this->attack = $attack;
	}
	
	/**
	 * @param mixed $defense
	 */
	public function setDefense($defense) {
		$this->defense = $defense;
	}
	
	/**
	 * @param mixed $strength
	 */
	public function setStrength($strength) {
		$this->strength = $strength;
	}
	
	/**
	 * @param mixed $constitution
	 */
	public function setConstitution($constitution) {
		$this->constitution = $constitution;
	}
	
	/**
	 * @param mixed $dexterity
	 */
	public function setDexterity($dexterity) {
		$this->dexterity = $dexterity;
	}
	
	/**
	 * @param mixed $inventory
	 */
	public function setInventory($inventory) {
		$this->inventory = $inventory;
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
		
		return true;
	}
	
	/**
	 * Calculate how much their damage is
	 *
	 *
	 * @return mixed
	 */
	public function doDamage(){
		$damage = $this->attack;
		
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