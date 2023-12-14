<?php
require_once("model.php");
require_once("view.php");
function ctllogin($username, $password) {
    if (userExists($username, $password)) {
        
        header('Location: ../tp4/site.php');
    } else {
        echo "Erreur de login";
        
    }
    afficheracceuil();
}
function ctlafficheracceuil(){
    afficheracceuil();
    
}
function ctlupdateEmployeeCredentials($employee_id, $new_username, $new_password){
    if (!empty($employee_id) && !empty($new_username) && !empty($new_password)) {
        updateEmployeeCredentials($employee_id, $new_username, $new_password);
    }else{
        echo "please fill in all the fields";
    }
}
function ctladdMotive($text_box , $type){
    if (!empty($text_box) && ($type == 0)) {
        return addMotive($text_box, 0);
    }elseif (!empty($text_box) && ($type == 1)) {
        return addMotive($text_box, 1);
    }else{
        echo "please fill in all the fields";
    }
}
function ctladdAccountType($text_box, $motive_id){
    if (!empty($text_box)) {
        addCompteType($text_box, $motive_id);
    }else{
        echo "please fill in all the fields";
    }
}

function ctlupdateCompteType($comptetype_id, $text_box){
    if (!empty($comptetype_id) && !empty($text_box)) {
        updateCompteType($comptetype_id, $text_box);
    }else{
        echo "please fill in all the fields";
    }
}

function ctldeleteCompteTypeById($comptetype_id){
    if (!empty($comptetype_id)) {
        deleteCompteTypeById($comptetype_id);
    }else{
        echo "please fill in all the fields";
    }
}

function ctladdContratType($contrattype_name, $motive_id){
    if (!empty($contrattype_name)) {
        addContratType($contrattype_name, $motive_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlupdateContratType($contrattype_id, $text_box){
    if (!empty($contrattype_id) && !empty($text_box)) {
        updateContratType($contrattype_id, $text_box);
    }else{
        echo "please fill in all the fields";
    }
}
function ctldeleteContratTypeById($contrattype_id){
    if (!empty($contrattype_id)) {
        deleteContratTypeById($contrattype_id);
    }else{
        echo "please fill in all the fields";
    }
}