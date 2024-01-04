<?php
require_once("synthese_functions.php");
if (isset($_GET['client_id']) && !empty($_GET['client_id'])) {
    $clientId = $_GET['client_id'];
    $result=getClientInfoById($clientId);
    if ($result) {
        error_log(print_r($result, true)); 
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Failed to fetch data']);
    }
}