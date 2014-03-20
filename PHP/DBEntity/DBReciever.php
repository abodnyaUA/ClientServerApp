<?php

include_once "../DBEntity/DBEntity.php";

class DBReciever extends DBEntity
{
	public $account;
	public $adress;
	public $reciever_archived;
	public $recieverID;
	public $reciever_name;
	public $phone;
	public $recieverUpdateDate;
	
	function toArray() 
	{
		return array(
				"account" => $account,
				"adress" => $adress,
				"reciever_archived" => $reciever_archived,
				"recieverID" => $recieverID,
				"reciever_name" => $reciever_name,
				"phone" => $phone,
				"recieverUpdateDate" => $recieverUpdateDate);
	}
}

?>