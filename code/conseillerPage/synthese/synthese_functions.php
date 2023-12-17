<?php
require_once ('connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

function getClientInfoById($clientId) {
  $connexion = getConnect(); 

  $query = "SELECT * FROM sprint_database.client WHERE client_id = :clientId";

  $stmt = $connexion->prepare($query); 
  $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);

  $stmt->closeCursor();
  return $clientInfo;
}


function getAccountsById($client_id) {
  $connexion = getConnect();  

  $query = "
      SELECT c.compte_id, c.balance, c.overdraft, cca.client_id, cca.compte_id, c1.client_id, c1.last_name
      FROM sprint_database.compte c 
          INNER JOIN sprint_database.client_compte_assignment cca ON (cca.compte_id = c.compte_id)  
          INNER JOIN sprint_database.client c1 ON (c1.client_id = cca.client_id)  
      WHERE cca.client_id = :client_id;
  ";

  $stmt = $connexion->prepare($query);
  $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $result;  
}

function getContractInfoByAccountId($account_id) {
  $connexion = getConnect(); 

  $query = "
      SELECT cca.client_id, cca.contrat_id, c.contrat_tarif, c.open_date
      FROM sprint_database.client_contrat_assignment cca 
          INNER JOIN sprint_database.contrat c ON (c.contrat_id = cca.contrat_id)
      WHERE cca.client_id = :account_id;
  ";

  $stmt = $connexion->prepare($query);
  $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $result !== false ? $result : false;
}
