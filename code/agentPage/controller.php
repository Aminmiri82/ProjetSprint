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
function ctlClientModification($client_id){
    $clientInfo = getClientInfoById($client_id);
    showClientInfo($clientInfo);
}
function ctlgetClientInfoById($client_id){
    return getClientInfoById($client_id);
}
function ctlafficheracceuil(){
    return afficheracceuil();
    
}
function ctlshowUsername(){
    return showUsername();
    
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
function ctlgetOverdraft($account_id){
    return getOverdraft($account_id);
}
function ctlgetContractInfoByAccountId($account_id){
    return getContractInfoByAccountId($account_id);
}
function ctlgetCompteTypeInfoByClientId($client_id){
    return getCompteTypeInfoByClientId($client_id);
}
function ctldeposit($account_id, $amount, $current_balance){
    if (!empty($amount) && !empty($account_id)) {
        deposit($account_id, $amount, $current_balance);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlwithdraw($account_id, $amount, $current_balance, $overdraft) {
    if (!empty($amount) && !empty($account_id) ) {
        $new_balance = $current_balance - $amount;
        
        if ($new_balance < -$overdraft) {
            echo "Withdrawal exceeds overdraft limit. Transaction not allowed.";
        
        } else {
            withdraw($account_id, $new_balance);}
    }
    else{
        echo "please fill in all the fields";
    }  
}
function ctlgetClientIdByLastNameAndBirthday($last_name, $birthdate){
    
        return getClientIdByLastNameAndBirthday($last_name, $birthdate);
        
}
function ctlgetEmployeeByClientId($client_id){
    return getEmployeeByClientId($client_id);
}