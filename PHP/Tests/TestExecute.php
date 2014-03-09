<?php

include_once "../Database/DBController.php";
include_once "../Base/Log.php";

enableDebugMode(1);
setReturnCharacter("<br>");

logSeparateLine();
logLine("Execute (Use \"prepare\" method for security). Parameters as key-value-array");
logSeparateLine();
$command = "SELECT * FROM `".databaseName()."`.`Model` WHERE modelID = :modelID";
$parameters = array ("modelID" => "74");
$result = DBController::sharedController()->execute($command, $parameters);
logObject("Request Result", $result);

logSeparateLine();
logLine("Execute (Use \"bindValue\" method for security). Parameters as value-array");
logSeparateLine();
$command = "SELECT * FROM `".databaseName()."`.`Model` WHERE modelID = ?";
$parameters = array ("74");
$result = DBController::sharedController()->execute($command, $parameters);
logObject("Request Result", $result);

logSeparateLine();
logLine("Execute simple request (without parameters and security)");
logSeparateLine();
$command = "SELECT CURRENT_USER()";
$result = DBController::sharedController()->executeWithoutParameters($command);
logObject("Request Result", $result);

?>