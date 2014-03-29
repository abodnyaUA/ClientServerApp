<?php
/**
 * Server API.
 * Request "Add Model".
 * Type: GET.
 * Parameters:
 * price - model's price
 * name - model's name
 * count - Count of models incoming on warehouse
 * archived - If equals "1", new model is temporary invalid for new purchases
 */

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";

$price = $_GET["price"];
$count = $_GET["count"];
$name = $_GET["name"];
$archived = $_GET["archived"];

if (!empty($price) && !empty($name) && !empty($count) && 
		(!empty($archived) || 0 == $archived))
{
	DBController::sharedController()->insert->modelToWarehouse($name, $count, $price, $archived);	
	JSONLog("success","1");
}
else
{
	sendFailureResponse("Invalid parameters");
}

?>