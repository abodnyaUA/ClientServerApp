<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");

logSeparateLine();
logLine("Execute (Use \"prepare\" method for security). Parameters as key-value-array");
logSeparateLine();
$command = "SELECT * FROM `".databaseName()."`.`Model` WHERE price > :price";
$parameters = array ("price" => "7");
$result = SQL($command, $parameters);
//logObject("Request Result (OBJECTS)", $result->arrayObjectsOfType('DBModel'));
logObject("Request Result (ARRAY)", $result->arrayPHP());

logSeparateLine();
logLine("Execute (Use \"prepare\" method for security). Parameters as key-value-array");
logSeparateLine();
$command = "SELECT * FROM `".databaseName()."`.`Model` WHERE price > :price";
$parameters = array ("price" => "7");
$result = SQL($command, $parameters);
logObject("Request Result (OBJECTS)", $result->arrayObjectsOfType('DBModel'));
//logObject("Request Result (ARRAY)", $result->arrayPHP());

logSeparateLine();
logLine("Execute (Use \"bindValue\" method for security). Parameters as value-array");
logSeparateLine();
$command = "SELECT * FROM `".databaseName()."`.`Model` WHERE price > ?";
$parameters = array ("7");
$result = DBController::sharedController()->executeWithBindParameters($command, $parameters);
while ($entry = $result->next()) 
{
	logObject("Request Result : ", $entry);
}

logSeparateLine();
logLine("Execute simple request (without parameters and security)");
logSeparateLine();
$command = "SELECT CURRENT_USER()";
$result = DBController::sharedController()->executeWithoutParameters($command);
logObject("Request Result", $result);

?>