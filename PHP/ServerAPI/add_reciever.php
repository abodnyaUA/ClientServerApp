<?php
/**
 * Server API.
 * Request "Add Reciever".
 * Type: GET.
 * Parameters:
 * name - Fullname. Ussually contains First name and last name, separated by "."
 * adress - Contact adress
 * phone - Contact phone number
 * account - Reciever's bank account
 * archived - If equals "1", new reciever temporary doesn't have access for new purchases
 */

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";

$phone = $_GET["phone"];
$adress = $_GET["adress"];
$name = $_GET["name"];
$account = $_GET["account"];
$archived = $_GET["archived"];

if (!empty($phone) && !empty($name) && !empty($adress) && !empty($account) &&
		(!empty($archived) || 0 == $archived))
{
	DBController::sharedController()->insert->reciever($name, $adress, $phone, $account, $archived);	
	JSONLog("success","1");
}
else
{
	sendFailureResponse("Invalid parameters");
}

?>