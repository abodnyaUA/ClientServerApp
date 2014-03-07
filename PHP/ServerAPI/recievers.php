<?php
/*
 * Server API.
 * Request "Recievers".
 * Type: GET.
 * Parameters:
 * none
 * Response:
 * Recievers in recievers' list.
 */

include "../Database/database_fetch_reciever.php";


$recievers = allRecievers();
echo json_encode($recievers);

?>