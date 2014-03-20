<?php

include_once "../DBEntity/DBModel.php";
include_once "../DBEntity/DBReciever.php";
include_once "../DBEntity/DBOrder.php.php";
include_once "../Database/DBController.php";

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

class DBOrderFetcher
{
	/**
	 * Fetch orders from database with condition "WHERE $predicate".
	 * @param String $predicate
	 * Condition for fetching
	 * @param Array $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of orders. Each order is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		// Problem is: doesn't fetch orders without models //
		$command = "SELECT * FROM `".databaseName()."`.`Model`,
		`".databaseName()."`.`Order`,
		`".databaseName()."`.`ModelOrder` WHERE
		`ModelOrder`.modelID = `Model`.modelID AND
		`ModelOrder`.orderID = `Order`.orderID AND ".$predicate;
		$result = DBController::sharedController()->execute($command, $parameters);
		return $result;
	}

	/**
	 * Each order is dictionary.
	 * @return array of all orders.
	 */
	public function all()
	{
		return $this->withPredicate("1", null);
	}

	public function withID($id)
	{
		$array = $this->withPredicate("`Order`.orderID = :orderID", array ("orderID" => $id));
		return $array;//count($array) > 0 ? $array[0] : null;
	}

	public function withReciever($id)
	{
		$array = $this->withPredicate("`Order`.recieverID = :recieverID", array ("recieverID" => $id));
		return $array;
	}

	public function withModel($id)
	{
		$array = $this->withPredicate("`Model`.modelID = :modelID", array ("modelID" => $id));
		return $array;
	}

	public function withModelAndOrderID($modelID, $orderID)
	{
		$array = $this->withPredicate("`Order`.orderID = :orderID and `Model`.modelID = :modelID",
			array ("orderID" => $orderID, "modelID" => $modelID));
		return count($array) > 0 ? $array[0] : null;
	}
}

class DBModelFetcher
{
	/**
	 * Fetch models from database with condition "WHERE $predicate".
	 * @param String $predicate
	 * Condition for fetching
	 * @param Array $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of models. Each model is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		$command = "SELECT * FROM `".databaseName()."`.`Model`,
		`".databaseName()."`.`Warehouse` WHERE
		`Warehouse`.modelID = `Model`.modelID and ".$predicate;
		$result = DBController::sharedController()->execute($command, $parameters);
		return $result;
	}

	/**
	 * @return array of all models on warehouse (including archivated and active). Each model is dictionary.
	 */
	public function all()
	{
		return $this->withPredicate("1", null);
	}

	public function withID($id)
	{
		$array = $this->withPredicate(
			"`Model`.modelID = :modelID", array ("modelID" => $id))->arrayObjectsOfType("DBModel");
		return count($array) > 0 ? $array[0] : null;
	}
}

class DBRecieverFetcher
{
	/**
	 * Fetch recievers from database with condition "WHERE $predicate".
	 * @param String $predicate
	 * Condition for fetching
	 * @param Array $parameters
	 * Parameters for SQL Request in Key-Value Array format
	 * @return Array of recievers. Each reciever is dictionary.
	 */
	public function withPredicate($predicate, $parameters)
	{
		$command = "SELECT * FROM `".databaseName()."`.`Reciever` WHERE ".$predicate;
		$result = DBController::sharedController()->execute($command, $parameters);
		return $result;
	}

	/**
	 * @return array of all orders. Each order is dictionary.
	 */
	public function all()
	{
		return $this->withPredicate("1",null);
	}

	public function withID($id)
	{
		$array = $this->withPredicate(
			"`Reciever`.recieverID = :recieverID", 
			array ("recieverID" => $id))->arrayObjectsOfType("DBReciever");
		return count($array) > 0 ? $array[0] : null;
	}
}

?>