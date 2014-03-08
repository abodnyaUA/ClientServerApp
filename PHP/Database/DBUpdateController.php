<?php

include_once "../Database/DBController.php";

class DBUpdateController 
{
	public function reciever($recieverID, $name, $count, $price, $archived)
	{
		//TODO
	}
	
	public function modelToWarehouse($modelID, $name, $count, $price, $archived)
	{
		//TODO
	}
	
	public function addModelToOrder($modelID, $orderID, $count)
	{
		//TODO
	}
	
	public function removeModelFromOrder($modelID, $orderID, $count)
	{
		//TODO
	}
	
	public function changeModelCountInOrder($modelID, $orderID, $count)
	{
		//TODO
	}
}

?>