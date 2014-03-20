<?php

include_once "../DBEntity/DBEntity.php";

class DBOrder extends DBEntity
{
	/* Model */
	public $modelID;
	public $model_name;
	public $model_archived;
	public $price;
	
	/* ModelOrder */
	public $count;
	public $model_updateDate;
	public $modelOrderID;
	
	/* Order */
	public $orderID;
	public $orderDate;
	public $order_archived;
	public $recieverID;
	
	function toArray() 
	{
		return array(
				"modelID" => $this->modelID,
				"model_name" => $this->model_name,
				"model_archived" => $this->model_archived,
				"model_updateDate" => $this->model_updateDate,
				"price" => $this->price,
				"modelOrderID" => $modelOrderID,
				"orderID" => $orderID,
				"orderDate" => $orderDate,
				"order_archived" => $order_archived,
				"recieverID" => $recieverID);
	}
}

?>