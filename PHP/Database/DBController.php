<?php

include_once "../ServerAPI/JSON.php";
include_once "../Database/DBFetchController.php";
include_once "../Database/DBInsertController.php";
include_once "../Database/DBUpdateController.php";

class DBController 
{
    /*************** General Operations *****************/
    
    public $fetch;
    public $insert;
    public $update;
    
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
    	$databaseName = 'db_management';
    	$host = '127.0.0.1';
    	$dsn = 'mysql:dbname='.$databaseName.';host='.$host;
    	
    	try
    	{
    		$this->databaseConnector = new PDO($dsn, $user, $password);
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
     * @return MySQL Response in PHP Key-Value Array format
     */
    public function execute($command, $parameters)
    {
    	$result = $this->databaseConnector->prepare($command);
    	$result->setFetchMode(PDO::FETCH_ASSOC);
    	$result->execute($parameters);
    	$entries = $result->fetchAll();
//     	var_dump($parameters);
//     	var_dump($result);
// 		var_dump($entries);
    	return $entries;
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
    	foreach ($parameters as $key => $value)
    	{
    		$result->bindValue(($key+1), $value);
    	}
    	$result->setFetchMode(PDO::FETCH_ASSOC);
    	$result->execute();
    	$entries = $result->fetchAll();
//     	var_dump($parameters);
//     	var_dump($result);
// 		var_dump($entries);
    	return $entries;
    }
}
?>