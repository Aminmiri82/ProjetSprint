<?php
require_once ('connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}
function returnemployeeOptions(){
    $connexion = getConnect();
    $query = "SELECT employee_id, last_name FROM employee";  
    $stmt = $connexion->prepare($query); 
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $options = '';
    foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['employee_id']) . '">' . htmlspecialchars($row['last_name']) . '</option>';
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
function returnMotiveOptions(){
  $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

  $query = "SELECT motive_id, motive_name FROM sprint_database.motive";  
  $stmt = $connexion->prepare($query); 
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $options = '';
  foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['motive_id']) . '">' . htmlspecialchars($row['motive_name']) . '</option>';
  }
  return $options;
}


function getAccounts($clientId) {
  $connexion = getConnect();
  // Query to fetch compte_ids associated with the client_id
  $query = "SELECT compte_id FROM client_compte_assignment WHERE client_id = :clientId";

  $stmt = $connexion->prepare($query); 
  $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $options = '';
  foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['compte_id']) . '">' . htmlspecialchars($row['compte_id']) . '</option>';
  }
  return $options;
}
function getContracts($clientId) {
  $connexion = getConnect();
  // Query to fetch compte_ids associated with the client_id
  $query = "SELECT contrat_id FROM client_contrat_assignment WHERE client_id = :clientId";

  $stmt = $connexion->prepare($query); 
  $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $options = '';
  foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['contrat_id']) . '">' . htmlspecialchars($row['contrat_id']) . '</option>';
  }
  return $options;
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
function returnComptetypeOptions(){
$connexion = getConnect();
$query = "SELECT comptetype_id, type_name FROM comptetype";  
$stmt = $connexion->prepare($query); 
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$options = '';
foreach ($result as $row) {
  $options .= '<option value="' . htmlspecialchars($row['comptetype_id']) . '">' . htmlspecialchars($row['type_name']) . '</option>';
}
return $options;
}

function returnDocumentOptions() {
  $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

  $query = "SELECT documents_id, document_name FROM sprint_database.documents";  
  $stmt = $connexion->prepare($query); 
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $options = '';
  foreach ($result as $row) {
      $options .= '<option value="' . htmlspecialchars($row['documents_id']) . '">' . htmlspecialchars($row['document_name']) . '</option>';
  }
  return $options;
}
