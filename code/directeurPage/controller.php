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
    return afficheracceuil();
    
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
function ctldeleteCompteTypeAndAssociations($comptetype_id){
    if (!empty($comptetype_id)) {
        deleteCompteTypeAndAssociations($comptetype_id);
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
function ctldeleteContratTypeAndAssociations($contratTypeId) {
    if (!empty($contratTypeId)) {
        deleteContratTypeAndAssociations($contratTypeId);
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
function ctladdDocumentAndGetId($document_name){
    if (!empty($document_name)) {
        return addDocumentAndGetId($document_name);
    }else{
        echo "please fill in all the fields";
    }
}
function ctladdMotiveDocument($motive_id, $documents_id){
    if (!empty($motive_id) && !empty($documents_id)) {
        addMotiveDocument($motive_id, $documents_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlupdateDocumentName($documents_id, $new_name){
    if (!empty($documents_id) && !empty($new_name)) {
        updateDocumentName($documents_id, $new_name);
    }else{
        echo "please fill in all the fields";
    }
}
function ctldeleteMotiveDocumentSingle($motive_id, $documents_id){
    if (!empty($motive_id) && !empty($documents_id)) {
        deleteMotiveDocumentSingle($motive_id, $documents_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctldeleteDocumentAssociationMulti($documents_id){
    if (!empty($documents_id)) {
        deleteDocumentAssociationMulti($documents_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctldeleteDocumentById($documents_id){
    if (!empty($documents_id)) {
        deleteDocumentById($documents_id);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlcountContractsBetweenDates($startDate, $endDate){
    if (!empty($startDate) && !empty($endDate)) {
        return countContractsBetweenDates($startDate, $endDate);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlcountApprovedRdvsBetweenDates($startDate, $endDate){
    if (!empty($startDate) && !empty($endDate)) {
        return countApprovedRdvsBetweenDates($startDate, $endDate);
    }else{
        echo "please fill in all the fields";
    }
}

function ctlcountUniqueClientsBeforeDate($endDate){
    if (!empty($endDate)) {
        return countUniqueClientsBeforeDate($endDate);
    }else{
        echo "please fill in all the fields";
    }
}
function ctlcalculateTotalBalance(){
    return calculateTotalBalance();
}
