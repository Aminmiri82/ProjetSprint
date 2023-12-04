<?php
require_once("controller.php");
try {
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

    }
    if (isset($_POST['search'])){
        $client_id = $_POST['client_id'];
        ctlClientModification($client_id);

    }
    if (isset($_POST['modify'])){
        $client_id = $_POST['client_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street_number = $_POST['street_number'];
        $street_name = $_POST['street_name'];
        $postal_code = $_POST['postal_code'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $profession = $_POST['profession'];
        $family_situation = $_POST['family_situation'];
        modifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation);
    }
    if (isset($_POST['viewEverythinng'])){
        $client_id = $_POST['client_id'];
        $info= getClientInfoById($client_id);
        $account = ctlgetCompteTypeInfoByClientId($client_id);
        $contrat = ctlgetContractInfoByAccountId($client_id);
        $assigned_employee = ctlgetEmployeeByClientId($client_id);
        showClientInfo($info);
        showEverything($contrat);
        showEverything($account);
        
        
        
    }
    if (isset($_POST['search_for_accounts'])){
        $client_id = $_POST['client_id'];
        $accounts_in_possesion=  ctlgetAccountsById($client_id);
        $accounts_in_users_possesion= ctlshowAccountsInPossesion($accounts_in_possesion);
    }
    if (isset($_POST['deposit'])){
        $account_id = $_POST['account_id'];
        $amount = $_POST['amount'];
        $current_balance = ctlgetAccountBalance($account_id);
        ctldeposit($account_id, $amount, $current_balance);
    }
    if (isset($_POST['withdraw'])){
        $account_id = $_POST['account_id'];
        $amount = $_POST['amount'];
        $current_balance = ctlgetAccountBalance($account_id);
        $overdraft = ctlgetOverdraft($account_id);
        ctlwithdraw($account_id, $amount, $current_balance, $overdraft);
    }
    if (isset($_POST['search_name'])){
        $last_name = $_POST['last_name'];
        $birthdate = $_POST['birthday'];
        $client_id=ctlgetClientIdByLastNameAndBirthday($last_name, $birthdate);
        $info= getClientInfoById($client_id);
        showClientInfo($info);
    }
  
    
    $headercontent = ctlshowUsername();
    $contenu = ctlafficheracceuil();
    
    
    include_once('template.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}