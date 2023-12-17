<?php
require_once("loadingFunctions.php");
if (isset($_GET['client_id']) && !empty($_GET['client_id'])) {
    $clientId = $_GET['client_id'];
    echo getContracts($clientId);
}