<?php
include '../Base/constants.php';
include '../ServerAPI/JSON.php';

/**
 * Connect PHP Server to MySQL Server.
 */
function connectToDatabase()
{
	$mysqlPassword = '41236555zx';
	$databaseName = 'db_management';

	$dbLink = mysql_connect($serverURL, "root", $mysqlPassword);
	if (null == $dbLink) 
	{
		JSONErrorLog('Error while connecting to MySQL: '.mysql_error());
		die();
	}
	
	$database = mysql_select_db($databaseName, $dbLink);
	if (null != $database) 
	{
		mysql_query("SET NAMES 'utf8'");
		mysql_query("set character_set_client='utf8'");
		mysql_query("set character_set_results='utf8'");
		mysql_query("set collation_connection='utf8'");
	}
	else
	{
		JSONErrorLog('Error while connecting to database: '.mysql_error());
		die();
	}
}

/**
 * Execute MySQL command.
 * Connect to database if it's not connected to it.
 */
function executeCommand($command)
{
	if (null == mysql_dbname())
	{
		connectToDatabase();
	}
	$result = mysql_query($command);
	return $result;
}

?>