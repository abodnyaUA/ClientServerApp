<?php

include_once "../Database/DBController.php";

class DBRecieverFetcher 
{	
	/**
	 * Fetch recievers from database with condition "WHERE $predicate".
	 * @param String $predicate
	 * Condition for fetching
	 * @param Array $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of recievers. Each reciever is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		$command = "SELECT * FROM `".databaseName()."`.`Reciever` WHERE ".$predicate;
		$entries = DBController::sharedController()->execute($command, $parameters);
	 	return $entries;
	}
	
	/**
	 * @return array of all orders. Each order is dictionary.
	 */
	public function all()
	{
		return $this->withPredicate("1",null);
	}
}

?>
