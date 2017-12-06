<?php
/**
 * Created by PhpStorm.
 * User: rhayman
 * Date: 12/6/17
 * Time: 4:12 PM
 */

namespace Drupal\gameengine\Controller;


class Inventory {
	
	/**
	 *  Returns the array for the inventory
	 *
	 * @param $userid
	 *          User's UID
	 * @return array
	 *          Array of the IDs of Items in the Inventory
	 */
	public static function getInventory($userid){
		$info = '{}';
		$query = \Drupal::database()->prepare('SELECT Inventory FROM user__inventory WHERE entity_id = :uid');
		$query->execute([
			'uid' => $userid
		]);
		$records = $query->fetchAll();
		
		foreach($records as $record){
			$info = $record->Inventory;
		}
		
		return json_decode($info, true);
	}
	
	/**
	 * Save the inventory for the user
	 *
	 * @param $userid
	 *          User's UID
	 * @param $inventory
	 *          Array of Information to store into the Inventory
	 *
	 * @return mixed
	 */
	public static function saveInventory($userid, $inventory){
		$query = \Drupal::database()->prepare('UPDATE user__inventory SET Inventory = :inventory WHERE entity_id = :uid');
		$results = $query->execute([
			'inventory' => json_encode($inventory),
			'uid' => $userid
		]);
		return $results;
	}
}