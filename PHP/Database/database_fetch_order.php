<?php
include 'database_manager.php';
include 'database_conversations.php';

/*
 * @method modelsWithPredicate
 * Fetch models from database with condition "WHERE $predicate".
 * Return Array of models. Each model is dictionary.
 */
function ordersWithPredicate($predicate)
{
	$command = "SELECT * FROM `Model`,`Order`,`ModelOrder` WHERE 
	`ModelOrder`.modelID = `Model`.modelID AND 
	`ModelOrder`.orderID = `Order`.orderID AND ".$predicate;
	//echo "COMMAND:".$command;
	$dbLog = executeCommand($command);
	
	$entries = dbArrayToPHPArray($dbLog);	
 	return $entries;
}

/*
 * @method allOrders()
 * Return array of all orders. 
 * Each order is dictionary.
 */
function allOrders()
{
	return ordersWithPredicate("1");
}

?>