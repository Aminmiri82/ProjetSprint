<?php
require_once('connect.php');

$employeeId = isset($_GET['employee_id']) ? intval($_GET['employee_id']) : null;

if ($employeeId === null) {
    // Handle the case where employee_id is not provided
    echo json_encode(['error' => 'Employee ID not provided']);
    exit();
}

function getConnect(){
    $connexion = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BDD, USER, PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

$query = "SELECT * FROM rdv WHERE employee_id = :employeeId";
$connexion = getConnect();
$stmt = $connexion->prepare($query);
$stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as &$row) {
    $row['time_slot'] = date('H:i', strtotime($row['time_slot']));
}

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}

$stmt->closeCursor();

