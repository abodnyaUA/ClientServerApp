<?php
include 'database_manager.php';
include 'database_conversations.php';

/*
 * @method modelsWithPredicate
 * Fetch models from database with condition "WHERE $predicate".
 * Return Array of models. Each model is dictionary.
 */
function addModelToWarehouse($name, $count, $price, $archived)
{
	// INSERT NEW VALUE //
	$command = "INSERT INTO `db_management`.`Model` (`model_archived`, `modelID`, `name`, `price`, `model_creationDate`) ".
			   "VALUES ('".$archived."', NULL ,  '".$name."',  '".$price."', CURRENT_TIMESTAMP);";
// 	echo "COMMAND1:".$command."\n\n";
	$dbLog = executeCommand($command);
	
	// FIND ITS' ID //
	$dbLog = executeCommand("SELECT LAST_INSERT_ID();");
	$modelIDArray = dbArrayToPHPArray($dbLog);
	$filteredModelIDArray = array_values($modelIDArray[0]);
	$modelID = $filteredModelIDArray[0];
	// SELECT WITH WAREHOUSE //
	$command = "INSERT INTO  `db_management`.`Warehouse` (`count`, `modelID`) VALUES ('".$count."', '".$modelID."');";
	//echo "COMMAND3:".$command."\n\n";
	$dbLog = executeCommand($command);
	
 	return $entries;
}

?>