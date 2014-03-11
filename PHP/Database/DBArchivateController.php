<?php

include_once "../Database/DBController.php";

class DBArchivateController 
{
	public function model($modelID) 
	{
		// Validate data
		$modelID = intval($modelID);
		
		$command = "UPDATE  `".databaseName()."`.`Model` SET 
				`model_archived` = 1
				WHERE  `Model`.`modelID` = :modelID;";
		$parameters = array("modelID" => $modelID);
		DBController::sharedController()->execute($command, $parameters);
	}
	
	public function reciever($recieverID) 
	{
		// Validate data
		$recieverID = intval($recieverID);
					
		$command = "UPDATE  `".databaseName()."`.`Reciever` SET
		`reciever_archived` = 1,
		`recieverUpdateDate` = CURRENT_TIMESTAMP
		WHERE  `Reciever`.`recieverID` = :recieverID;";
		$parameters = array ("recieverID" => $recieverID);
		
		DBController::sharedController()->execute($command, $parameters);
	}
	
	public function order($orderID) 
	{
		// Validate data
		$orderID = intval($orderID);
		
		$command = "UPDATE  `".databaseName()."`.`Order` SET  
					`order_archived` =  1,
					`orderDate` = CURRENT_TIMESTAMP
					WHERE  `Order`.`orderID` = :orderID ;";
		$parameters = array("orderID" => $orderID);
		DBController::sharedController()->execute($command, $parameters);
	}
}

?>