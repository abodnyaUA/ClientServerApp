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

include_once "../Database/DBController.php";
include_once "../ServerAPI/JSON.php";

$orderDate = $_GET["order_date"];
$orders = "";
if (!empty($orderDate))
{
	$predicate = "orderDate > ?";
	$parameters = array ($orderDate);
	$orders = DBController::sharedController()->fetch->order->withPredicate($predicate,$parameters);
}
else
{
	$orders = DBController::sharedController()->fetch->order->all();
}
echo sendSuccessResponse($orders);

?>