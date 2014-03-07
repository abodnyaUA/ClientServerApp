<?php
error_reporting(E_ALL);
include_once '../ServerAPI/JSON.php';

$dbLink = null;
/**
 * Connect PHP Server to MySQL Server.
 */
function connectToDatabase()
{
	global $dbLink;
	$databaseName = 'db_management';
	$host = '127.0.0.1';
	$dsn = 'mysql:dbname='.$databaseName.';host='.$host;
	$user = 'root';
	$password =  '41236555zx';
	
	try 
	{
	    $dbLink = new PDO($dsn, $user, $password);
	} 
	catch (PDOException $e) 
	{
	    echo 'Connection failed: ' . $e->getMessage();
	}
	
	if (null == $dbLink) 
	{
		JSONErrorLog('Error while connecting to MySQL: '.mysql_error());
		die();
	}
}

/**
 * Execute MySQL command.
 * Connect to database if it's not connected to it.
 */
function executeCommand($command)
{	
	global $dbLink;
	if (null == $dbLink)
	{
		connectToDatabase();
	}
	try 
	{
		
		$result = $dbLink->query($command);
		$result->setFetchMode(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) 
	{
	    echo 'Request failed: ' . $e->getMessage();
	}
	return $result;
}

?>