<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 1:09 PM
 */

namespace Drupal\class_engine\Entity\Classes;

use Drupal\user\Entity\User;
use Drupal\class_engine\Entity\Player;

class Warrior extends BaseClass
{
	public function __construct()
	{
		$this->setBaseAttack(8);
		$this->setBaseDefense(6);
		$this->setBaseHealth(100);
		
		$this->setBaseStrength(10);
		$this->setBaseConstitution(8);
		$this->setBaseDexterity(5);
		$this->setBaseCharisma(3);
		$this->setBaseIntelligence(3);
		$this->setBaseWisdom(2);
	}
}