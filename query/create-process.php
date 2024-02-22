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
$getcustdetails = mysqli_query($Conn1,"Select qry.net_income as income,qry.loan_amount, cust.* from crm_query As qry Inner JOIN crm_customer As cust qry.crm_customer_id = cust.id where qry.id = '".$query_id."'");
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

$companyId = $resultDetails['company_id'];
$modeSalary = $resultDetails['mode_of_salary'];
$pincode = $resultDetails['pincode'];
$salary_bank_id = $resultDetails['salary_bank_id'];
$ccweget = dateDiff($curDate,$result_cust_data['current_work_exp'],1);
$tweget = dateDiff($curDate,$result_cust_data['total_work_exp'],1);
$bnknm = '';
if($salary_bank_id > 0){
    $bankfetch = get_name('master_code_id',$salary_bank_id);
    $bnknm = $bankfetch['value'];
} 

if($companyId > 0){
    $compnmfetch = get_name('comp_name',$companyId);
    $compnm = $compnmfetch['company_name'];
} else {
    $compnm = $resultDetails['company_name'];
}
$modesal = 'Transfer to Bank';
if($modeSalary > 0){
    $salarymode = get_name('master_code_id',$modeSalary);
    $modesal = $salarymode['value'];
}


echo $maildata = '<table><tr><th>SML Lead ID</th><td>'".$query_id."'</td></tr>
        <tr><th>Customer</th><td>'".$resultDetails['name']."'<br>'".$resultDetails['phone_no']."'<br>'".$resultDetails['email']."'<br>'".$city_name."'<br>'".$resultDetails['dob']."'</td></tr><tr><th>Occupation</th><td>'".$occup_name."' @ '".$compnm."' NTH Rs. '".$resultDetails['income']."'<br> Paid By '".$modesal."' '".$bnknm."'<br> CWE '".$ccweget."' Months TWE '".$tweget."' Months</td></tr><tr><th>Loan Amount / Type</th><td>'".$resultDetails['loan_amount."' Personal Loan</td></tr><tr><th>Residential Address</th><td>'".$resultDetails['address']."'</td></tr><tr><th>SML User</th><td>'".$_SESSION['userDetails']['user_name']."'</td></tr></table>';

foreach($explpat As $patners){
    $getAppDetails = mysqli_query($Conn1,"select * from crm_query_application where crm_query_id = '".$query_id."' and bank_id ='".$patners."'");
    $exisdetails = mysqli_num_rows($getAppDetails);
    if ($exisdetails == 0){
        $createApp = mysqli_query($Conn1,"Insert into crm_query_application set crm_query_id = '".$query_id."', bank_id ='".$patners."', applied_amount='".$loanAmount."',application_status=34,user_id='".$user_id."'");  
    } 
}
echo '1';
//print_r($_REQUEST);
?>
