<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');

$query_id = $_REQUEST['query_id'];
$get_applicationcreated = mysqli_query($Conn1,"Select bank_id from crm_query_application where crm_query_id = '".$query_id."'");
$createdApplications = array();
while($resultApp = mysqli_fetch_array($get_applicationcreated)){
    $createdApplications[] = $resultApp['bank_id'];
}

$getqrydetails =  mysqli_query($Conn1,"Select * from crm_query As qry Inner JOIN crm_customer As cust ON qry.crm_customer_id = qry.id where qry.id = '".$query_id."'");
$resqrydets = mysqli_fetch_array($getqrydetails);

$companyId = $resqrydets['company_id'];
$modeSalary = $resqrydets['mode_of_salary'];
$pincode = $resqrydets['pincode'];

if($companyId > 0){
    $compnmfetch = get_name('comp_name',$companyId);
    $compnm = $compnmfetch['company_name'];
} else {
    $compnm = $resqrydets['company_name'];
}
$modesal = 'Bank Transfer';
if($modeSalary > 0){
    $salarymode = get_name('master_code_id',$modeSalary);
    $modesal = $salarymode['value'];
    if($modeSalary == 6){
        $modesal = 'Bank Transfer';
    }
}

//print_r($createdApplications);
$qry1 = "select * from crm_masters where crm_masters_code_id = 10 and is_active = 1 ";
$res = mysqli_query($Conn1, $qry1) or die("Error: " . mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res); 
if ($recordcount > 0) {
    $record = 0;
    while ($exe_form = mysqli_fetch_array($res)) {
        $record++;
        $disablcls = '';
        $textclas = '';
        if(in_array($exe_form['id'],$createdApplications)){
            $disablcls = 'checked disabled';
            $textclas = 'green bold';
        }
        $data_bnk[] = '<input type ="checkbox" style="position: unset !important;" class="check_bank" name = "check_bank[]" id = "check_bank_'.$exe_form['id'].'" value ="'.$exe_form['id'].'" '.$disablcls.'><label class="cursor '.$textclas.'" for="check_bank_'.$exe_form['id'].'">'.$exe_form['value'].'</label>&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    echo implode($data_bnk);
}

$fetch_bureau_report = mysqli_query($Conn1,"Select xml_report from crm_experian_data where query_id = '".$query_id."' order by id desc LIMIT 1");
$result_bureau = mysqli_fetch_array($fetch_bureau_report);
$xml_report = (base64_decode($result_bureau['xml_report']));
$dob = date('d-m-Y',strtotime($resqrydets['dob']));
$breURL = 'bre.switchmyloan.in/v1/bre/personal-loans/offers-new';
        $content = '{
            "cibilScore" : 0,
                "loanAmount":'.$resqrydets['loan_amount'].',
                "netIncomeDeclared":'.$resqrydets['net_income'].',
                "dob":"'.$dob.'",
                "companyName":"'.$compnm.'",
                "salaryTransferMode" :"'.$modesal.'",
                "tenure":0,
                "obligationsDeclared":0,
                "pinCode":"'.$pincode.'",
                "creditReportXml":"'.$xml_report.'",
                "netIncomeDeclaredBankStatement":"'.$resqrydets['net_income'].'",
                "obligationsBankStatement": 0
            }';

         $header = array('content-type:application/json');
echo $response = curl_helper($breURL,$header,$content);
?>