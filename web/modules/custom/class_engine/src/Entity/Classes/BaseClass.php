<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 1:11 PM
 */

namespace Drupal\class_engine\Entity\Classes;


class BaseClass
{
	private $baseHealth;
	private $baseAttack;
	private $baseDefense;
	
	// http://tvtropes.org/pmwiki/pmwiki.php/Main/TheSixStats
	// Strength
	// Dexterity
	// Constitution (Endurance)
	// Charisma
	// Intelligence
	// Wisdom
	
	/**
	 * Strength increases your physical damage done by melee weapons and fists
	 *
	 * @var integer
	 */
	private $baseStrength;
	
	/**
	 * Dexterity
	 *
	 * @var integer
	 */
	private $baseDexterity;
	
	/**
	 * @var integer
	 */
	private $baseConstitution;
	
	/**
	 * @var integer
	 */
	private $baseCharisma;
	
	/**
	 * @var integer
	 */
	private $baseIntelligence;
	
	/**
	 * @var integer
	 */
	private $baseWisdom;
	
	//<editor-fold desc="Getters and Setters">
	/**
	 * @return mixed
	 */
	public function getBaseHealth() {
		return $this->baseHealth;
	}
	
	/**
	 * @param mixed $baseHealth
	 *
	 * @return BaseClass
	 */
	public function setBaseHealth($baseHealth) {
		$this->baseHealth = $baseHealth;
		
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getBaseAttack() {
		return $this->baseAttack;
	}
	
	/**
	 * @param mixed $baseAttack
	 *
	 * @return BaseClass
	 */
	public function setBaseAttack($baseAttack) {
		$this->baseAttack = $baseAttack;
		
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getBaseDefense() {
		return $this->baseDefense;
	}
	
	/**
	 * @param mixed $baseDefense
	 *
	 * @return BaseClass
	 */
	public function setBaseDefense($baseDefense) {
		$this->baseDefense = $baseDefense;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseStrength() {
		return $this->baseStrength;
	}
	
	/**
	 * @param int $baseStrength
	 *
	 * @return BaseClass
	 */
	public function setBaseStrength($baseStrength) {
		$this->baseStrength = $baseStrength;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseDexterity() {
		return $this->baseDexterity;
	}
	
	/**
	 * @param int $baseDexterity
	 *
	 * @return BaseClass
	 */
	public function setBaseDexterity($baseDexterity) {
		$this->baseDexterity = $baseDexterity;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseConstitution() {
		return $this->baseConstitution;
	}
	
	/**
	 * @param int $baseConstitution
	 *
	 * @return BaseClass
	 */
	public function setBaseConstitution($baseConstitution) {
		$this->baseConstitution = $baseConstitution;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseCharisma() {
		return $this->baseCharisma;
	}
	
	/**
	 * @param int $baseCharisma
	 *
	 * @return BaseClass
	 */
	public function setBaseCharisma($baseCharisma) {
		$this->baseCharisma = $baseCharisma;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseIntelligence() {
		return $this->baseIntelligence;
	}
	
	/**
	 * @param int $baseIntelligence
	 *
	 * @return BaseClass
	 */
	public function setBaseIntelligence($baseIntelligence) {
		$this->baseIntelligence = $baseIntelligence;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getBaseWisdom() {
		return $this->baseWisdom;
	}
	
	/**
	 * @param int $baseWisdom
	 *
	 * @return BaseClass
	 */
	public function setBaseWisdom($baseWisdom) {
		$this->baseWisdom = $baseWisdom;
		
		return $this;
	}
	//</editor-fold>
}