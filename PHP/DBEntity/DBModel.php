<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/DBEntity/DBEntity.php";

class DBModel extends DBEntity
{
	public $modelID;
	public $model_name;
	public $model_archived;
	public $price;
	public $count;
	public $model_updateDate;
	
	function toArray() 
	{
		return array("modelID" => $this->modelID, 
				"model_name" => $this->model_name, 
				"model_archived" => $this->model_archived,
				"model_updateDate" => $this->model_updateDate,
				"price" => $this->price);
	}
}

?>