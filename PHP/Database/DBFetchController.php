<?php

include_once "../Database/DBModelFetcher.php";
include_once "../Database/DBOrderFetcher.php";
include_once "../Database/DBRecieverFetcher.php";

class DBFetchController 
{
	public static function createController()
	{
		$controller = new DBFetchController();
		$controller->model = new DBModelFetcher();
		$controller->order = new DBOrderFetcher();
		$controller->reciever = new DBRecieverFetcher();
		return $controller;
	}
	
	public $model;
	public $order;
	public $reciever;
}

?>