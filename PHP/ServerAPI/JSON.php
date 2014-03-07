<?php
/**
 * @method JSONLog
 * Response title as JSON dictionary with 1 key-value pair.
 */

function JSONLog($title,$message)
{
	$json = json_encode(array ($title => $message));
	echo $json;
}

/**
 * @method JSONErrorLog
 * Response error as JSON dictionary with 1 key-value pair.
 */
function JSONErrorLog($message)
{
	JSONLog("error", $message);	
}

/**
 * @method sendSuccessResponse
 * Response error as JSON dictionary with 1 key-value pair.
 * @param $data
 * Array of fetched objects as dictionaries
 */
function sendSuccessResponse($data)
{
	$json = json_encode(array ("status" => "1","data" => $data));
	echo $json;
}

/**
 * @method sendFailureResponse
 * Response error as JSON dictionary with 1 key-value pair.
 * @param $error
 * Error description
 */
function sendFailureResponse($error)
{
	$json = json_encode(array ("status" => "0","error" => $error));
	echo $json;
}
?>