<?php

include_once "../Database/DBController.php";

class DBArchivateController 
{
	public function model($modelID) 
	{
		// Validate data
		$modelID = intval($modelID);
		
		$model = DBController::sharedController()->fetch->model->withID($modelID);
		if (0 === $model["model_archived"])
		{
			DBController::sharedController()->update->model
			($modelID, $model["name"], $model["count"], $model["price"], 1);
		}
	}
	
	public function reciever($recieverID) 
	{
		// Validate data
		$recieverID = intval($recieverID);
		
		$reciever = DBController::sharedController()->fetch->reciever->withID($recieverID);
		if (0 === $reciever["reciever_archived"])
		{
			DBController::sharedController()->update->reciever
			($recieverID, $reciever["name"], $reciever["adress"], 
				$reciever["phone"], $reciever["account"], 1);
		}
	}
	
	public function order($orderID) 
	{
		// Validate data
		$orderID = intval($orderID);
		
		$order = DBController::sharedController()->fetch->order->withID($orderID);
		if (0 === $order["order_archived"])
		{
			DBController::sharedController()->update->order($orderID, 1, $order["recieverID"]);
		}
	}
}

?>