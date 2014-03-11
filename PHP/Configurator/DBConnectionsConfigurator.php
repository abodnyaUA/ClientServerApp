<?php

include_once "../Configurator/DBConfigurator.php";

class DBConnectionsConfigurator 
{
	public static function connectTables()
	{
		$connectionsConfigurator = new DBConnectionsConfigurator();
		$connectionsConfigurator->connectModelOrder();
		$connectionsConfigurator->connectOrder();
		$connectionsConfigurator->connectWarehouse();
	}
	
	function connectModelOrder() 
	{
		$command = "
		ALTER TABLE `ModelOrder`
		  ADD CONSTRAINT `ModelOrder_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `Order` (`orderID`),
		  ADD CONSTRAINT `ModelOrder_ibfk_2` FOREIGN KEY (`modelID`) REFERENCES `Model` (`modelID`);";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function connectOrder() 
	{
		$command = "
		ALTER TABLE `Order`
 		  ADD CONSTRAINT `Order_ibfk_2` FOREIGN KEY (`recieverID`) REFERENCES `Reciever` (`recieverID`);";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
	
	function connectWarehouse()
	{
		$command = "
		ALTER TABLE `Warehouse`
  		  ADD CONSTRAINT `Warehouse_ibfk_1` FOREIGN KEY (`modelID`) REFERENCES `Model` (`modelID`);";
		DBController::sharedController()->executeSimpleCommand($command);	
	}
}

?>