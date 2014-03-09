<?php

$debug_mode = 0;
$returnCharacter = "\n";

function logDump($description,$object)
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo $description.": ";
		var_dump($object);
		echo $returnCharacter;
	}
}

function logObject($description, $array)
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo $description.": ";
		print_r($array);
		echo $returnCharacter;
	}
}

function logLine($description)
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo $description;
		echo $returnCharacter;
	}
}

function logEmptyLine()
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo $returnCharacter;
	}
}

function logSeparateLine()
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo "===================================================================";
		echo $returnCharacter;
	}
}

function logSimpleLine()
{
	global $debug_mode;
	global $returnCharacter;
	if (1 === $debug_mode)
	{
		echo "--------------------------------------------------------------------";
		echo $returnCharacter;
	}
}

function enableDebugMode($flag)
{
	global $debug_mode;
	$flag = abs(intval($flag) % 2);
	$debug_mode = $flag;
	if (1 === $debug_mode)
	{
		ini_set('display_errors',1);
		error_reporting(E_ALL);
	}
	else
	{
		ini_set('display_errors',0);
		error_reporting(0);
	}
}

function setReturnCharacter($character)
{
	global $returnCharacter;
	$returnCharacter = $character;
}

?>