<?php
/**
 * Server API.
 * Request "Orders".
 * Type: GET.
 * Parameters:
 * creation_date - date of creation entry in DB. If it's empty, return all models
 * Response:
 * All Orders.
 */

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/ServerAPI/JSON.php";

$orderDate = $_GET["order_date"];
$orders = "";
if (!empty($orderDate))
{
	$predicate = "orderDate > :orderDate";
	$parameters = array ("orderDate" => $orderDate);
	$orders = DBController::sharedController()->fetch->order->withPredicate($predicate,$parameters);
}
else
{
	$orders = DBController::sharedController()->fetch->order->all();
}
echo sendSuccessResponse($orders);

?>