<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");
fetchModel();
fetchReciever();
fetchOrder();

function fetchModel()
{
	logSeparateLine();
	logSeparateLine();
	logLine("Fetch all models");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->model->all();
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
	
	logSeparateLine();
	logLine("Fetch model with ID 74");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->model->withID(74);
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
	
	logSeparateLine();
	logLine("Fetch model with invalid ID 0");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->model->withID(0);
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
}

function fetchReciever()
{
	logSeparateLine();
	logSeparateLine();
	logLine("Fetch all recievers");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->reciever->all();
// 	logObject("Fetch Result", $result);

	logEmptyLine();

	logSeparateLine();
	logLine("Fetch reciever with ID 2");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->reciever->withID(2);
// 	logObject("Fetch Result", $result);
	logEmptyLine();
}

function fetchOrder()
{
	logSeparateLine();
	logSeparateLine();
	logLine("Fetch all orders");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->order->all();
// 	logObject("Fetch Result", $result);

	logEmptyLine();

	logSeparateLine();
	logLine("Fetch order with order ID 1");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->order->withID(1);
// 	logObject("Fetch Result", $result);
	logEmptyLine();
	
	logEmptyLine();
	
	logSeparateLine();
	logLine("Fetch order with reciever ID 3");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->order->withReciever(3);
// 	logObject("Fetch Result", $result);
	logEmptyLine();
	
	logEmptyLine();
	
	logSeparateLine();
	logLine("Fetch order with model ID 68");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->order->withModel(68);
// 	logObject("Fetch Result", $result);
	logEmptyLine();
	
	logEmptyLine();
	
	logSeparateLine();
	logLine("Fetch order with model ID 68 and orderID 4");
	logSeparateLine();
	$result = DBController::sharedController()->fetch->order->withModelAndOrderID(68,4);
// 	logObject("Fetch Result", $result);
	logEmptyLine();
}

?>