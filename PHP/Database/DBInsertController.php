<?php

include_once "../Database/DBController.php";

class DBInsertController 
{
	/**
	 * @method addModelToWarehouse
	 * Fetch models from database with condition "WHERE $predicate".
	 * Return Array of models. Each model is dictionary.
	 */
	public function modelToWarehouse($name, $count, $price, $archived)
	{
		// Insert new value //
		$command = "INSERT INTO `db_management`.`Model` (`model_archived`, `modelID`, `name`, `price`, `model_creationDate`) ".
				   "VALUES ('".$archived."', NULL ,  '".$name."',  '".$price."', CURRENT_TIMESTAMP);";
		DBController::sharedController()->execute($command, null);
		
		// Find it's ID //
		$dbLog = DBController::sharedController()->execute("SELECT LAST_INSERT_ID();",null);
		$modelIDArray = DBController::sharedController()->PHPArrayFromDBArray($dbLog);
		$filteredModelIDArray = array_values($modelIDArray[0]);
		$modelID = $filteredModelIDArray[0];
		
		// Confirm with Warehouse //
		$command = "INSERT INTO  `db_management`.`Warehouse` (`count`, `modelID`) VALUES ('".$count."', '".$modelID."');";
		DBController::sharedController()->execute($command, null);
	}
}

?>