<?php
	// Серверный контроллер //
	include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";

	// Подготовка данных //
	$models = DBController::sharedController()->fetch->model->all()->arrayObjectsOfType("DBModel");

	// Подключение шаблона //
	include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/models.php";
?>