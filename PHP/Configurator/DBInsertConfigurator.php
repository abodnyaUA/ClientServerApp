<?php

include_once "../Configurator/DBConfigurator.php";

class DBInsertConfigurator 
{
	public static function dropInserts()
	{
		$insertConfigurator = new DBInsertConfigurator();
		$insertConfigurator->dropInsertsWarehouse();
		$insertConfigurator->dropInsertsModelOrder();
		$insertConfigurator->dropInsertsModel();
		$insertConfigurator->dropInsertsOrder();
		$insertConfigurator->dropInsertsReciever();
	}
	
	function dropInsertsWarehouse() 
	{
		$command = "DELETE FROM `".databaseName()."`.`Warehouse` WHERE 1";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function dropInsertsModelOrder()
	{
		$command = "DELETE FROM `".databaseName()."`.`ModelOrder` WHERE 1";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function dropInsertsModel()
	{
		$command = "DELETE FROM `".databaseName()."`.`Model` WHERE 1";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function dropInsertsOrder()
	{
		$command = "DELETE FROM `".databaseName()."`.`Order` WHERE 1";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function dropInsertsReciever()
	{
		$command = "DELETE FROM `".databaseName()."`.`Reciever` WHERE 1";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
}

?>