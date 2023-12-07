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
    return afficheracceuil();
    
}
function ctlshowUsername(){
    return showUsername();
    
}
function ctladdNewClient($first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate){
    if (!empty($first_name) && !empty($last_name) && !empty($street_number) && !empty($street_name) && !empty($postal_code) && !empty($tel) && !empty($mail) && !empty($profession) && !empty($family_situation) && !empty($birthdate)) {
        addNewClient($first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlgetAccountsById($client_id){
    return getAccountsById($client_id);
}
function ctlshowAccountsInPossesion($accounts_in_possesion){
    return showAccountsInPossesion($accounts_in_possesion);
}
function ctlgetAccountBalance($account_id){
    return getAccountBalance($account_id);
}






function ctlchangeOverdraft($account_id, $new_overdraft){
    if (!empty($account_id) && !empty($new_overdraft)) {
        changeOverdraft($account_id, $new_overdraft);
    }else{
        echo "please fill in all the fields";
    }
}
function ctladdContrat($price, $opening_date){
    if (!empty($price) && !empty($opening_date)) {
        return addContrat($price, $opening_date);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlassignClientToContrat($client_id, $contrat_id){
    if (!empty($client_id) && !empty($contrat_id)) {
        assignClientToContrat($client_id, $contrat_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlassignContratTypeToContrat($contrat_id, $contrattype_id){
    if (!empty($contrat_id) && !empty($contrattype_id)) {
        assignContratTypeToContrat($contrat_id, $contrattype_id);
    }else{
        echo "please fill in all the fields";
    }
}