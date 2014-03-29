<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Configurator/DBConfigurator.php";

class DBTablesConfigurator
{
	public static function createTables()
	{
		$tablesConfigurator = new DBTablesConfigurator();
		$tablesConfigurator->createTableModel();
		$tablesConfigurator->createTableModelOrder();
		$tablesConfigurator->createTableOrder();
		$tablesConfigurator->createTableReciever();
		$tablesConfigurator->createTableWarehouse();
	}
	
	function createTableModel()
	{
		$command = "
		CREATE TABLE IF NOT EXISTS `Model` (
		  `model_archived` tinyint(1) NOT NULL,
		  `modelID` int(11) NOT NULL AUTO_INCREMENT,
		  `model_name` varchar(200) NOT NULL,
		  `price` double NOT NULL,
		  PRIMARY KEY (`modelID`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function createTableWarehouse()
	{		
		$command = "
		CREATE TABLE IF NOT EXISTS `Warehouse` (
		  `count` int(11) NOT NULL,
		  `modelID` int(11) NOT NULL,
		  `model_updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY (`modelID`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	function createTableOrder()
	{
		$command = "CREATE TABLE IF NOT EXISTS `Order` (
		  `orderID` int(11) NOT NULL AUTO_INCREMENT,
		  `order_archived` int(11) NOT NULL,
		  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  `recieverID` int(11) NOT NULL,
		  PRIMARY KEY (`orderID`),
		  KEY `recieverID` (`recieverID`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function createTableModelOrder()
	{
		$command = "
		CREATE TABLE IF NOT EXISTS `ModelOrder` (
		  `modelOrderID` int(11) NOT NULL AUTO_INCREMENT,
		  `modelID` int(11) NOT NULL,
		  `orderID` int(11) NOT NULL,
		  `count` int(11) NOT NULL,
		  `model_updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY (`modelOrderID`),
		  KEY `modelID` (`modelID`),
		  KEY `orderID` (`orderID`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function createTableReciever() 
	{
		$command = "
		CREATE TABLE IF NOT EXISTS `Reciever` (
		  `account` varchar(200) NOT NULL,
		  `adress` varchar(200) NOT NULL,
		  `reciever_archived` int(11) NOT NULL,
		  `recieverID` int(11) NOT NULL AUTO_INCREMENT,
		  `reciever_name` varchar(200) NOT NULL,
		  `phone` varchar(200) NOT NULL,
		  `recieverUpdateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  PRIMARY KEY (`recieverID`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	public static function dropTables()
	{
		$tableConfigurator = new DBTablesConfigurator();
		$tableConfigurator->dropTableWarehouse();
		$tableConfigurator->dropTableModelOrder();
		$tableConfigurator->dropTableModel();
		$tableConfigurator->dropTableOrder();
		$tableConfigurator->dropTableReciever();
	}
	
	function dropTableWarehouse() 
	{
		$command = "DROP TABLE `".databaseName()."`.`Warehouse`";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	function dropTableModelOrder()
	{
		$command = "DROP TABLE `".databaseName()."`.`ModelOrder`";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	function dropTableModel()
	{
		$command = "DROP TABLE `".databaseName()."`.`Model`";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	function dropTableOrder()
	{
		$command = "DROP TABLE `".databaseName()."`.`Order`";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	function dropTableReciever()
	{
		$command = "DROP TABLE `".databaseName()."`.`Reciever`";
		DBController::sharedController()->executeSimpleCommand($command);
	}
}