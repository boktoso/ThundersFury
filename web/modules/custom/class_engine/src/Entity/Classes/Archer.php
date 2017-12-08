<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/8/17
 * Time: 8:07 AM
 */

namespace Drupal\class_engine\Entity\Classes;


class Archer extends BaseClass
{
	public function __construct()
	{
		$this->setBaseAttack(7);
		$this->setBaseDefense(7);
		$this->setBaseHealth(100);
		
		$this->setBaseStrength(3);
		$this->setBaseConstitution(8);
		$this->setBaseDexterity(10);
		$this->setBaseCharisma(3);
		$this->setBaseIntelligence(5);
		$this->setBaseWisdom(2);
	}
}