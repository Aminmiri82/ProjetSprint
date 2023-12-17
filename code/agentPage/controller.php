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

function ctlgetClientInfoById($client_id){
    return getClientInfoById($client_id);
}
function ctlafficheracceuil(){
    return afficheracceuil();
    
}
function ctlshowUsername(){
    return showUsername();
    
}
function ctlshowEverything($everything){
    return showEverything($everything);
    
}
function ctlshowClientInfo($clientInfo){
    return showClientInfo($clientInfo);
}
function ctlshowString($string){
    return showString($string);
}
function ctlshowArray($array){
    return showArray($array);
}


function ctlmodifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate){
    if (!empty($client_id)){
        modifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate);
    }else{
        echo "please fill in the cleint id field";
    }
   
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
function ctlgetEmployeeByClientId($client_id, $detailLevel = 0) {

    return getEmployeeByClientId($client_id, $detailLevel);
}
function ctlAssignEmployeeToClient($employee_id, $client_id){
    if (!empty($employee_id) && !empty($client_id)) {
        assignEmployeeToClient($employee_id, $client_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlchangeOverdraft($account_id, $new_overdraft){
    if (!empty($account_id) && !empty($new_overdraft)) {
        changeOverdraft($account_id, $new_overdraft);
    }else{
        echo "please fill in all the fields";
    }
}



function ctladdRdv($client_id, $employee_id, $motive_id, $date, $time_slot){
    if (!empty($client_id) && !empty($employee_id) && !empty($motive_id) && !empty($date) && !empty($time_slot)) {
        return addRdv($client_id, $employee_id, $motive_id, $date, $time_slot);
    }else{
        echo "please fill in all the fields";
    }
}

function ctlgetDocumentsByMotiveId($motive_id){
    if (!empty($motive_id)) {
        return getDocumentsByMotiveId($motive_id);
    }else{
        echo "please fill in all the fields";
    }
}