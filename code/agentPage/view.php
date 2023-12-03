<?php
session_start();
function afficheracceuil(){
    $contenu= "";
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        
    }
    $contenu = "hello mr $username you are logged in as role $role";
    
    return $contenu;

}
function showUsername(){
    $headercontent= "";
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        
    }
    $headercontent = "$username you are logged in as role $role";
    
    return $headercontent;

}
function showClientInfo($clientInfo){
    if ($clientInfo) {
        echo "<ul>";
        foreach ($clientInfo as $key => $value) {
            echo "<li><strong>$key:</strong> $value</li>";
        }
        echo "</ul>";
    } else {
        echo "Client not found";
    }
}
function showEverything($everything){
    if ($everything) {
        echo '<ul>';
        foreach ($everything as $row) {
            echo '<li>';
            foreach ($row as $key => $value) {
                echo '<strong>' . $key . ':</strong> ' . $value . ' | ';
            }
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Client not found.';
    }
}
