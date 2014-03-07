<?php
/**
 * Server API.
 * Request "Add Model".
 * Type: GET.
 * Parameters:
 * price - model's price
 * name - model's name
 * count - Count of models incoming on warehouse
 * archived - YES or NO
 * Response:
 * Models on warehouse.
 */

include_once "../Database/DBController.php";

$price = $_GET["price"];
$count = $_GET["count"];
$name = $_GET["name"];
$archived = $_GET["archived"];
$models = "";
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