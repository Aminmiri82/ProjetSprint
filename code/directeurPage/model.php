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
function updateEmployeeCredentials($employee_id, $new_username, $new_password) {
    $connexion = getConnect(); 

   
    $query = "UPDATE sprint_database.employee 
              SET username = :new_username, password = :new_password 
              WHERE employee_id = :employee_id";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_username', $new_username);
    $stmt->bindParam(':new_password', $new_password); 


    $success = $stmt->execute();

    if (!$success) {
  
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Employee credentials updated successfully!";
    }
}
function addMotive($text_box, $type) {
    $connexion = getConnect();  

    if ($type == 0) {
        $motive_name = "Opening a new " . $text_box . " account";
    } else if ($type == 1) {
        $motive_name = "Opening a new " . $text_box . " contract";
    } else {
        echo "Invalid type provided.";
        return null;
    }


    $query = "INSERT INTO sprint_database.motive (motive_name) VALUES (:motive_name)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':motive_name', $motive_name);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {

        $motive_id = $connexion->lastInsertId();
        echo "Motive added successfully with ID: " . $motive_id;
        return $motive_id;
    }
}

function addCompteType($type_name, $motive_id) {
    $connexion = getConnect(); 


    $query = "INSERT INTO sprint_database.comptetype (type_name, motive_id) 
              VALUES (:type_name, :motive_id)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':type_name', $type_name);
    $stmt->bindParam(':motive_id', $motive_id);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Compte type added successfully!";
    }
}
function updateCompteType($comptetype_id, $text_box) {
    $connexion = getConnect(); 


    $query = "UPDATE sprint_database.comptetype 
              SET type_name = :type_name 
              WHERE comptetype_id = :comptetype_id";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);
    $stmt->bindParam(':type_name', $text_box);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {

        echo "Compte type updated successfully!";
    }
}
function deleteCompteTypeAndAssociations($comptetype_id) {
    $connexion = getConnect(); 

    try {
       
        $connexion->beginTransaction();

        
        $selectQuery = "SELECT compte_id FROM comptetype_compte_assignment WHERE comptetype_id = :comptetype_id";
        $selectStmt = $connexion->prepare($selectQuery);
        $selectStmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);
        $selectStmt->execute();
        $compteIds = $selectStmt->fetchAll(PDO::FETCH_COLUMN);

     
        $query1 = "DELETE FROM comptetype_compte_assignment WHERE comptetype_id = :comptetype_id";
        $stmt1 = $connexion->prepare($query1);
        $stmt1->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);
        $stmt1->execute();

        if ($compteIds) {
 
            foreach ($compteIds as $compteId) {
                $query2 = "DELETE FROM client_compte_assignment WHERE compte_id = :compte_id";
                $stmt2 = $connexion->prepare($query2);
                $stmt2->bindParam(':compte_id', $compteId, PDO::PARAM_INT);
                $stmt2->execute();
            }

      
            foreach ($compteIds as $compteId) {
                $query3 = "DELETE FROM compte WHERE compte_id = :compte_id";
                $stmt3 = $connexion->prepare($query3);
                $stmt3->bindParam(':compte_id', $compteId, PDO::PARAM_INT);
                $stmt3->execute();
            }
        }

        
        $connexion->commit();
        echo "Compte type and associated records deleted successfully!";
    } catch (PDOException $e) {
  
        $connexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
}



function deleteCompteTypeById($comptetype_id) {
    $connexion = getConnect(); 

   
    $query = "DELETE FROM sprint_database.comptetype WHERE comptetype_id = :comptetype_id";

    
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {
     
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Compte type with ID $comptetype_id deleted successfully!";
    }
}
function addContratType($contrattype_name, $motive_id) {
    $connexion = getConnect();  

  
    $query = "INSERT INTO sprint_database.contrattype (contrattype_name, motive_id) 
              VALUES (:contrattype_name, :motive_id)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':contrattype_name', $contrattype_name);
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Contrat type added successfully!";
    }
}
function updateContratType($contrattype_id, $text_box) {
    $connexion = getConnect(); 


    $query = "UPDATE sprint_database.contrattype 
              SET contrattype_name = :contrattype_name 
              WHERE contrattype_id = :contrattype_id";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':contrattype_id', $contrattype_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrattype_name', $text_box);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Contrat type updated successfully!";
    }
}
function deleteContratTypeAndAssociations($contratTypeId) {
    $connexion = getConnect();  

    try {

        $connexion->beginTransaction();


        $selectQuery = "SELECT contrat_id FROM contrattype_contrat_assignemnt WHERE contrat_type_id = :contratTypeId";
        $selectStmt = $connexion->prepare($selectQuery);
        $selectStmt->bindParam(':contratTypeId', $contratTypeId, PDO::PARAM_INT);
        $selectStmt->execute();
        $contratIds = $selectStmt->fetchAll(PDO::FETCH_COLUMN);


        $query1 = "DELETE FROM contrattype_contrat_assignemnt WHERE contrat_type_id = :contratTypeId";
        $stmt1 = $connexion->prepare($query1);
        $stmt1->bindParam(':contratTypeId', $contratTypeId, PDO::PARAM_INT);
        $stmt1->execute();

        if ($contratIds) {

            foreach ($contratIds as $contratId) {
                $query2 = "DELETE FROM client_contrat_assignment WHERE contrat_id = :contratId";
                $stmt2 = $connexion->prepare($query2);
                $stmt2->bindParam(':contratId', $contratId, PDO::PARAM_INT);
                $stmt2->execute();
            }

            foreach ($contratIds as $contratId) {
                $query3 = "DELETE FROM contrat WHERE contrat_id = :contratId";
                $stmt3 = $connexion->prepare($query3);
                $stmt3->bindParam(':contratId', $contratId, PDO::PARAM_INT);
                $stmt3->execute();
            }
        }

      
        $connexion->commit();
        echo "Contrat type and associated records deleted successfully!";
    } catch (PDOException $e) {

        $connexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

function deleteContratTypeById($contrattype_id) {
    $connexion = getConnect(); 


    $query = "DELETE FROM sprint_database.contrattype WHERE contrattype_id = :contrattype_id";


    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':contrattype_id', $contrattype_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
     
        echo "Contrat type with ID $contrattype_id deleted successfully!";
    }
}
function addDocumentAndGetId($document_name) {
    $connexion = getConnect();  


    $query = "INSERT INTO sprint_database.documents (document_name) VALUES (:document_name)";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':document_name', $document_name);


    $success = $stmt->execute();

    if (!$success) {
     
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        
        $documents_id = $connexion->lastInsertId();
        echo "Document added successfully with ID: " . $documents_id;
        return $documents_id;
    }
}
function addMotiveDocument($motive_id, $documents_id) {
    $connexion = getConnect();  


    $query = "INSERT INTO sprint_database.motive_documents (motive_id, documents_id) 
              VALUES (:motive_id, :documents_id)";


    $stmt = $connexion->prepare($query);

  
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Motive document association added successfully!";
    }
}
function updateDocumentName($documents_id, $new_name) {
    $connexion = getConnect(); 


    $query = "UPDATE sprint_database.documents 
              SET document_name = :new_name 
              WHERE documents_id = :documents_id";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_name', $new_name);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Document name updated successfully!";
    }
}
function deleteMotiveDocumentSingle($motive_id, $documents_id) {
    $connexion = getConnect(); 


    $query = "DELETE FROM sprint_database.motive_documents 
              WHERE motive_id = :motive_id AND documents_id = :documents_id";


    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Motive document association deleted successfully!";
    }
}
function deleteDocumentAssociationMulti($documents_id) {
    $connexion = getConnect(); 


    $query = "DELETE FROM sprint_database.motive_documents 
              WHERE documents_id = :documents_id";


    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "All associations with documents_id $documents_id deleted successfully!";
    }
}

function deleteDocumentById($documents_id) {
    $connexion = getConnect();  


    $query = "DELETE FROM sprint_database.documents WHERE documents_id = :documents_id";


    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);


    $success = $stmt->execute();

    if (!$success) {

        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {

        echo "Document with ID $documents_id deleted successfully!";
    }
}

function countContractsBetweenDates($startDate, $endDate) {
    $connexion = getConnect(); 


    $query = "SELECT COUNT(*) FROM contrat 
              WHERE open_date >= :start_date AND open_date <= :end_date";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);


    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}
function countApprovedRdvsBetweenDates($startDate, $endDate) {

    $connexion = getConnect();


    $query = "SELECT COUNT(*) FROM rdv 
              WHERE approved = 1 AND date BETWEEN :start_date AND :end_date";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);


    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count;
}

function countUniqueClientsBeforeDate($endDate) {

    $connexion = getConnect();


    $query = "SELECT COUNT(DISTINCT client_compte_assignment.client_id) as client_count 
              FROM client_compte_assignment 
              JOIN compte ON client_compte_assignment.compte_id = compte.compte_id 
              WHERE compte.open_date <= :end_date";


    $stmt = $connexion->prepare($query);


    $stmt->bindParam(':end_date', $endDate);


    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['client_count'];
}
function calculateTotalBalance() {

    $connexion = getConnect();


    $query = "SELECT SUM(balance) as total_balance FROM compte";


    $stmt = $connexion->prepare($query);


    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_balance'];
}













