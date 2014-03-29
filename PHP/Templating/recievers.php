<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
$recievers = DBController::sharedController()->fetch->reciever->all()->arrayObjectsOfType("DBReciever");
?>