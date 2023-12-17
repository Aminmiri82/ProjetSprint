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
function returnEmployeesWithRole() {
  $connexion = getConnect();  
  $query = "
      SELECT e.employee_id, e.last_name 
      FROM employee e
      INNER JOIN employee_role_assignment era ON e.employee_id = era.employee_id
      WHERE era.role_id = 2
  ";  
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
  $connexion = getConnect();  

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