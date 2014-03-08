<?php

include_once "../Database/DBController.php";

class DBInsertController 
{
	/**
	 * @return ID of autoincrement field in database, which incremented after last "INSERT"
	 */
	private function lastInsertID()
	{
		// Find it's ID //
		$IDArray = DBController::sharedController()->execute("SELECT LAST_INSERT_ID();",null);
		$filteredIDArray = array_values($IDArray[0]);
		$ID = $filteredIDArray[0];
		return $ID;
	}
	
	/**
	 * Add new model to warehouse in Database".
	 * @param String $name
	 * Name of new model
	 * @param Int $count
	 * Count of incoming new models on warehouse
	 * @param Double $price
	 * Price for each model
	 * @param TinyInt $archived
	 * If equals "1", new model is temporary invalid for new purchases
	 */
	public function modelToWarehouse($name, $count, $price, $archived)
	{
		// Validate Data //
		$count = intval($count);
		$price = floatval($price);
		$archived = abs(intval($archived) % 2);
		
		// Insert new value //
		$command = "INSERT INTO `".databaseName()."`.`Model` 
			(`model_archived`, `modelID`, `name`, `price`, `model_creationDate`) ".
				   "VALUES (:archived, NULL, :name, :price, CURRENT_TIMESTAMP);";
		$parameters = array ("archived" => $archived,"name" => $name,"price" => $price);
		
		DBController::sharedController()->execute($command, $parameters);
		
		// Find it's ID //
		$modelID = $this->lastInsertID();
		
		// Confirm with Warehouse //
		$command = "INSERT INTO  `".databaseName()."`.`Warehouse` 
			(`count`, `modelID`) VALUES (:count, :modelID);";
		$parameters = array ("count" => $count, "modelID" => $modelID);
		
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Add new reciever".
	 * @param String $name
	 * Fullname. Ussually contains First name and last name, separated by "."
	 * @param String $adress
	 * Contact adress
	 * @param String $phone
	 * Contact phone number
	 * @param String $account
	 * Reciever's bank account
	 * @param TinyInt $archived
	 * If equals "1", new reciever temporary doesn't have access for new purchases
	 */
	public function reciever($name, $adress, $phone, $account, $archived)
	{
		// Validate Data //
		$archived = abs(intval($archived) % 2);
	
		// Insert new value //
		$command = "INSERT INTO `".databaseName()."`.`Reciever` 
			(`account`, `adress`, `reciever_archived`,
			`recieverID`, `name`, `phone`, `recieverUpdateDate`) ".
			"VALUES (:account, :adress, :archived, NULL, :name, :phone, CURRENT_TIMESTAMP);";
		$parameters = array ("archived" => $archived,"name" => $name,"phone" => $phone,
				"adress" => $adress, "account" => $account);
	
		DBController::sharedController()->execute($command, $parameters);
	}
}

?>