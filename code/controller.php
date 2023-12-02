<?php
require_once("model.php");
require_once("view.php");
function ctllogin($username, $password) {
    if (userExists($username, $password)) {
        echo "Bienvenue $username";
    } else {
        echo "Erreur d'authentification";
    }
    afficheracceuil();
}