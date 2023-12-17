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
    $stmt = $connexion->prepare($query);


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


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':contrat_type_id', $contrat_type_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo " Contrat type assigned to contrat successfully!";
    }

    $stmt->closeCursor();
}



function addCompte($overdraft, $open_date) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.compte
              (balance, overdraft, open_date)
              VALUES
              (0, :overdraft, :open_date)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':overdraft', $overdraft, PDO::PARAM_INT);
    $stmt->bindParam(':open_date', $open_date, PDO::PARAM_STR);

    
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        $lastInsertedId = $connexion->lastInsertId();
        echo " Compte added successfully! Compte ID: $lastInsertedId";
        $stmt->closeCursor();
        return $lastInsertedId;
    }
}


function assignClientToCompte($client_id, $compte_id) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.client_compte_assignment
              (client_id, compte_id)
              VALUES
              (:client_id, :compte_id)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':compte_id', $compte_id, PDO::PARAM_INT);

    
    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo " Client assigned to compte successfully!";
    }

    $stmt->closeCursor();
}
function assignCompteTypeToCompte($compte_id, $comptetype_id) {
    $connexion = getConnect();

    $query = "INSERT INTO sprint_database.comptetype_compte_assignment
              (compte_id, comptetype_id)
              VALUES
              (:compte_id, :comptetype_id)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':compte_id', $compte_id, PDO::PARAM_INT);
    $stmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        echo "Compte type assigned to compte successfully!";
    }

    $stmt->closeCursor();
}

function deleteCompteTypeAssignmentById($compte_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete rows with the specified compte_id
    $query = "DELETE FROM sprint_database.comptetype_compte_assignment WHERE compte_id = :compte_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':compte_id', $compte_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Rows with compte_id $compte_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}

function deleteCompteById($compte_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the account with the specified compte_id
    $query = "DELETE FROM sprint_database.compte WHERE compte_id = :compte_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':compte_id', $compte_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Account with compte_id $compte_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}


function deleteClientCompteAssignment($client_id, $compte_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the row where both client_id and compte_id match
    $query = "DELETE FROM sprint_database.client_compte_assignment 
              WHERE client_id = :client_id AND compte_id = :compte_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':compte_id', $compte_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Assignment with client_id $client_id and compte_id $compte_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}

function deleteContratTypeAssignmentById($contrat_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete rows with the specified compte_id
    $query = "DELETE FROM sprint_database.contrattype_contrat_assignemnt WHERE contrat_id = :contrat_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Rows with contrat_id $contrat_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}
function deleteContratById($contrat_id) {
    $connexion = getConnect();  

    // SQL query to delete the account with the specified contrat_id
    $query = "DELETE FROM sprint_database.contrat WHERE contrat_id = :contrat_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Account with contrat_id $contrat_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}


function deleteClientContratAssignment($client_id, $contrat_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the row where both client_id and compte_id match
    $query = "DELETE FROM sprint_database.client_contrat_assignment 
              WHERE client_id = :client_id AND contrat_id = :contrat_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrat_id', $contrat_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Assignment with client_id $client_id and contrat_id $contrat_id deleted successfully!";
    }

    // Close the statement
    $stmt->closeCursor();
}
function getEmployeeByClientId($client_id, $detailLevel = 0) {
    $connexion = getConnect(); 

    if ($detailLevel == 0) {
        // Query to fetch only the assigned employee_id
        $query = "
            SELECT eca.employee_id
            FROM sprint_database.employee_client_assignment eca
            WHERE eca.client_id = :client_id;
        ";
    } else {
        // Query to fetch both employee_id and employee's last_name
        $query = "
            SELECT eca.employee_id, e.last_name
            FROM sprint_database.employee_client_assignment eca
            INNER JOIN sprint_database.employee e ON eca.employee_id = e.employee_id
            WHERE eca.client_id = :client_id;
        ";
    }

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    
    $stmt->execute();

    if ($detailLevel == 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result['employee_id'] : null;
    } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }
}
function addRdv($client_id, $employee_id, $motive_id, $date, $time_slot) {
    try {
        $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

        // SQL query to insert a new record into the rdv table
        $query = "INSERT INTO sprint_database.rdv (client_id, employee_id, motive_id, approved, `date`, time_slot) 
                  VALUES (:client_id, :employee_id, :motive_id, TRUE, :date, :time_slot)";

        // Prepare the query
        $stmt = $connexion->prepare($query);

        // Bind parameters
        $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time_slot', $time_slot);

        // Execute the query
        $stmt->execute();
        return ["success" => true, "message" => "RDV record created successfully!"];
    } catch (PDOException $e) {
        // Custom error message for specific SQLSTATE code
        if ($e->getCode() == '45000') {
            return ["success" => false, "message" => "An appointment for this employee or client at the specified time already exists. Please choose a different time or person."];
        } else {
            // Generic error message for other errors
            return ["success" => false, "message" => "Database error: " . $e->getMessage()];
        }
    }
}



function getDocumentsByMotiveId($motive_id) {
    $connexion = getConnect();  
    // SQL query to select document details based on motive_id
    $query = "
        SELECT d.documents_id, d.document_name
        FROM sprint_database.motive m
        INNER JOIN sprint_database.motive_documents md ON md.motive_id = m.motive_id
        INNER JOIN sprint_database.documents d ON d.documents_id = md.documents_id
        WHERE m.motive_id = :motive_id;
    ";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();

    // Fetch results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the statement
    $stmt->closeCursor();

    return $result;
}

function addBlockTime($employee_id, $date, $time_slot) {
    try {
        $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

        // SQL query to insert a new record into the rdv table with approved set to false
        $query = "INSERT INTO sprint_database.rdv (employee_id, `date`, time_slot, approved) 
                  VALUES (:employee_id, :date, :time_slot, 0)";

        // Prepare the query
        $stmt = $connexion->prepare($query);

        // Bind parameters
        $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time_slot', $time_slot);

        // Execute the query
        $stmt->execute();
        return ["success" => true, "message" => "Block time added successfully!"];
    } catch (PDOException $e) {
        // Custom error message for specific SQLSTATE code
        if ($e->getCode() == '45000') {
            return ["success" => false, "message" => "An existing appointment or block time conflicts with the specified time. Please choose a different time."];
        } else {
            // Generic error message for other errors
            return ["success" => false, "message" => "Database error: " . $e->getMessage()];
        }
    }
}

