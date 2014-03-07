<?php

include_once "../Database/DBController.php";

class DBModelFetcher 
{
	/**
	 * @method modelsOnWarehouseWithPredicate
	 * Fetch models from database with condition "WHERE $predicate".
	 * Return Array of models. Each model is dictionary.
	 * @param $predicate
	 * Condition for fetching
	 */
	public function modelsOnWarehouseWithPredicate($predicate,$parameters)
	{
		$command = "SELECT * FROM `Model`,`Warehouse` WHERE `Warehouse`.modelID = `Model`.modelID and ".$predicate;
		$dbEntries = DBController::sharedController()->execute($command, $parameters);
		$entries = DBController::sharedController()->PHPArrayFromDBArray($dbEntries);
	 	return $entries;
	}
	
	/**
	 * @method allModelsOnWarehouse()
	 * Return array of all models. 
	 * Each model is dictionary.
	 */
	public function allModelsOnWarehouse()
	{
		return $this->modelsOnWarehouseWithPredicate("1");
	}
}

?>