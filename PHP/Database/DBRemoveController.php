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

		// Trigger `move_models_from_order_to_warehouse` will back all models to warehouse
		// if order is active. 
		
		$parameters = array("orderID" => $orderID, "modelID" => $modelID);
		$command = "DELETE FROM `".databaseName()."`.`ModelOrder` 
					WHERE `ModelOrder`.`orderID` = :orderID and `ModelOrder`.`modelID` = :modelID";
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Remove model from warehouse and from all orders
	 * @param Integer $modelID
	 */
	public function modelFromWarehouse($modelID)
	{
		// Validate Data //
		$modelID = intval($modelID);
		$parameters = array("modelID" => $modelID);
		
		$command = "DELETE FROM `".databaseName()."`.`ModelOrder` WHERE `ModelOrder`.`modelID` = :modelID";
		DBController::sharedController()->execute($command, $parameters);
		logSimpleLine();
		
		$command = "DELETE FROM `".databaseName()."`.`Warehouse` WHERE `Warehouse`.`modelID` = :modelID";
		DBController::sharedController()->execute($command, $parameters);	
		logSimpleLine();		
		
		$command = "DELETE FROM `".databaseName()."`.`Model` WHERE `Model`.`modelID` = :modelID";
		DBController::sharedController()->execute($command, $parameters);
		logSimpleLine();
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
		logSimpleLine();
		logDump("Models with order", $orders);
		foreach ($orders as $order) 
		{
			$modelID = $order["modelID"];
			$this->modelFromOrder($modelID, $orderID);	
			logSimpleLine();			
		}
		
		$command = "DELETE FROM `".databaseName()."`.`Order` WHERE `Order`.`orderID` = :orderID";
		$parameters = array ("orderID" => $orderID);
		DBController::sharedController()->execute($command, $parameters);
	}
	
	/**
	 * Remove Reciever from database (include all orders)
	 * @param Integer $recieverID
	 */
	public function reciever($recieverID)
	{
		// Validate Data //
		$recieverID = intval($recieverID);
		
		$parameters = array ("recieverID" => $recieverID);
		
		$orders = DBController::sharedController()->fetch->order->withReciever($recieverID);
		logSimpleLine();
		foreach ($orders as $order) 
		{
			$orderID = $order["orderID"];
			logDump("OrderID with reciever", $orderID);
			$this->order($orderID);
			logSimpleLine();
		}
		
		$command = "DELETE FROM `".databaseName()."`.`Reciever` WHERE 
					`Reciever`.recieverID = :recieverID";
		DBController::sharedController()->execute($command, $parameters);
	}
}