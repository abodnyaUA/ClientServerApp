<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");

// updateModel();
// updateReciever();
// updateOrder();
updateModelCountInOrder();

function updateModel()
{
	logSeparateLine();
	$modelID = 83;
	logLine("Model with ID: ".$modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	logLine("Update model with ID: ".$modelID);
	logSeparateLine();
	$name = "Tihon";
	$count = 35;
	$price = 75;
	$archived = 1;
	DBController::sharedController()->update->model($modelID, $name, $count, $price, $archived);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function updateReciever()
{
	logSeparateLine();
	$recieverID = 3;
	logLine("Reciever with ID: ".$recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	logLine("Update reciever with ID: ".$recieverID);
	logSeparateLine();
	$name = "Mushket";
	$adress = "Kazan'";
	$account = "7888-9969-6666-5555";
	$phone = "050-856-44-88";
	$archived = 0;
	DBController::sharedController()->update->reciever
		($recieverID, $name, $adress, $phone, $account, $archived);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function updateOrder()
{
	logSeparateLine();
	$orderID = 8;
	logLine("Order with ID: ".$orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	logLine("Archive order with ID: ".$orderID);
	logSeparateLine();
	$archived = 0;
	$recieverID = 5;
	DBController::sharedController()->update->order($orderID, $archived, $recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function updateModelCountInOrder()
{
	logSeparateLine();
	$orderID = 8;
	logLine("Order with ID: ".$orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	logLine("Update model count in order with ID: ".$orderID);
	logSeparateLine();
	$count = 5;
	$modelID = 70;
	DBController::sharedController()->update->modelCountInOrder($modelID, $orderID, $count);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	
	logEmptyLine();
	
	logSeparateLine();
}

?>