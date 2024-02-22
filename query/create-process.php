<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";

$partnerId = $_REQUEST['partner_id'];
$query_id = $_REQUEST['query_id'];
$explpat = explode(',',$partnerId);
$user_id = $_REQUEST['user_id'];
$loanAmount = $_REQUEST['loan_amount'];

if($user_role == 3){
   $user_id = $_SESSION['userDetails']['user_id']; 
}

$getcustdetails = mysqli_query($Conn1,"Select qry.net_income as income,qry.loan_amount, cust.* from crm_query As qry Inner JOIN crm_customer As cust ON qry.crm_customer_id = cust.id where qry.id = '".$query_id."'");
$resultDetails = mysqli_fetch_array($getcustdetails);
$city_name = '';
if($resultDetails['city_id'] > 0){
    $getcitynm = get_name('city_id',$resultDetails['city_id']);
    $city_name = $getcitynm['city_name'];
}

$occup_name = '';
if($resultDetails['occupation_id'] > 0){
    $occup_namenm = get_name('master_code_id',$resultDetails['occupation_id']);
    $occup_name = $occup_namenm['value'];
}
echo "anu";

//print_r($_REQUEST);
?>
