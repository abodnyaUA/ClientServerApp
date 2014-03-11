<?php

include_once "../ServerAPI/JSON.php";
include_once "../Base/Environment.php";
include_once "../Base/Log.php";
include_once "../Database/DBController.php";
include_once "../Configurator/DBTriggersConfigurator.php";
include_once "../Configurator/DBTablesConfigurator.php";
include_once "../Configurator/DBConnectionsConfigurator.php";
include_once "../Configurator/DBInsertConfigurator.php";

class DBConfigurator 
{
	/*************** Base Init *****************/
	
	protected static $_instance;
	private function __construct() {}
	private function __clone() {}
	
	public static function sharedConfigurator()
	{
		if (null === self::$_instance)
		{
			$instance = self::$_instance = new self();
			
			enableDebugMode(1);
			setReturnCharacter("<br>");
		}
		return self::$_instance;
	}
	
	public function configure()
	{
		$this->setBase();
		DBTriggersConfigurator::setupTrigers();
		DBTablesConfigurator::createTables();
		DBConnectionsConfigurator::connectTables();
	}
	
	public function dropDataBase()
	{
		DBInsertConfigurator::dropInserts();
		DBTablesConfigurator::dropTables();
	}
	
	private function setBase()
	{
		$command = "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\"; 
					SET time_zone = \"+00:00\";";
		DBController::sharedController()->executeSimpleCommand($command);		
	}
}

// DBConfigurator::sharedConfigurator()->dropDataBase();
// DBConfigurator::sharedConfigurator()->configure();

?>