<?php
require_once("controller.php");
try {
    if (isset($_POST['login'])) {
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        ctllogin ($username, $password);

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
            ctldeleteCompteTypeById($comptetype_id);
        }
    }
    ctlafficheracceuil();
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}