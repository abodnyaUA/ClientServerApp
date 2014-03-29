<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";

class DBUpdateController 
{
	
	public function reciever($recieverID, $name, $adress, $phone, $account, $archived)
	{
		// Validate Data //
		$archived = abs(intval($archived) % 2);
		$recieverID = intval($recieverID);
		
		$command = "UPDATE  `".databaseName()."`.`Reciever` SET  
				`account` = :account,
				`adress` = :adress,
				`reciever_archived` = :archived,
				`reciever_name` = :name,
				`phone` = :phone,
				`recieverUpdateDate` = CURRENT_TIMESTAMP 
				WHERE  `Reciever`.`recieverID` = :recieverID;";
		$parameters = array (
				"account" => $account, 
				"adress" => $adress, 
				"archived" => $archived, 
				"name" => $name,
				"phone" => $phone,
				"recieverID" => $recieverID);
	
		DBController::sharedController()->execute($command, $parameters);
	}
	
	public function model($modelID, $name, $count, $price, $archived)
	{
		// Validate Data //
		$count = intval($count);
		$price = floatval($price);
		$archived = abs(intval($archived) % 2);
		$modelID = intval($modelID);
		
		$command = "UPDATE  `".databaseName()."`.`Model` SET  
				`model_name` = :name,
				`price` = :price,
				`model_archived` = :archived
				WHERE  `Model`.`modelID` = :modelID;";
		$parameters = array("name" => $name, "price" => $price, 
							 "modelID" => $modelID, "archived" => $archived);
		
		DBController::sharedController()->execute($command, $parameters);
		
		logSimpleLine();
		
		$command = "UPDATE  `".databaseName()."`.`Warehouse` SET
					`count` =  :count,
					`model_updateDate` =  CURRENT_TIMESTAMP
					WHERE `Warehouse`.`modelID` = :modelID;";
		$parameters = array("count" => $count, "modelID" => $modelID);
		
		DBController::sharedController()->execute($command, $parameters);
	}
	
	public function modelCountInOrder($modelID, $orderID, $count)
	{
		// Validate Data //
		$modelID = intval($modelID);
		$orderID = intval($orderID);
		$count = intval($count);
		
		
		// Check count on Warehouse
		$modelOnWarehouse = DBController::sharedController()->fetch->model->withID($modelID);
		logSimpleLine();
		
		$countOnWarehouse = $modelOnWarehouse["count"];
		logObject("Count on warehouse", $countOnWarehouse);
		
		// Check count in Order
		$modelInOrder = DBController::sharedController()->fetch->order->withModelAndOrderID($modelID, $orderID);
		$countInOrder = $modelInOrder["count"];
		logObject("Count in order", $modelInOrder);
		
		$summaryCount = $countInOrder + $countOnWarehouse;
		
		logObject("Summary exist count", $summaryCount);
		logObject("Count to purchase", $count);
		
		if ($summaryCount >= $count)
		{
			logLine("There are enough models to purchase");
			// Insert new value //
			$command = "UPDATE `".databaseName()."`.`ModelOrder` SET 
						`count`=:count 
						WHERE `modelID` = :modelID and `orderID` = :orderID";
			$parameters = array("modelID" => $modelID, "orderID" => $orderID, "count" => $count);
			
			DBController::sharedController()->execute($command, $parameters);
			
			// Triger `update_models_count_in_order` will recalculate new models' count on warehouse
		}
		else
		{
			logLine("There aren't enough models to purchase");				
		}
	}
	
	public function order($orderID, $archived, $recieverID)
	{
		// Validate Data //
		$recieverID = intval($recieverID);
		$orderID = intval($orderID);
		$archived = abs(intval($archived) % 2);
		
		$command = "UPDATE  `".databaseName()."`.`Order` SET  
					`order_archived` = :archived,
					`orderDate` = CURRENT_TIMESTAMP, 
					`recieverID` =  :recieverID 
					WHERE  `Order`.`orderID` = :orderID ;";
		$parameters = array("recieverID" => $recieverID, 
							 "orderID" => $orderID,
							 "archived" => $archived);
		DBController::sharedController()->execute($command, $parameters);
	}
}

?>