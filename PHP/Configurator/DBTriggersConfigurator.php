<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Configurator/DBConfigurator.php";

class DBTriggersConfigurator
{
	public static function setupTrigers()
	{
		$triggersConfigurator = new DBTriggersConfigurator();
		$triggersConfigurator->setupTrigerMoveModelsFromOrderToWarehouse();
		$triggersConfigurator->setupTrigerMoveModelsFromWarehouseToOrder();
		$triggersConfigurator->setupTrigerUpdateModelsCountInOrder();
		$triggersConfigurator->setupTrigerRemoveOrderWithoutModels();
	}
	
	public function setupTrigerMoveModelsFromWarehouseToOrder()
	{
		$command = "DROP TRIGGER IF EXISTS `move_models_from_warehouse_to_order`;";
		DBController::sharedController()->executeSimpleCommand($command);
		 
		$command = "
		DELIMITER //
		CREATE TRIGGER `move_models_from_warehouse_to_order` AFTER INSERT ON 
		`".databaseName()."`.`ModelOrder`
		FOR EACH ROW
		BEGIN
	
		UPDATE `".databaseName()."`.`Warehouse` SET
		`Warehouse`.count = `Warehouse`.`count` - NEW.`count`
		WHERE `Warehouse`.`modelID` = NEW.`modelID`;
			
		END
		//
		DELIMITER ;";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	public function setupTrigerMoveModelsFromOrderToWarehouse()
	{
		$command = "DROP TRIGGER IF EXISTS `move_models_from_order_to_warehouse`;";
		DBController::sharedController()->executeSimpleCommand($command);
		 
		$command = "
		DELIMITER //
		CREATE TRIGGER `move_models_from_order_to_warehouse` BEFORE DELETE ON 
		`".databaseName()."`.`ModelOrder`
		FOR EACH ROW
		BEGIN
	
		DECLARE existOrderArchived tinyint(1);
		SET existOrderArchived = (SELECT `order_archived` FROM `".databaseName()."`.`Order` 
		WHERE `".databaseName()."`.`Order`.orderID = OLD.orderID);
	
		IF existOrderArchived = 0 THEN
		UPDATE `".databaseName()."`.`Warehouse`
		SET  `Warehouse`.count = `Warehouse`.`count` + OLD.`count`
		WHERE `Warehouse`.`modelID` = OLD.`modelID`;
		END IF;
	
		END
		//
		DELIMITER ;";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	public function setupTrigerUpdateModelsCountInOrder()
	{
		$command = "DROP TRIGGER IF EXISTS `update_models_count_in_order`;";
		DBController::sharedController()->executeSimpleCommand($command);
	
		$command = "
		DELIMITER //
		CREATE TRIGGER `update_models_count_in_order` BEFORE UPDATE ON `".databaseName()."`.`ModelOrder`
		FOR EACH ROW
		BEGIN
	
		DECLARE modelsOnWarehouse int(11);
		DECLARE modelsWasInOrder int(11);
		DECLARE summaryModels int(11);
		DECLARE newOnWarehouse int(11);
	
		SET modelsOnWarehouse = (SELECT `count` FROM `".databaseName()."`.`Warehouse` 
		WHERE `".databaseName()."`.`Warehouse`.modelID = OLD.modelID);
		SET modelsWasInOrder = OLD.count;
		SET summaryModels = modelsOnWarehouse + modelsWasInOrder;
		SET newOnWarehouse = summaryModels - NEW.`count`;
	
		UPDATE `".databaseName()."`.`Warehouse`
		SET  `Warehouse`.count = newOnWarehouse
		WHERE `Warehouse`.`modelID` = OLD.`modelID`;
	
		END
		//
		DELIMITER ;";
		DBController::sharedController()->executeSimpleCommand($command);
	}
	
	public function setupTrigerRemoveOrderWithoutModels()
	{
		$command = "DROP TRIGGER IF EXISTS `remove_empty_order`;";
		DBController::sharedController()->executeSimpleCommand($command);
		
		$command = "
		DELIMITER //
		CREATE TRIGGER `remove_empty_order` AFTER DELETE ON 
		`".databaseName()."`.`ModelOrder`
		FOR EACH ROW
		BEGIN
		
		DECLARE ordersCount int(11);
		SET ordersCount = (SELECT COUNT(*) FROM `".databaseName()."`.`ModelOrder` 
		WHERE `".databaseName()."`.`ModelOrder`.orderID = OLD.orderID);
		
		IF ordersCount = 0 THEN
		DELETE FROM `".databaseName()."`.`Order` WHERE `Order`.`orderID` = OLD.orderID;
		END IF;
		
		END";
		DBController::sharedController()->executeSimpleCommand($command);
	}
}

?>