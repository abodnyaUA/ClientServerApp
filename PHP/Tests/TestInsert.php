<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");
insertModel();
insertReciever();
insertModelToOrder();

function insertModel()
{
	logSeparateLine();
	$name = "Crimea";
	$count = 78;
	$price = 55;
	$archived = 0;
	logLine("Insert model with name: ".$name."; count: ".$count."; price: ".$price."; archived: ".$archived);
	logSeparateLine();
	$result = DBController::sharedController()->insert->modelToWarehouse($name, $count, $price, $archived);
// 	logObject("Insert Result", $result);
	logSimpleLine();
	$modelID = DBController::sharedController()->insert->lastInsertID();
	logSimpleLine();
	$result = DBController::sharedController()->fetch->model->withID($modelID);
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
	
	logSeparateLine();
}

function insertReciever()
{
	logSeparateLine();
	$name = "Abramov Igor";
	$adress = "Vasulkov";
	$phone = "785-555-55-55";
	$account = "755454987946";
	$archived = 0;
	logLine("Insert reciever with name: ".$name."; adress: ".$adress.
		"; phone: ".$phone."; account: ".$account."; archived: ".$archived);
	logSeparateLine();
	$result = DBController::sharedController()->insert->reciever($name, $adress, $phone, $account, $archived);
// 	logObject("Insert Result", $result);
	logSimpleLine();
	$modelID = DBController::sharedController()->insert->lastInsertID();
	logSimpleLine();
	$result = DBController::sharedController()->fetch->reciever->withID($modelID);
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
	
	logSeparateLine();
}

function insertModelToOrder()
{
	logSeparateLine();
	$orderID = 3;
	$modelID = 90;
	$count = 66;
	logLine("Insert to order with ID ".$orderID." model with ID: ".$modelID." with count ".$count);
	logSeparateLine();
	$result = DBController::sharedController()->insert->modelToOrder($modelID, $orderID, $count);
// 	logObject("Insert Result", $result);
	logSimpleLine();
	$result = DBController::sharedController()->fetch->order->withID($orderID);
// 	logObject("Fetch Result", $result);
	
	logEmptyLine();
	
	logSeparateLine();
}

?>