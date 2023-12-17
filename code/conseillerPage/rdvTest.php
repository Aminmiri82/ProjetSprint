<?php
require_once('connect.php');

$employeeId = isset($_GET['employee_id']) ? intval($_GET['employee_id']) : null;

if ($employeeId === null) {

    echo json_encode(['error' => 'Employee ID not provided']);
    exit();
}

function getConnect(){
    $connexion = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BDD, USER, PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

$query = "SELECT r.client_id, r.employee_id, r.motive_id, r.approved, r.date, r.time_slot, m.motive_name, 
                 GROUP_CONCAT(DISTINCT d.documents_id) AS document_ids, 
                 GROUP_CONCAT(DISTINCT d.document_name SEPARATOR ', ') AS document_names
          FROM sprint_database.rdv r
          LEFT JOIN sprint_database.motive m ON r.motive_id = m.motive_id
          LEFT JOIN sprint_database.motive_documents md ON m.motive_id = md.motive_id
          LEFT JOIN sprint_database.documents d ON md.documents_id = d.documents_id
          WHERE r.employee_id = :employeeId
          GROUP BY r.rdv_id, r.client_id, r.employee_id, r.motive_id, r.approved, r.date, r.time_slot, m.motive_name";


$connexion = getConnect();
$stmt = $connexion->prepare($query);
$stmt->bindParam(':employeeId', $employeeId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as &$row) {

    $row['time_slot'] = date('H:i', strtotime($row['time_slot']));


}

if ($result) {
    error_log(print_r($result, true)); 
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}

$stmt->closeCursor();



