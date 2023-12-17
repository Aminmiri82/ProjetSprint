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

function showClientInfo($clientInfo){
    $content = '';

    if ($clientInfo) {
        $content .= "<ul>";
        foreach ($clientInfo as $key => $value) {
            $content .= "<li><strong>$key:</strong> $value</li>";
        }
        $content .= "</ul>";
    } else {
        $content = "Client not found";
    }

    return $content;
}

function showEverything($everything){
    $content = '';
    if ($everything) {
        $content .= '<ul>';
        foreach ($everything as $row) {
            $content .= '<li>';
            foreach ($row as $key => $value) {
                $content .= '<strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . ' | ';
            }
            // Remove the trailing ' | ' for each line
            $content = rtrim($content, ' | ');
            $content .= '</li>';
        }
        $content .= '</ul>';
    } else {
        $content = 'No entries found.';
    }

    return $content;
}

function showString($string){
    $content = '';
    
    $content .=  $string;
    
    return $content;
}