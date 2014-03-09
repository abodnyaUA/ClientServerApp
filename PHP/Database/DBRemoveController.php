<?php

include_once "../Database/DBController.php";

define ("DeleteMode", 0);
define ("ArchivateMode", 1);
define ("CancelMode", 2);

class DBRemoveController 
{
	/**
	 * Remove model from exist order
	 * @param Integer $modelID
	 * @param Integer $orderID
	 */
	public function modelFromOrder($modelID, $orderID)
	{
		// Validate Data //
		$modelID = intval($modelID);
		$orderID = intval($orderID);
		
		$order = DBController::sharedController()->fetch->order->withID($orderID);
		if (0 === $order["order_archived"])
		{
			$countModelsInOrder = $order["count"];
			
			$model = DBController::sharedController()->fetch->model->withID($modelID);
			$countModelsOnWarehouse = $model["count"];
			// Return models to warehouse if order is active
			$newCountOnWarehouse = $countModelsOnWarehouse + $countModelsInOrder;
			DBController::sharedController()->update->
				model($modelID, $model["name"], $newCountOnWarehouse, $model["price"], $model["archived"]);
		}
		
		$params = array("orderID");
		$command = "DELETE FROM `".databaseName()."`.`ModelOrder` WHERE `ModelOrder`.`orderID` = :orderID";
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Remove model from warehouse
	 * @param Integer $modelID
	 * @param TinyInt $hardRemove
	 * If YES, Remove also all connections (orders with this model)
	 */
	public function modelFromWarehouse($modelID, $hardRemove)
	{
		// Validate Data //
		$modelID = intval($modelID);
		$hardRemove = abs(intval($hardRemove) % 2);
		
		$command = "DELETE FROM `".databaseName()."`.`Warehouse` WHERE `Warehouse`.`modelID` = :modelID";
		$params = array("modelID");
		DBController::sharedController()->execute($command, $parameters);
		
		if (1 === $hardRemove)
		{
			$command = "DELETE FROM `".databaseName()."`.`ModelOrder` WHERE `ModelOrder`.`modelID` = :modelID";
			DBController::sharedController()->execute($command, $parameters);			
		}
		
		$command = "DELETE FROM `".databaseName()."`.`Model` WHERE `Model`.`modelID` = :modelID";
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Remove order
	 * @param Integer $orderID
	 */
	public function order($orderID)
	{
		// Validate Data //
		$orderID = intval($orderID);
		
		$orders = DBController::sharedController()->fetch->order->withID($orderID);
		foreach ($orders as $order) 
		{
			$modelID = $order["modelID"];
			$this->modelFromOrder($modelID, $orderID);				
		}
		
		$command = "DELETE FROM `".databaseName()."`.`Order` WHERE `Order`.`orderID` = :orderID";
		$parameters = array ("orderID" => $orderID);
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Remove Reciever
	 * @param Integer $recieverID
	 * @param TinyInt $hardRemove
	 * If YES, Remove also all connections (orders with this model)
	 */
	public function reciever($recieverID, $hardRemove)
	{
		// Validate Data //
		$modelID = intval($modelID);
		$hardRemove = abs(intval($hardRemove) % 2);
		
		$parameters = array ("recieverID" => $recieverID);
		
		if (1 === $hardRemove)
		{
			$orders = DBController::sharedController()->fetch->order->withReciever($recieverID);
			foreach ($orders as $order) 
			{
				$orderID = $order["orderID"];
				$this->order($orderID);
			}
		}
		
		$command = "DELETE FROM `".databaseName()."`.`Reciever` WHERE 
					`Reciever`.recieverID = :recieverID";
		DBController::sharedController()->execute($command, $parameters);
	}
}