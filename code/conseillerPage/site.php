<?php
require_once("controller.php");
try {
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

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
    if (isset($_POST['sell_a_new_contract'])){
        $client_id = $_POST['selectedClientForContrat'];
        $contrattype_id = $_POST['selectedContratType'];
        $price = $_POST['price'];
        $opening_date = $_POST['opening_date_contrat'];
        $contrat_id = ctladdContrat($price, $opening_date);
        ctlassignClientToContrat($client_id, $contrat_id);
        ctlassignContratTypeToContrat($contrat_id, $contrattype_id);
    }
    if (isset($_POST['open_a_new_account'])){
        $client_id = $_POST['selectedClientForAccount'];
        $comptetype_id = $_POST['selectedAccountType'];
        $overdraft = $_POST['overdraft'];
        $opening_date = $_POST['opening_date_account'];
        $compte_id = ctladdCompte($overdraft, $opening_date);
        ctlassignClientToCompte($client_id, $compte_id);
        ctlassignCompteTypeToCompte($compte_id, $comptetype_id);
    }
    if (isset($_POST['cancel_account'])){
        $client_id = $_POST['client_id'];
        $compte_id = $_POST['compte_id'];
        ctldeleteCompteTypeAssignmentById($compte_id);
        ctldeleteClientCompteAssignment($client_id, $compte_id);
        ctldeleteCompteById($compte_id);
    }
    if (isset($_POST['cancel_contract'])){
        $client_id = $_POST['client_id'];
        $contrat_id = $_POST['contract_id'];
        ctldeleteContratTypeAssignmentById($contrat_id);
        ctldeleteClientContratAssignment($client_id, $contrat_id);
        ctldeleteContratById($contrat_id);
    }

  
    
    $headercontent = ctlshowUsername();
    $contenu = ctlafficheracceuil();
    
    
    include_once('template.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}