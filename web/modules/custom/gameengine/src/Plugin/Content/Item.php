<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 3:34 PM
 */

namespace Drupal\gameengine\Plugin\Content;

class Item
{
	public $name;
	public $type;
	public $subtype;
	public $modifiers;
	public $minDamage;
	public $maxDamage;
	
	public function __construct($itemId)
	{
		if(is_int($itemId)){
			$itemInfo = '';
			$query = \Drupal::database()->query(
		'SELECT ItemInfo FROM thunderfury__items WHERE uid = :uid LIMIT 0, 1',
				[
					'uid' => $itemId
				]
			);
			
			$records = $query->fetchAll();
			foreach($records as $record){
				$itemInfo = $record->ItemInfo;
			}
			
			$itemInfo = json_decode($itemInfo, true);
			
			$this->name = $itemInfo['name'];
			$this->type = $itemInfo['type'];
			$this->subtype = $itemInfo['subtype'];
			$this->minDamage = $itemInfo['minDamage'];
			$this->maxDamage = $itemInfo['maxDamage'];
			$this->modifiers = $itemInfo['modifiers'];
		}
	}
	
	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * @return mixed
	 */
	public function getSubtype() {
		return $this->subtype;
	}
	
	/**
	 * @return mixed
	 */
	public function getModifiers() {
		return $this->modifiers;
	}
	
	/**
	 * @return mixed
	 */
	public function getMinDamage() {
		return $this->minDamage;
	}
	
	/**
	 * @return mixed
	 */
	public function getMaxDamage() {
		return $this->maxDamage;
	}
	
}