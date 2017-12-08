<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 8:05 AM
 */

namespace Drupal\class_engine\Entity\Classes;


class Paladin extends BaseClass
{
	public function __construct()
	{
		$this->setBaseAttack(6);
		$this->setBaseDefense(10);
		$this->setBaseHealth(110);
		
		$this->setBaseStrength(5);
		$this->setBaseConstitution(10);
		$this->setBaseDexterity(3);
		$this->setBaseCharisma(3);
		$this->setBaseIntelligence(5);
		$this->setBaseWisdom(5);
	}
}