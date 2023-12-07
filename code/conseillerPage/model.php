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




function addNewClient($first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.client
              (first_name, last_name, street_number, street_name, postal_code, tel, mail, proffession, family_situation, birthdate)
              VALUES
              (:first_name, :last_name, :street_number, :street_name, :postal_code, :tel, :mail, :profession, :family_situation, :birthdate)";

   
    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':street_number', $street_number, PDO::PARAM_INT);
    $stmt->bindParam(':street_name', $street_name, PDO::PARAM_STR);
    $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_INT);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_INT);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':profession', $profession, PDO::PARAM_STR);
    $stmt->bindParam(':family_situation', $family_situation, PDO::PARAM_STR);
    $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);

    
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        $lastInsertedId = $connexion->lastInsertId();
        echo "New client added successfully! Client ID: $lastInsertedId";
        $stmt->closeCursor();
        return $lastInsertedId;
    }

    
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

    return $result['overdraft'] ?? null; 
}
function getContractInfoByAccountId($account_id) {
    $connexion = getConnect(); 

    $query = "
        SELECT cca.client_id, cca.contrat_id, c.contrat_tarif, c.open_date
        FROM sprint_database.client_contrat_assignment cca 
            INNER JOIN sprint_database.contrat c ON (c.contart_id = cca.contrat_id)
        WHERE cca.client_id = :account_id;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result !== false ? $result : false;
}


function deposit ($account_id, $amount, $current_balance) {
    $connexion = getConnect();  

    $query = "
        UPDATE sprint_database.compte
        SET balance = :new_balance
        WHERE compte_id = :account_id;
    ";

    $new_balance = $current_balance + $amount;

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':new_balance', $new_balance, PDO::PARAM_INT);
    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt->closeCursor();

    echo "account number $account_id now has a balance of $new_balance !";
}
function withdraw ($account_id, $new_balance) {
    $connexion = getConnect();  

    $query = "
        UPDATE sprint_database.compte
        SET balance = :new_balance
        WHERE compte_id = :account_id;
    ";

    

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':new_balance', $new_balance, PDO::PARAM_INT);
    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->execute();

    $stmt->closeCursor();

    echo "account number $account_id now has a balance of $new_balance !";
}
function getClientIdByLastNameAndBirthday($last_name, $birthdate) {
    $connexion = getConnect(); 
    
    $query = "
        SELECT client_id
        FROM sprint_database.client
        WHERE last_name = :last_name AND birthdate = :birthdate;
    ";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $result !== false ? $result['client_id'] : null;
}

function assignEmployeeToClient($employee_id, $client_id) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.employee_client_assignment
              (employee_id, client_id)
              VALUES
              (:employee_id, :client_id)";
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);

    // Execute the query
    $success = $stmt->execute();

    if (!$success) {
        echo "employee number $employee_id can not be assigned to client number:  $client_id";
    } else {
        echo "Employee number $employee_id has bee assigned to client number $client_id successfully!";
    }

    $stmt->closeCursor();
}
function changeOverdraft($account_id, $new_overdraft){
    $connexion = getConnect();

    $query = "UPDATE sprint_database.compte
              SET overdraft = :new_overdraft
              WHERE compte_id = :account_id";

    
    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_overdraft', $new_overdraft, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo "Account overdraft updated successfully!";
    }

    $stmt->closeCursor();
}


function addContrat($price, $opening_date) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.contrat
              (contrat_tarif, open_date)
              VALUES
              (:price, :opening_date)";
    $stmt = $connexion->prepare($query);

 
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':opening_date', $opening_date, PDO::PARAM_STR);

   
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        $lastInsertedId = $connexion->lastInsertId();
        
        echo "Contrat added successfully! Contrat ID: $lastInsertedId";
        $stmt->closeCursor();
        return $lastInsertedId;
    }

    
}
function assignClientToContrat($client_id, $contrat_id) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.client_contrat_assignment
              (client_id, contrat_id)
              VALUES
              (:client_id, :contrat_id)";

    // Prepare the SQL query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);

    
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo " Client assigned to contrat successfully!";
    }

    $stmt->closeCursor();
}
function assignContratTypeToContrat($contrat_id, $contrat_type_id) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.contrattype_contrat_assignemnt
              (contrat_type_id, contrat_id)
              VALUES
              (:contrat_type_id, :contrat_id)";

    // Prepare the SQL query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':contrat_type_id', $contrat_type_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);

    // Execute the query
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo " Contrat type assigned to contrat successfully!";
    }

    $stmt->closeCursor();
}





