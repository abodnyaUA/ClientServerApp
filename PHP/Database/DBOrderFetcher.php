<?php

include_once "../Database/DBController.php";

class DBOrderFetcher 
{	
	/**
	 * Fetch orders from database with condition "WHERE $predicate".
	 * @param String $predicate
	 * Condition for fetching
	 * @param Array $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of orders. Each order is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		$command = "SELECT * FROM `Model`,`Order`,`ModelOrder` WHERE
					`ModelOrder`.modelID = `Model`.modelID AND
					`ModelOrder`.orderID = `Order`.orderID AND ".$predicate;
		$entries = DBController::sharedController()->executeWithBindParameters($command, $parameters);
	 	return $entries;
	}
	
	/**
	 * Each order is dictionary.
	 * @return array of all orders.
	 */
	public function all()
	{
		return $this->withPredicate("1", null);
	}
}

?>
