<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";

class DBInsertController 
{
	/**
	 * @return ID of autoincrement field in database, which incremented after last "INSERT"
	 */
	public function lastInsertID()
	{
		// Find it's ID //
		$IDArray = DBController::sharedController()->executeWithoutParameters("SELECT LAST_INSERT_ID();");
		$filteredIDArray = array_values($IDArray[0]);
		logObject("Last inserted IDs", $IDArray);
		$ID = $filteredIDArray[0];
		return $ID;
	}
	
	/**
	 * Add new model to warehouse.
	 * @param String $name
	 * Name of new model
	 * @param Int $count
	 * Count of incoming new models on warehouse
	 * @param Double $price
	 * Price for each model
	 * @param TinyInt $archived
	 * If equals "1", new model is temporary invalid for new purchases
	 * @return modelID
	 */
	public function modelToWarehouse($name, $count, $price, $archived)
	{
		// Validate Data //
		$count = intval($count);
		$price = floatval($price);
		$archived = abs(intval($archived) % 2);
		
		// Insert new value //
		$command = "INSERT INTO `".databaseName()."`.`Model` 
			(`model_archived`, `modelID`, `model_name`, `price`) ".
				   "VALUES (:archived, NULL, :name, :price);";
		$parameters = array ("archived" => $archived,"name" => $name,"price" => $price);
		
		DBController::sharedController()->execute($command, $parameters);
		
		logSimpleLine();
		// Find it's ID //
		$modelID = $this->lastInsertID();
		
		logSimpleLine();
		// Confirm with Warehouse //
		$command = "INSERT INTO  `".databaseName()."`.`Warehouse` 
			(`count`, `modelID`, `model_updateDate`) VALUES (:count, :modelID, CURRENT_TIMESTAMP);";
		$parameters = array ("count" => $count, "modelID" => $modelID);
		
		DBController::sharedController()->execute($command, $parameters);
		
		return $modelID;
	}
	
	/**
	 * Add new model to exist order
	 * @param Integer $modelID
	 * @param Integer $orderID
	 * @param Integer $count
	 * @return modelID
	 */
	public function modelToOrder($modelID, $orderID, $count)
	{
		// Validate Data //
		$count = intval($count);
		$modelID = intval($modelID);
		$orderID = intval($orderID);
		
		// Check count on Warehouse
		$model = DBController::sharedController()->fetch->model->withID($modelID);
		logSimpleLine();
		
		$countOnWarehouse = $model->count;
		logObject("Count on warehouse", $countOnWarehouse);
		logObject("Count to purchase", $count);
		
		if ($countOnWarehouse >= $count)
		{
			logLine("There are enough models to purchase");
			// Insert new value //
			$command = "INSERT INTO `".databaseName()."`.`ModelOrder`
			(`modelOrderID`, `modelID`, `orderID`, `count`) ".
			"VALUES (NULL, :modelID, :orderID, :count);";
			$parameters = array ("modelID" => $modelID,"orderID" => $orderID,"count" => $count);
			DBController::sharedController()->execute($command, $parameters);
			
			// Trigger `move_models_from_warehouse_to_order` will move models from warehouse to order
			
			return $modelID;
		}
		else
		{
			logLine("There aren't enough models to purchase");			
		}
	}
	
	/**
	 * Add new reciever.
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
	 * @return recieverID
	 */
	public function reciever($name, $adress, $phone, $account, $archived)
	{
		// Validate Data //
		$archived = abs(intval($archived) % 2);
	
		// Insert new value //
		$command = "INSERT INTO `".databaseName()."`.`Reciever` 
			(`account`, `adress`, `reciever_archived`,
			`recieverID`, `reciever_name`, `phone`, `recieverUpdateDate`) ".
			"VALUES (:account, :adress, :archived, NULL, :name, :phone, CURRENT_TIMESTAMP);";
		$parameters = array ("archived" => $archived,"name" => $name,"phone" => $phone,
				"adress" => $adress, "account" => $account);
	
		DBController::sharedController()->execute($command, $parameters);
		
		return $this->lastInsertID();
	}
	
	/**
	 * Add new order
	 * @param Integer $recieverID
	 * @param Array $models
	 * value-Array of Key-value arrays. Each key-value array has keys "modelID" and "count".
	 * @param TinyInt $archived
	 * @return orderID
	 */
	public function order($recieverID, $models, $archived) 
	{
		// Validate Data //
		$archived = abs(intval($archived) % 2);
		$recieverID = intval($recieverID);
		
		$command = "INSERT INTO `".databaseName()."`.`Order`
			(`orderID`, `recieverID`, `order_archived`, `orderDate`) 
			VALUES (NULL, :recieverID, :archived, CURRENT_TIMESTAMP);";
		$parameters = array ("recieverID" => $recieverID, "archived" => $archived);
		DBController::sharedController()->execute($command, $parameters);
		
		logSimpleLine();
		$orderID = $this->lastInsertID();
		
		logDump("Models", $models);
		foreach ($models as $model) 
		{
			logSimpleLine();
			$modelID = intval($model["modelID"]);
			$count = intval($model["count"]);
			
			$this->modelToOrder($modelID, $orderID, $count);
		}
		
		return $orderID;
	}
}

?>