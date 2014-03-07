<?php
include 'database_manager.php';
include 'database_conversations.php';

/*
* @method allRecievers()
* Return array of all recievers.
* Each reciever is dictionary.
*/
function allRecievers()
{
	$command = "SELECT * FROM `Reciever` WHERE 1";
	$dbLog = executeCommand($command);
	$entries = dbArrayToPHPArray($dbLog);
	return $entries;
}
?>