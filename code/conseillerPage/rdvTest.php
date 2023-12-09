<?php
require_once('connect.php');

function getConnect(){
  $connexion = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BDD, USER, PASSWORD);
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connexion->query('SET NAMES UTF8');
  return $connexion;
}

$connexion = getConnect();
$query = "SELECT * FROM Ztest";
$stmt = $connexion->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($result as &$row) {
    $row['timeslot'] = date('H:i', strtotime($row['timeslot']));
}

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}

$stmt->closeCursor();
