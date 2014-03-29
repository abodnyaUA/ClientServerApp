<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
$models = DBController::sharedController()->fetch->model->all()->arrayObjectsOfType("DBModel");
?>