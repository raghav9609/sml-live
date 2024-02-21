<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');

$query_id = base64_decode($_REQUEST['query_id']);
$type = ($_REQUEST['type']);
$stage_one_id = base64_decode($_REQUEST['stage_one_id']);
$stage_two_id = base64_decode($_REQUEST['stage_two_id']);
if(in_array($type,array(1,2)) && $query_id > 0){
 
}

?>