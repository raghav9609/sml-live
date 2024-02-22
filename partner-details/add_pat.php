<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
 $pat = $_REQUEST['partner_name'];

if($_REQUEST['rm_phone'] != ''){
	$qry_pat = mysqli_query($Conn1,"select * from crm_partner_rm_sm_details where partner_id = '".$pat."' and city_id='".$_REQUEST['city_name']."' and loan_type='".$_REQUEST['loan_type']."' and mobile_no='".$_REQUEST['rm_phone']."' and agent_type = '".$_REQUEST['executive_type']."'");
	 $result = mysqli_num_rows($qry_pat);
} else {
     $result = 1;
}

	if(($result == 0 ) && ($_REQUEST['rm_name'] != '' || $_REQUEST['rm_phone'] != '' || $_REQUEST['rm_email'] != '')){
 		$qry_partner = "Insert into crm_partner_rm_sm_details set partner_id = '".$_REQUEST['partner_name']."',loan_type='".$_REQUEST['loan_type']."',city_id= '".$_REQUEST['city_name']."', name= '".$_REQUEST['rm_name']."',mobile_no= '".$_REQUEST['rm_phone']."',email_id= '".$_REQUEST['rm_email']."',is_email_flag_active= '".$_REQUEST['rm_email_flag']."',is_sms_flag_active= '".$_REQUEST['rm_sms_flag']."', agent_type='".$_REQUEST['executive_type']."'";
 	
		$msg = "<span class='green'>Successfully Added!!!!!</span>";
 		$res_pat = mysqli_query($Conn1,$qry_partner);
      	header("location:add-partner.php?msg=".$msg);
 	} else {  
		$message = "<span class='red'>Executive Already Exist</span>";
		header("location:add-partner.php?msg=".$message);
 	}

?>


