<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/DBEntity/DBEntity.php";

class DBSQLResult
{
	/**
	 * 
	 * @param PDOStatement $sth
	 */
	static function fromPDOStatement($sth)
	{
		$result = new DBSQLResult();
		$result->STH = $sth;
		$result->command = $sth->queryString;
		$result->parameters = array ();
		return $result;
	}
	
	private $STH;
	private $parameters;
	private $command;
	
	const kSecureWithBind = 1;
	const kSecureWithPrepare = 2;
	
	private $secureType;
	
	/**
	 * 
	 * @return array:
	 */
	function arrayPHP() 
	{
    	$this->STH->setFetchMode(PDO::FETCH_ASSOC);
		return $this->STH->fetchAll();
	}
	
	function next()
	{
		return $this->STH->fetch();
	}
	
	function sql()
	{
		$command2 = $this->command;
		
		if ($this->secureType == self::kSecureWithPrepare)
		{
			foreach ($this->parameters as $key => $value)
			{
				$command2 = str_replace(":".$key, $value, $command2);
			}
		}
		else if ($this->secureType == self::kSecureWithBind)
		{
			foreach ($this->parameters as $value)
			{
				$pos = strpos($command2,"?");
				$command2 = substr_replace($command2, $value, $pos);
			}
		}
		return $command2;
	}
	
	function run($parameters = null)
	{
    	$this->STH->setFetchMode(PDO::FETCH_ASSOC);
		$this->STH->execute($parameters);
		if (null != $parameters)
		{
			$this->secureType = self::kSecureWithPrepare;
			$this->parameters = $parameters;
		}
	}
	
	function bindValue($number, $param)
	{
		$this->STH->bindValue($number, $param);
		array_push($this->parameters, $param);
		$this->secureType = self::kSecureWithBind;
	}
	
	/**
	 * 
	 * @param String $type
	 * @return DBEntity
	 */
	function arrayObjectsOfType($type)
	{
		$arrayPHP = $this->arrayPHP();
		$arrayObjects = array();
		foreach ($arrayPHP as $entry) 
		{
			$instance = new $type();
			foreach ($entry as $key => $value)
			{
				$instance->$key = $value;
			}
			array_push($arrayObjects, $instance);
		}
		return $arrayObjects;
	}
}

?>