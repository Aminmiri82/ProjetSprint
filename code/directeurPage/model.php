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
function updateEmployeeCredentials($employee_id, $new_username, $new_password) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to update the username and password for the specified employee_id
    $query = "UPDATE sprint_database.employee 
              SET username = :new_username, password = :new_password 
              WHERE employee_id = :employee_id";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_username', $new_username);
    $stmt->bindParam(':new_password', $new_password);  // Consider hashing the password

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Employee credentials updated successfully!";
    }
}
function addMotive($text_box, $type) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // Determine the motive name based on the type
    if ($type == 0) {
        $motive_name = "Opening a new " . $text_box . " account";
    } else if ($type == 1) {
        $motive_name = "Opening a new " . $text_box . " contract";
    } else {
        echo "Invalid type provided.";
        return null;
    }

    // SQL query to insert a new record into the motive table
    $query = "INSERT INTO sprint_database.motive (motive_name) VALUES (:motive_name)";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':motive_name', $motive_name);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        // Get the last inserted ID (motive_id)
        $motive_id = $connexion->lastInsertId();
        echo "Motive added successfully with ID: " . $motive_id;
        return $motive_id;
    }
}

function addCompteType($type_name, $motive_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to insert a new record into the comptetype table
    $query = "INSERT INTO sprint_database.comptetype (type_name, motive_id) 
              VALUES (:type_name, :motive_id)";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':type_name', $type_name);
    $stmt->bindParam(':motive_id', $motive_id);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Compte type added successfully!";
    }
}
function updateCompteType($comptetype_id, $text_box) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to update the type_name for the specified comptetype_id
    $query = "UPDATE sprint_database.comptetype 
              SET type_name = :type_name 
              WHERE comptetype_id = :comptetype_id";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);
    $stmt->bindParam(':type_name', $text_box);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        // Success message
        echo "Compte type updated successfully!";
    }
}

function deleteCompteTypeById($comptetype_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the row with the specified comptetype_id
    $query = "DELETE FROM sprint_database.comptetype WHERE comptetype_id = :comptetype_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':comptetype_id', $comptetype_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Compte type with ID $comptetype_id deleted successfully!";
    }
}
function addContratType($contrattype_name, $motive_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to insert a new record into the contrattype table
    $query = "INSERT INTO sprint_database.contrattype (contrattype_name, motive_id) 
              VALUES (:contrattype_name, :motive_id)";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':contrattype_name', $contrattype_name);
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Contrat type added successfully!";
    }
}
function updateContratType($contrattype_id, $text_box) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to update the contrattype_name for the specified contrattype_id
    $query = "UPDATE sprint_database.contrattype 
              SET contrattype_name = :contrattype_name 
              WHERE contrattype_id = :contrattype_id";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':contrattype_id', $contrattype_id, PDO::PARAM_INT);
    $stmt->bindParam(':contrattype_name', $text_box);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Contrat type updated successfully!";
    }
}
function deleteContratTypeById($contrattype_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the row with the specified contrattype_id
    $query = "DELETE FROM sprint_database.contrattype WHERE contrattype_id = :contrattype_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':contrattype_id', $contrattype_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Contrat type with ID $contrattype_id deleted successfully!";
    }
}
function addDocumentAndGetId($document_name) {
    $connexion = getConnect();  

    // SQL query to insert a new record into the documents table
    $query = "INSERT INTO sprint_database.documents (document_name) VALUES (:document_name)";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':document_name', $document_name);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
        return null;
    } else {
        // Get the last inserted ID (documents_id)
        $documents_id = $connexion->lastInsertId();
        echo "Document added successfully with ID: " . $documents_id;
        return $documents_id;
    }
}
function addMotiveDocument($motive_id, $documents_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to insert a new record into the motive_documents table
    $query = "INSERT INTO sprint_database.motive_documents (motive_id, documents_id) 
              VALUES (:motive_id, :documents_id)";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Motive document association added successfully!";
    }
}
function updateDocumentName($documents_id, $new_name) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to update the document_name for the specified documents_id
    $query = "UPDATE sprint_database.documents 
              SET document_name = :new_name 
              WHERE documents_id = :documents_id";

    // Prepare the query
    $stmt = $connexion->prepare($query);

    // Bind parameters
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_name', $new_name);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Document name updated successfully!";
    }
}
function deleteMotiveDocumentSingle($motive_id, $documents_id) {
    $connexion = getConnect(); 

    // SQL query to delete the row where both motive_id and documents_id match
    $query = "DELETE FROM sprint_database.motive_documents 
              WHERE motive_id = :motive_id AND documents_id = :documents_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':motive_id', $motive_id, PDO::PARAM_INT);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Motive document association deleted successfully!";
    }
}
function deleteDocumentAssociationMulti($documents_id) {
    $connexion = getConnect(); 

    // SQL query to delete all rows with the specified documents_id
    $query = "DELETE FROM sprint_database.motive_documents 
              WHERE documents_id = :documents_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "All associations with documents_id $documents_id deleted successfully!";
    }
}

function deleteDocumentById($documents_id) {
    $connexion = getConnect();  // Assuming getConnect() returns a PDO connection

    // SQL query to delete the row with the specified documents_id
    $query = "DELETE FROM sprint_database.documents WHERE documents_id = :documents_id";

    // Prepare and bind parameters
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':documents_id', $documents_id, PDO::PARAM_INT);

    // Execute the query and check for success
    $success = $stmt->execute();

    if (!$success) {
        // Handle error
        echo "Error: " . implode(", ", $stmt->errorInfo());
    } else {
        // Success message
        echo "Document with ID $documents_id deleted successfully!";
    }
}










