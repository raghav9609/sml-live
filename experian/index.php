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

    if(count($name) > 0 && count($name) != ""){
        $lastname = str_replace($name[0],"",trim($result['name']));
    }else{
        $lastname = trim($result['name']);
    }
    $url = "https://ecvuat.experian.in/ECV-P2/content/registerEnhancedMatchMobileOTP.action";
    echo $content = 'clientName=SWITCH_EM&allowInput=1&allowEdit=1&allowCaptcha=1&allowConsent=1&allowEmailVerify=1&allowVoucher=1&voucherCode=SWITCHMYLOANTkqRs&firstName='.$name[0].'&surName='.trim($lastname).'&mobileNo='.$result['phone_no'].'&email='.$result['email_id'].'&noValidationByPass=0&emailConditionalByPass=1';
    $apitype= "CUSTOM";

    $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $status = curl_getinfo($curl);
        echo "Resp<br><br>";
        print_r($response);
        echo "Error<br><br>";
        print_r($error);
        echo "Status<br><br>";
        print_r($status);
        curl_close($curl);
        return $response;


}
// else if($type == 2){
//     $url = "https://ecvuat.experian.in/ECV-P2/content/validateMobileOTP.action";
//     $apitype= "NORMAL";
// }
//  $response = curl_helper($url,$header,$content);

//  print_r($response);
}

echo '<script>window.location.href = "'.$head_url.'/query/edit.php?id='.$query_id.';</script>';

?>