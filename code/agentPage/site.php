<?php
require_once("controller.php");
try {
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

    }
    if (isset($_POST['search'])){
        $client_id = $_POST['client_id'];
        ctlClientModification($client_id);

    }
    if (isset($_POST['modify'])){
        $client_id = $_POST['client_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street_number = $_POST['street_number'];
        $street_name = $_POST['street_name'];
        $postal_code = $_POST['postal_code'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $profession = $_POST['profession'];
        $family_situation = $_POST['family_situation'];
        modifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation);
    }
    if (isset($_POST['viewEverythinng'])){
        $client_id = $_POST['client_id'];
        $everything= getEverythingById($client_id);
        showEverything($everything);
    }
    $headercontent = ctlshowUsername();
    $contenu = ctlafficheracceuil();
    
    
    include_once('template.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}