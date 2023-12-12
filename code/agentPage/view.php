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
function showContractInfo($result) {
    if ($result !== false) {
        echo '<ul>';
        foreach ($result as $key => $value) {
            echo '<li><strong>' . $key . ':</strong> ' . $value . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No contract information found for the specified account.';
    }
}
function showString($string){
    $content = '';
    
    $content .=  $string;
    
    return $content;
}

function showAccountsInPossesion($accounts_in_possesion){
    $content = '';

    if ($accounts_in_possesion) {
        foreach ($accounts_in_possesion as $account) {
            $content .= '<p>' . implode(' | ', array_map(function ($key, $value) {
                return '<strong>' . $key . ':</strong> ' . $value;
            }, array_keys($account), $account)) . '</p>';
        }
    } else {
        $content = 'No accounts found for the specified client.';
    }

    return $content;
}

