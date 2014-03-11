<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");
// removeModel();
// removeReciever();
// removeOrder();
removeModelFromOrder();

function removeModel()
{
	logSeparateLine();
	$modelID = 90;
	logLine("Remove model with ID: ".$modelID.": Without order");
	logSeparateLine();
	DBController::sharedController()->remove->modelFromWarehouse($modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withModel($modelID);
	
	logEmptyLine();
	
	logSeparateLine();
	
	$modelID = 69;
	logLine("Remove model with ID: ".$modelID.": With order");
	logSeparateLine();
	DBController::sharedController()->remove->modelFromWarehouse($modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withModel($modelID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function removeReciever()
{
	logSeparateLine();
	$recieverID = 25;
	logLine("Remove reciever with ID: ".$recieverID.": Without order");
	logSeparateLine();
	DBController::sharedController()->remove->reciever($recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withReciever($recieverID);
	
	logEmptyLine();
	
	logSeparateLine();
	$recieverID = 3;
	logLine("Remove reciever with ID: ".$recieverID.": With order");
	logSeparateLine();
	DBController::sharedController()->remove->reciever($recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withReciever($recieverID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function removeOrder()
{
	logSeparateLine();
	$orderID = 1;
	logLine("Remove order with ID: ".$orderID);
	logSeparateLine();
	DBController::sharedController()->remove->order($orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function removeModelFromOrder() 
{
	logSeparateLine();
	$orderID = 3;
	$modelID = 89;
	logLine("Order with ID ".$orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	logLine("Remove model with ID ".$modelID." from order with ID: ".$orderID);
	logSeparateLine();
	DBController::sharedController()->remove->modelFromOrder($modelID, $orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	
	logEmptyLine();
	
	logSeparateLine();
}

?>
