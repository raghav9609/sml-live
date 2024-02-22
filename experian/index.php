<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');

$query_id = base64_decode($_REQUEST['query_id']);
$type = ($_REQUEST['type']);

if(in_array($type,array(1,2)) && $query_id > 0){
    $get_customerData = mysqli_query($Conn1,"select * from crm_query as qry INNER JOIN crm_customer as customer ON qry.crm_customer_id = customer.id where qry.id = ".$query_id);
    $result = mysqli_fetch_array($get_customerData);
$header = array('content-type:application/x-www-form-urlencoded');
if($type == 1){

    $name = explode(" ",trim($result['name']));

    if(count($name) > 0 && count($name) != ""){
        $lastname = str_replace($name[0],"",trim($result['name']));
    }else{
        $lastname = trim($result['name']);
    }
    $url = "https://ecvuat.experian.in/ECV-P2/content/registerEnhancedMatchMobileOTP.action";
    $content = 'clientName=SWITCH_EM&allowInput=1&allowEdit=1&allowCaptcha=1&allowConsent=1&allowEmailVerify=1&allowVoucher=1&voucherCode=SWITCHMYLOANTkqRs&firstName='.$name[0].'&surName='.trim($lastname).'&mobileNo='.$result['phone_no'].'&email='.$result['email_id'].'&noValidationByPass=0&emailConditionalByPass=1';
    $apitype= "CUSTOM";
} else if($type == 2){
    $gender = 1;
    if($result['gender'] > 0){
        $gender = $result['gender'];
    }
    if($result['city_id'] > 0){
        $get_city_name = get_name('city_id',$result['city_id']);
        $city_name = $get_city_name['city_name'];
        $state_id = $get_city_name['state_id'];
    }

    if($city_name == ""){
        $city_name = "Others";
    }

    $get_experian_state_id = mysqli_query($Conn1,"select * from crm_experian_sml_state_mapping where sml_state_id = '".$state_id."'");
    $result_exp = mysqli_fetch_array($get_experian_state_id);
    
    
    $url = "https://ecvuat.experian.in/ECV-P2/content/registerSingleActionMobileOTP.action";
        $gender = $result['gender'];
        $content = 'clientName=SWITCH_FM&allowInput=1&allowEdit=1&allowCaptcha=1&allowConsent=1&allowVoucher=1&allowConsent_additional=1&allowEmailVerify=1&voucherCode=SWITCHMYLOANTkqRs&emailConditionalByPass=1&firstName='.$name[0].'&middleName=&surName='.trim($lastname).'&dateOfBirth='.date("d-M-Y",strtotime($result['dob'])).'&gender='.$gender.'&mobileNo='.$result['phone_no'].'&telephoneNo=&telephoneType=0&email='.$result['email_id'].'&flatno='.$city_name.'&buildingName=&roadName=&city='.$city_name.'&state='.$result_exp['experian_state_id'].'&pincode='.$result['pincode'].'&pan='.$result['pan_no'].'&passport=&aadhaar=&voterid=&driverlicense=&rationcard=&reason=&novalidationbypass=0';
    $apitype= "NORMAL";
}
 $response = curl_helper($url,$header,$content);
$jsonDecodeResp = json_decode($response,true);
if($jsonDecodeResp['stgOneHitId'] != "" && $jsonDecodeResp['stgTwoHitId'] != ""){
    $url_otp_gen = "https://ecvuat.experian.in/ECV-P2/content/generateMobileOTP.action";
    $content_otp_gen = 'stgOneHitId='.$jsonDecodeResp['stgOneHitId'].'&stgTwoHitId='.$jsonDecodeResp['stgTwoHitId'].'&mobileNo='.$result['phone_no'].'&type='.$apitype;
    $response_otpgeneration = curl_helper($url_otp_gen,$header,$content_otp_gen);
    $resp_otp_gen  = json_decode($response_otpgeneration,true);
    echo json_encode(array("apistatus"=>$resp_otp_gen['otpGenerationStatus'],"errorstring"=>$resp_otp_gen['errorString'],"stgOneHitId"=>$jsonDecodeResp['stgOneHitId'],"stgTwoHitId"=>$jsonDecodeResp['stgTwoHitId']));
    
}else{
    echo json_encode(array("apistatus"=>0,"errorstring"=>$jsonDecodeResp['errorString'],"stgOneHitId"=>$jsonDecodeResp['stgOneHitId'],"stgTwoHitId"=>$jsonDecodeResp['stgTwoHitId']));
}
}

?>