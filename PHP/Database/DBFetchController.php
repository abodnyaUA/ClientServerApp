<?php

include_once "../Database/DBModelFetcher.php";

class DBFetchController 
{
	public static function createController()
	{
		$controller = new DBFetchController();
		$controller -> model = new DBModelFetcher();
		return $controller;
	}
	
	public $model;
}

?>