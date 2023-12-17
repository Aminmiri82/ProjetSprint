<?php
require_once("controller.php");
try {
    
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

    }
        if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        header('Location: ../loginPage/site.php');
        exit();
        
    }
    if (isset($_POST['search'])){
        $client_id = $_POST['client_id'];
        $current_info= ctlgetClientInfoById($client_id);
        $current_info_M=ctlshowClientInfo($current_info);

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
        $birthdate= $_POST['birthday'];
        ctlmodifyClient($client_id, $first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate);
    }
    if (isset($_POST['add_a_client'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street_number = $_POST['street_number'];
        $street_name = $_POST['street_name'];
        $postal_code = $_POST['postal_code'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $profession = $_POST['profession'];
        $family_situation = $_POST['family_situation'];
        $birthdate= $_POST['birthday'];
        ctladdNewClient($first_name, $last_name, $street_number, $street_name, $postal_code, $tel, $mail, $profession, $family_situation, $birthdate);
    }
    if (isset($_POST['viewEverythinng'])){
        $client_id = $_POST['client_id'];
        $info= ctlgetClientInfoById($client_id);
        $account = ctlgetCompteTypeInfoByClientId($client_id);
        $contrat = ctlgetContractInfoByAccountId($client_id);
        $assigned_employee = ctlgetEmployeeByClientId($client_id,1 );
        $personal_info_E=ctlshowClientInfo($info);
        $contracts_info_E=ctlshowAccountsInPossesion($contrat);
        $accounts_info_E = ctlshowAccountsInPossesion($account);
        $assigned_employee_E=ctlshowArray($assigned_employee);
        
        
        
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
        $client_info_BD= ctlshowClientInfo($info);
    }
    if (isset($_POST['submit'])) {
        $selected_employee = $_POST['selectedEmployee'];
        $selected_client = $_POST['selectedClient'];
        ctlAssignEmployeeToClient($selected_employee, $selected_client);
        
    }
    if (isset($_POST['search_for_accounts_for_overdraft'])){
        $client_id = $_POST['client_id'];
        $accounts_in_possesion=  ctlgetAccountsById($client_id);
        $accounts_in_users_possesion_overdraft= ctlshowAccountsInPossesion($accounts_in_possesion);
    }
    if (isset($_POST['change_overdraft'])){
        $account_id = $_POST['account_id'];
        $new_overdraft = $_POST['overdraft'];
        ctlchangeOverdraft($account_id, $new_overdraft);
    }
   
    if (isset($_POST['get_assigned_employee'])){
        $client_id = $_POST['client_id'];
        $assigned_employee = ctlgetEmployeeByClientId($client_id,1);
        $employee_assigned_to_client = ctlshowArray($assigned_employee);
    }
    if (isset($_POST['add_rdv'])){
        $client_id = $_POST['client_id'];
        $employee_id = $_POST['employee_id'];
        $motive_id = $_POST['motive_id'];
        $date = $_POST['date'];
        $formattedDate = date('Y-m-d', strtotime($date));
        $time = $_POST['time'];
        $result= ctladdRdv($client_id, $employee_id, $motive_id, $formattedDate, $time);
        if ($result['success']) {
          
            echo "<p class='success'>" . $result['message'] . "</p>";
            $needed_documents = ctlgetDocumentsByMotiveId($motive_id);
            $requierd_documents_rdv= ctlshowEverything($needed_documents);
        } else {
            
            echo "<p class='error'>" . $result['message'] . "</p>";
        }
    }
    $headercontent = ctlshowUsername();
    $contenu = ctlafficheracceuil();
    
    
    include_once('template.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}