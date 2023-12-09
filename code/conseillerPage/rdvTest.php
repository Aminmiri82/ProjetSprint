<?php
require_once ('connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

$connexion = getConnect();
$query = "SELECT * FROM test";
$stmt = $connexion->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Adjust the time format and remove milliseconds
foreach ($result as &$row) {
    $row['timeSlot'] = date('H:i', strtotime($row['timeSlot']));
}

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}

$stmt->closeCursor();