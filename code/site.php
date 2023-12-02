<?php
require_once("controller.php");
try {
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

    }
    afficheracceuil();
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}