<?php
/*
 * Server API.
 * Request "Orders".
 * Type: GET.
 * Parameters:
 * creation_date - date of creation entry in DB. If it's empty, return all models
 * Response:
 * All Orders.
 */

include "../Database/database_fetch_order.php";

$orderDate = $_GET["order_date"];
$orders = "";
if (!empty($orderDate))
{
	$orders = ordersWithPredicate("orderDate > '".$orderDate."'");
}
else
{
	$orders = allOrders();
}
echo json_encode($orders);

?>