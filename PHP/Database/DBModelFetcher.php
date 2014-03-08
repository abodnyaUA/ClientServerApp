<?php

include_once "../Database/DBController.php";

class DBModelFetcher 
{
	/**
	 * Fetch models from database with condition "WHERE $predicate".
	 * @param $predicate
	 * Condition for fetching
	 * @param $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of models. Each model is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		$command = "SELECT * FROM `".databaseName()."`.`Model`,
								  `".databaseName()."`.`Warehouse` WHERE 
			`Warehouse`.modelID = `Model`.modelID and ".$predicate;
		$entries = DBController::sharedController()->execute($command, $parameters);
	 	return $entries;
	}
	
	/**
	 * @return array of all models on warehouse (including archivated and active). Each model is dictionary.
	 */
	public function all()
	{
		return $this->withPredicate("1", null);
	}
}

?>
