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
   
            $content = rtrim($content, ' | ');
            $content .= '</li>';
        }
        $content .= '</ul>';
    } else {
        $content = 'No entries found.';
    }

    return $content;
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
function showArray($array) {
    $content = '';

    if (is_array($array) && !empty($array)) {
        $content .= '<ul>';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $content .= '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . showArray($value) . '</li>';
            } else {
                $content .= '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . '</li>';
            }
        }
        $content .= '</ul>';
    } else {
        $content = 'Empty or invalid array.';
    }

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

