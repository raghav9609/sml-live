<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

$query_id = base64_decode($_REQUEST['query_id']);
$type = ($_REQUEST['type']);
$stage_one_id = base64_decode($_REQUEST['stgOneHitId']);
$stage_two_id = base64_decode($_REQUEST['stgTwoHitId']);
$otp = base64_decode($_REQUEST['otp']);
if(in_array($type,array(1,2)) && $query_id > 0){
    $get_customerData = mysqli_query($Conn1,"select * from crm_query as qry INNER JOIN crm_customer as customer ON qry.crm_customer_id = customer.id where qry.id = ".$query_id);
    $result = mysqli_fetch_array($get_customerData);
    $header = array('content-type:application/x-www-form-urlencoded');
    $apitype = 'NORMAL';
    if($type == 1){
        $apitype = 'CUSTOM';
    }
    $url_otp_gen = "https://ecvuat.experian.in/ECV-P2/content/validateMobileOTP.action";
   echo $content_otp_gen = 'stgOneHitId='.$stage_one_id.'&stgTwoHitId='.$stage_two_id.'&mobileNo='.$result['phone_no'].'&type='.$apitype.'&otp='.$otp;
    $response_otpgeneration = curl_helper($url_otp_gen,$header,$content_otp_gen);
    $resp_otp_gen  = json_decode($response_otpgeneration,true);
    if($resp_otp_gen['showHtmlReportForCreditReport'] != "" && $resp_otp_gen['showHtmlReportForCreditReport'] != "null"  && $resp_otp_gen['showHtmlReportForCreditReport'] != null){
        $resp_otp_gen['errorString'] = "Report Generated Successfully";
        mysqli_query($Conn1,"Insert into crm_experian_data set query_id='".$query_id."',xml_report='".base64_encode($resp_otp_gen['showHtmlReportForCreditReport'])."'");
    }
    echo json_encode(array("errorstring"=>$resp_otp_gen['errorString'],"stgOneHitId"=>$jsonDecodeResp['stgOneHitId'],"stgTwoHitId"=>$jsonDecodeResp['stgTwoHitId']));
}

?>