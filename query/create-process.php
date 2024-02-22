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

echo "Select qry.net_income as income,qry.loan_amount, cust.* from crm_query As qry Inner JOIN crm_customer As cust qry.crm_customer_id = cust.id where qry.id = '".$query_id."'";

die();

//print_r($_REQUEST);
?>
