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
