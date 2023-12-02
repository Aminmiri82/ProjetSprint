<?php
session_start();
function afficheracceuil(){
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        
    }
    $contenu = "hello mr $username you are logged in as role $role";
    require_once('template.php');

}