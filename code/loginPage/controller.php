<?php
require_once("model.php");
require_once("view.php");

function ctllogin($username, $password) {
    if (userExists($username, $password)) {
        $role = ctlgetrole($username);
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if ($role == 1) {
            header('Location: ../agentPage/site.php');
            exit();
        }
        if ($role == 2) {
            header('Location: ../conseillerPage/site.php');
            exit();
        }
        if ($role == 3) {
            header('Location: ../directeurPage/site.php');
            exit();
        }
    
    } else {
        echo "Erreur de login";
        
    }
    afficheracceuil();
}
function ctlgetrole($username){
    return getRoleIdByUsername($username);
}
function ctlafficheracceuil(){
    afficheracceuil();
    
}
