<?php

include_once "../ServerAPI/JSON.php";
include_once "../Database/DBFetchController.php";
include_once "../Database/DBInsertController.php";

class DBController 
{
    /*************** General Operations *****************/
    
    public $fetch;
    public $insert;
    
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
    }
    
    /*************** General Methods *****************/
    
    private $databaseConnector;
    
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
    
    public function execute($command, $parameters)
    {
    	$result = $this->databaseConnector->prepare($command);
    	$result->setFetchMode(PDO::FETCH_ASSOC);
    	$result->execute($parameters);
//     	var_dump($parameters);
//     	var_dump($result);
    	return $result;
    }
    
    public function executeWithBindParameters($command, $parameters)
    {
    	$result = $this->databaseConnector->query($command);
    	$result->setFetchMode(PDO::FETCH_ASSOC);
    	return $result;
    }
    
    /*************** Additional Methods *****************/
    
    public function PHPArrayFromDBArray($dbArray)
    {
    	$entries = array();
    	while ($entry = $dbArray->fetch())
    	{
    		foreach ($entry as $key=>$value)
    		{
    			// Remove fake entry
    			if (is_numeric($key))
    			{
    				unset($entry[$key]);
    			}
    		}
    		array_push($entries, $entry);
    	}
    	return $entries;
    }
}
?>