<?php
require_once("model.php");
require_once("view.php");
function ctllogin($username, $password) {
    if (userExists($username, $password)) {
        
        header('Location: ../tp4/site.php');
    } else {
        echo "Erreur de login";
        
    }
    afficheracceuil();
}
function ctlafficheracceuil(){
    afficheracceuil();
    
}