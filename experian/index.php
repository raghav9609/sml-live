<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

$query_id = base64_decode($_REQUEST['query_id']);
$type = ($_REQUEST['type']);

print_r($_REQUEST);
if(in_array($type,array(1,2)) && $query_id > 0){
    echo "select * from crm_query as qry INNER JOIN crm_customer as customer ON qry.crm_customer_id = customer.id where qry.id = ".$query_id;
    $get_customerData = mysqli_query($Conn1,"select * from crm_query as qry INNER JOIN crm_customer as customer ON qry.crm_customer_id = customer.id where qry.id = ".$query_id);
    $result = mysqli_fetch_array($get_customerData);
$header = array('content-type:application/x-www-form-urlencoded');
if($type == 1){

    $name = explode(" ",trim($result['name']));
    if(count($name) > 0){
        $lastname = str_replace($name,"",trim($result['name']));
    }else{
        $lastname = trim($result['name']);
    }
    $url = "https://ecvuat.experian.in/ECV-P2/content/registerEnhancedMatchMobileOTP.action";
    echo $content = 'clientName=SWITCH_EM&allowInput=1&allowEdit=1&allowCaptcha=1&allowConsent=1&allowEmailVerify=1&allowVoucher=1&voucherCode=SWITCHMYLOANTkqRs&firstName='.$name[0].'&surName='.trim($lastname).'&mobileNo='.$result['phone_no'].'&email='.$result['email_id'].'&noValidationByPass=0&emailConditionalByPass=1';
    $apitype= "CUSTOM";
}
// else if($type == 2){
//     $url = "https://ecvuat.experian.in/ECV-P2/content/validateMobileOTP.action";
//     $apitype= "NORMAL";
// }
echo $response = curl_helper($url,$header,$content);
}

echo '<script>window.location.href = "'.$head_url.'/query/edit.php?id='.$query_id.';</script>';

?>