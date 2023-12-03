<?php
require_once ('connect.php');
function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query('SET NAMES UTF8');
    return $connexion;
}

function userExists($username, $password) {
    $connexion = getConnect();
    $query = "SELECT COUNT(*) as count FROM employee WHERE username = :username AND password = :password";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    // If the count is greater than 0, the user exists
    return ($result['count'] > 0);
}
function getRoleIdByUsername($username) {
    $connexion = getConnect();
    $query = "
        SELECT rt.role_id
        FROM sprint_database.employee e 
            INNER JOIN sprint_database.employee_role_assignment era ON (era.employee_id = e.employee_id)  
            INNER JOIN sprint_database.role_types rt ON (rt.role_id = era.role_id)  
        WHERE e.username = :username;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    if ($result) {
        return $result['role_id'];
    } else {
        // Handle the case when no role is found for the given username
        return null;
    }
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

function modifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation) {
    $connexion = getConnect(); 

    $query = "UPDATE sprint_database.client
    
              SET first_name = :first_name,
                  last_name = :last_name,
                  street_number = :street_number,
                  street_name = :street_name,
                  postal_code = :postal_code,
                  tel = :tel,
                  mail = :mail,
                  proffession = :profession,
                  family_situation = :family_situation
              WHERE client_id = :client_id";

    // Prepare the SQL query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':street_number', $street_number, PDO::PARAM_INT);
    $stmt->bindParam(':street_name', $street_name, PDO::PARAM_STR);
    $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_INT);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_INT);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':profession', $profession, PDO::PARAM_STR);
    $stmt->bindParam(':family_situation', $family_situation, PDO::PARAM_STR);

    // Execute the query
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo "Client information updated successfully!";
    }
   
    $stmt->closeCursor();
}
function getEverythingById($client_id) {
    $connexion = getConnect(); 

    $query = "
        SELECT c.client_id, c.first_name, c.last_name, c.street_number, c.street_name, c.postal_code, c.tel, c.mail,
            c.proffession, c.family_situation, eca.employee_id, cca.compte_id, c1.balance, c1.open_date,
            cca1.contrat_id, c2.contrat_tarif, c2.open_date
        FROM sprint_database.client c 
            INNER JOIN sprint_database.employee_client_assignment eca ON (eca.client_id = c.client_id)
            INNER JOIN sprint_database.client_compte_assignment cca ON (cca.client_id = c.client_id)
            INNER JOIN sprint_database.compte c1 ON (c1.compte_id = cca.compte_id)
            INNER JOIN sprint_database.client_contrat_assignment cca1 ON (cca1.client_id = c.client_id)
            INNER JOIN sprint_database.contrat c2 ON (c2.contart_id = cca1.contrat_id)
        WHERE c.client_id = :client_id;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result; 
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
function getAccountBalance($account_id) {
    $connexion = getConnect();  

    $query = "
        SELECT c.balance
        FROM sprint_database.compte c 
        WHERE c.compte_id = :account_id;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result['balance'] ?? null;  // Return the account balance or null if not found
}

function getOverdraft($account_id) {
    $connexion = getConnect();  

    $query = "
        SELECT c.overdraft
        FROM sprint_database.compte c 
        WHERE c.compte_id = :account_id;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result['overdraft'] ?? null;  // Return the account balance or null if not found
}







