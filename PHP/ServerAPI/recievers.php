<?php
/**
 * Server API.
 * Request "Recievers".
 * Type: GET.
 * Parameters:
 * none
 * Response:
 * Recievers in recievers' list.
 */

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/ServerAPI/JSON.php";

$recieverDate = $_GET["reciever_date"];
$recievers = "";
if (!empty($orderDate))
{
	$predicate = "recieverUpdateDate > :recieverDate";
	$parameters = array ("recieverUpdateDate" => $recieverDate);
	$recievers = DBController::sharedController()->fetch->reciever->withPredicate($predicate, $parameters);
}
else
{
	$recievers = DBController::sharedController()->fetch->reciever->all();
}
echo sendSuccessResponse($recievers->arrayPHP());

?>