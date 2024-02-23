<?php 

require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
$query_id = base64_decode($_REQUEST['query_id']);
$getbureaudetails = mysqli_query($Conn1,"Select * from crm_experian_data where query_id = '".$query_id."'");
    $resultbureaudetails = mysqli_fetch_array($getbureaudetails);
    $bureauData = $resultbureaudetails['xml_report'];
    if($bureauData != ''){
        $dispBureauData = base64_decode($bureauData);

        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", '$1$2$3', $dispBureauData);
        $ob= simplexml_load_string( $xml );
        echo $json  = json_encode($ob);
        $returnResponse = json_decode($json, true);
        

    }
    die();
    ?>
