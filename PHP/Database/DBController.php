<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/ServerAPI/JSON.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/DBEntity/DBSQLResult.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBFetchController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBInsertController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBUpdateController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBRemoveController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBArchivateController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Base/Environment.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Base/Log.php";

class DBController 
{
    /*************** General Operations *****************/
    
    public $fetch;
    public $insert;
    public $update;
    public $remove;
    public $archivate;
    
	/*************** Base Init *****************/
	
    protected static $_instance;
    private function __construct() { }
    private function __clone() { }
    
    public static function sharedController() 
    {
        if (null === self::$_instance) 
        {
            $instance = self::$_instance = new self();
            $instance->configure("root", "41236555zx");
            $instance->initControllers();
        }
        return self::$_instance;
    }
    
    private function initControllers()
    {
    	$this->fetch = DBFetchController::createController();
    	$this->insert = new DBInsertController();
    	$this->update = new DBUpdateController();
    	$this->remove = new DBRemoveController();
    	$this->archivate = new DBArchivateController();
    }
    
    /*************** General Methods *****************/
    
    private $databaseConnector;
    
    /**
     * Connect to Database with user and password
     * @param String $user
     * @param String $password
     */
    public function configure($user, $password)
    {
    	$databaseName = databaseName();
    	$host = host();
    	$dsn = 'mysql:dbname='.$databaseName.';host='.$host;
    	
    	try
    	{
    		$this->databaseConnector = new PDO($dsn, $user, $password);
    		$this->databaseConnector->query("SET NAMES 'utf8'");
    	}
    	catch (PDOException $e)
    	{
    		JSONErrorLog('Error while connecting to MySQL: '. $e->getMessage());
    		die();
    	}
    }
    
    /**
     * Execute MySQL request. 
     * Use "prepare" method for security.
     * @param String $command
     * @param Array $parameters
     * Request parameters in Key-Value Array format
     * @return DBSQLResult : MySQL Response in PHP Key-Value Array format
     */
    public function execute($command, $parameters)
    {
    	$result = $this->databaseConnector->prepare($command);
    	logObject("Request Parameters", $parameters);
    	logObject("Request Result", $result);
    	$result = DBSQLResult::fromPDOStatement($result);
    	$result->run($parameters); 
    	logObject("SQL",$result->sql());
    	return $result;
    }
    
    /**
     * Execute MySQL request.
     * Use "bindValue" method for security.
     * @param String $command
     * @param Array $parameters
     * Request parameters in Key-Value Array format
     * @return MySQL Response in PHP Key-Value Array format
     */
    public function executeWithBindParameters($command, $parameters)
    {
    	$result = $this->databaseConnector->prepare($command);
    	$result = DBSQLResult::fromPDOStatement($result);
    	foreach ($parameters as $key => $value)
    	{
    		$result->bindValue(($key+1), $value);
    	}
    	$result->run(); 
    	logObject("SQL",$result->sql());
    	return $result;
    }
    
    /**
     * Execute MySQL request.
     * Execute single request without parameters
     * @param String $command
     * @return MySQL Response in PHP Key-Value Array format
     */
    public function executeWithoutParameters($command)
    {
    	$result = $this->databaseConnector->query($command);
    	$result->setFetchMode(PDO::FETCH_ASSOC);
    	$entries = $result->fetchAll();
    	logObject("Request Result", $result);
    	logObject("Request Entries", $entries);
    	return $entries;
    }
    
    /**
     * Execute MySQL request without parsing and returning
     * @param String $command
     */
    public function executeSimpleCommand($command)
    {
    	$this->databaseConnector->query($command);
    }
}

function SQL($command, $parameters)
{
	return DBController::sharedController()->execute($command, $parameters);	
}

function DSQL($command, $parameters)
{
	$result = DBController::sharedController()->execute($command, $parameters);	
	echo "SQL: ".$result->sql()."<br>";
	return $result;
}
?>