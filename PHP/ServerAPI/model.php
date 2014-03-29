<?php
/**
 * Server API.
 * Request "Model".
 * Type: GET.
 * Parameters:
 * update_date - date of creation entry in DB. If it's empty, return all models
 * Response:
 * Models on warehouse.
 */

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/ServerAPI/JSON.php";

$updateDate = $_GET["update_date"];
$models = "";
if (!empty($updateDate))
{
	$predicate = "model_updateDate > :updateDate";
	$parameters = array ("updateDate" => $updateDate);
	$models = DBController::sharedController()->fetch->model->withPredicate($predicate,$parameters);
}
else
{
	$models = DBController::sharedController()->fetch->model->all();
}
echo sendSuccessResponse($models->arrayPHP());

?>