<?php
/**
 * Server API.
 * Request "Model".
 * Type: GET.
 * Parameters:
 * creation_date - date of creation entry in DB. If it's empty, return all models
 * Response:
 * Models on warehouse.
 */

include_once "../Database/DBController.php";
include_once "../ServerAPI/JSON.php";

$creationDate = $_GET["creation_date"];
$models = "";
if (!empty($creationDate))
{
	$predicate = "model_creationDate > :creationDate";
	$parameters = array ("creationDate" => $creationDate);
	$models = DBController::sharedController()->fetch->model->withPredicate($predicate,$parameters);
}
else
{
	$models = DBController::sharedController()->fetch->model->all();
}
echo sendSuccessResponse($models);

?>