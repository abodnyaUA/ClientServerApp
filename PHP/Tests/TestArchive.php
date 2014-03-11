<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");
// archiveOrder();
// archiveModel();
archiveReciever();


function archiveOrder() 
{
	logSeparateLine();
	$orderID = 8;
	logLine("Order with ID: ".$orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	logLine("Archive order with ID: ".$orderID);
	logSeparateLine();
	DBController::sharedController()->archivate->order($orderID);
	logSimpleLine();
	DBController::sharedController()->fetch->order->withID($orderID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function archiveModel()
{
	logSeparateLine();
	$modelID = 85;
	logLine("Model with ID: ".$modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	logLine("Archive model with ID: ".$modelID);
	logSeparateLine();
	DBController::sharedController()->archivate->model($modelID);
	logSimpleLine();
	DBController::sharedController()->fetch->model->withID($modelID);
	
	logEmptyLine();
	
	logSeparateLine();
}

function archiveReciever()
{
	logSeparateLine();
	$recieverID = 3;
	logLine("Reciever with ID: ".$recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	logLine("Archive reciever with ID: ".$recieverID);
	logSeparateLine();
	DBController::sharedController()->archivate->reciever($recieverID);
	logSimpleLine();
	DBController::sharedController()->fetch->reciever->withID($recieverID);
	
	logEmptyLine();
	
	logSeparateLine();
}

?>
