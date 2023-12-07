<?php
require_once ('connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}
function returnContrattypeOptions(){
    $connexion = getConnect();
    $query = "SELECT contrattype_id, contrattype_name FROM contrattype";  
    $stmt = $connexion->prepare($query); 
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $options = '';
    foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['contrattype_id']) . '">' . htmlspecialchars($row['contrattype_name']) . '</option>';
    }
    return $options;
}
function returnClientOptions(){
    $connexion = getConnect();
    $query = "SELECT client_id, last_name FROM client";  
    $stmt = $connexion->prepare($query); 
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $options = '';
    foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['client_id']) . '">' . htmlspecialchars($row['last_name']) . '</option>';
    }
    return $options;
}