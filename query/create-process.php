<?php
session_start();
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once "../include/helper.functions.php";
require_once(dirname(__FILE__) . '/../include/class.mailer.php');

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

$companyId = $resultDetails['company_id'];
$modeSalary = $resultDetails['mode_of_salary'];
$pincode = $resultDetails['pincode'];
$salary_bank_id = $resultDetails['salary_bank_id'];
if($result_cust_data['current_work_exp'] )
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
$ccwetext = '';
if($ccweget > 0){
    $ccwetext = 'CWE '.$ccweget.' Months';
}

$twetext = '';
if($tweget > 0){
    $twetext = 'TWE '.$tweget.' Months';
}

 $maildata = '<table style="border: 1;border-collapse: collapse;" border="1"><tr><th style="background: aliceblue;">SML Lead ID</th><td>'.$query_id.'</td></tr>
        <tr><th style="background: aliceblue;">Customer</th><td>'.ucfirst($resultDetails['name']).'<br>'.$resultDetails['phone_no'].'<br>'.$resultDetails['email'].'<br>'.$city_name.'<br>'.$resultDetails['dob'].'</td></tr><tr><th style="background: aliceblue;">Occupation</th><td>'.$occup_name.' @ '.$compnm.' NTH Rs. '.$resultDetails['income'].'<br> Paid By '.$modesal.' '.$bnknm.'<br> '.$ccwetext.' '.$twetext.'</td></tr><tr><th style="background: aliceblue;">Loan Amount / Type</th><td>'.$resultDetails['loan_amount'].' Personal Loan</td></tr><tr><th style="background: aliceblue;">Residential Address</th><td>'.$resultDetails['address'].'</td></tr><tr><th style="background: aliceblue;">SML User</th><td>'.$_SESSION['userDetails']['user_name'].'</td></tr></table>';

foreach($explpat As $patners){
    $getAppDetails = mysqli_query($Conn1,"select * from crm_query_application where crm_query_id = '".$query_id."' and bank_id ='".$patners."'");
    $exisdetails = mysqli_num_rows($getAppDetails);
    if ($exisdetails == 0){
        $createApp = mysqli_query($Conn1,"Insert into crm_query_application set crm_query_id = '".$query_id."', bank_id ='".$patners."', applied_amount='".$loanAmount."',application_status=34,user_id='".$user_id."'");  
        $email = array('bharat.bhushan@switchmyloan.in','raghav9609@gmail.com');
        $subject = 'Lead Id '.$query_id.' '.ucfirst($resultDetails['name']).' '.$city_name.' '.$resultDetails['loan_amount'];
        if(!empty($email)){
            $recep_mail = $email;
            $replytomail = array();
            $cctomail = array('chintan@switchmyloan.in','durwang@switchmyloan.in');
            $mailresp = mailSend($recep_mail,$cctomail,$replytomail,$subject,htmlspecialchars_decode($maildata));
        }
    } 
}
echo '1';
//print_r($_REQUEST);
?>
