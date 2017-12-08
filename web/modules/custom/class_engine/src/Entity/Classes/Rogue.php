<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 8:05 AM
 */

namespace Drupal\class_engine\Entity\Classes;


class Rogue extends BaseClass
{
	public function __construct()
	{
		$this->setBaseAttack(10);
		$this->setBaseDefense(4);
		$this->setBaseHealth(100);
		
		$this->setBaseStrength(6);
		$this->setBaseConstitution(6);
		$this->setBaseDexterity(10);
		$this->setBaseCharisma(3);
		$this->setBaseIntelligence(3);
		$this->setBaseWisdom(2);
	}
}