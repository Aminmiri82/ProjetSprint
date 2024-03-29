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
    if (isset($_POST['change_employee_login'])) {
        $employee_id = $_POST['employee_id'];
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        ctlupdateEmployeeCredentials($employee_id, $new_username, $new_password);
    }
    if (isset($_POST['modify_account_types'])) {
        $comptetype_id = $_POST['account_type'];
        $action = $_POST['action'];
        $text_box = $_POST['text_box'];
        if ($action == "add") {
            $motive_id = ctladdMotive($text_box, 0);
            ctladdAccountType($text_box, $motive_id);
        }elseif ($action == "change") {
            ctlupdateCompteType($comptetype_id, $text_box);
        }elseif ($action == "delete") {
            ctldeleteCompteTypeAndAssociations($comptetype_id);
            ctldeleteCompteTypeById($comptetype_id);
        }
    }
    if (isset($_POST['modify_Contrat_types'])) {
        $contrattype_id = $_POST['Contrat_type'];
        $action = $_POST['actionC'];
        $text_box = $_POST['text_box'];
        if ($action == "add") {
            $motive_id = ctladdMotive($text_box, 1);
            ctladdContratType($text_box, $motive_id);
        }elseif ($action == "change") {
            ctlupdateContratType($contrattype_id, $text_box);
        }elseif ($action == "delete") {
            ctldeleteContratTypeAndAssociations($contrattype_id);
            ctldeleteContratTypeById($contrattype_id);
        }
    }

    if (isset($_POST['modify_documents_list'])) {
        $motive_id = $_POST['motive_id'];
        $documents_id = $_POST['documents_id'];
        $action = $_POST['actionM'];
        $text_box = $_POST['text_boxM'];
        if ($action == "add") {
            $documents_id=ctladdDocumentAndGetId($text_box);
            ctladdMotiveDocument($motive_id, $documents_id);
        }elseif ($action == "add2"){
            ctladdMotiveDocument($motive_id, $documents_id);
            
        }elseif ($action == "change") {
            ctlupdateDocumentName($documents_id, $text_box);
        }elseif ($action == "delete1") {
            ctldeleteMotiveDocumentSingle($motive_id, $documents_id);
        }elseif ($action == "delete2") {
            ctldeleteDocumentAssociationMulti($documents_id);
            ctldeleteDocumentById($documents_id);
        }
    }
    if (isset($_POST['Contract_stats'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $res=ctlcountContractsBetweenDates($start_date, $end_date);
        $C_stats="the number of contracts signed between " . $start_date ." and " .  $end_date.  " is ".ctlshowString($res);
    }
    if (isset($_POST['rdv_stats'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $res=ctlcountApprovedRdvsBetweenDates($start_date, $end_date);
        $R_stats="the total number of rdv's between " . $start_date ." and " .  $end_date.  " is ".ctlshowString($res);
    }
    if (isset($_POST['client_stats'])) {
        $end_date = $_POST['end_date'];
        $res=ctlcountUniqueClientsBeforeDate($end_date);
        $CL_stats="the total number of clients before " .  $end_date.  " was ".ctlshowString($res);
    }
    if (isset($_POST['account_stats'])) {
        $end_date = $_POST['end_date'];
        $res=ctlcalculateTotalBalance();
        $A_stats="the total balance of all accounts before " .  $end_date.  " was ".ctlshowString($res);
    }
    $headercontent = ctlshowUsername();
    
    include_once('template.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}