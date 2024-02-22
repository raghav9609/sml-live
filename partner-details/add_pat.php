<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
 $pat = $_REQUEST['partner_name'];

if($_REQUEST['rm_phone'] != ''){
	$qry_pat = mysqli_query($Conn1,"select * from tbl_bank_contact_info_new where partner_id = '".$pat."' and city_id='".$_REQUEST['city_name']."' and loan_type='".$_REQUEST['loan_type']."' and rm_mobile='".$_REQUEST['rm_phone']."'");
	 $result = mysqli_num_rows($qry_pat);
} else {
     $result = 1;
}

 if($_REQUEST['sm_phone'] != '' ){
 	$qry_pat_sm = mysqli_query($Conn1,"select * from tbl_bank_contact_info_new where partner_id = '".$pat."' and city_id='".$_REQUEST['city_name']."' and loan_type='".$_REQUEST['loan_type']."' and sm_mobile='".$_REQUEST['sm_phone']."'");
   $result_sm = mysqli_num_rows($qry_pat_sm);
 } else {
       $result_sm = 1;
 }

 
if(!empty($_REQUEST['exe_phone'])) {
	$qry_pat_exe = mysqli_query($Conn1, "select * from tbl_bank_contact_info_new where partner_id = '".$pat."' and city_id = '".$_REQUEST['city_name']."' and loan_type = '".$_REQUEST['loan_type']."' and executive_phone = '".$_REQUEST['exe_phone']."'");
	$result_exe = mysqli_num_rows($qry_pat_exe);
} else {
			$result_exe = 1;
}
 
 
  if(($result == 0 || $result_sm == 0 || $result_exe == 0) && ($_REQUEST['rm_name'] != '' || $_REQUEST['rm_phone'] != '' || $_REQUEST['rm_email'] != '' || $_REQUEST['sm_name'] != '' || $_REQUEST['sm_phone'] != '' || $_REQUEST['sm_email'] != '' || !empty($_REQUEST['exe_name']) || !empty($_REQUEST['exe_email']) || !empty($_REQUEST['exe_phone']))){
 	 $qry_partner = "Insert into tbl_bank_contact_info_new set partner_id = '".$_REQUEST['partner_name']."',loan_type='".$_REQUEST['loan_type']."',city_id= '".$_REQUEST['city_name']."'";
 	if(($result == 0) && ($_REQUEST['rm_name'] != '' || $_REQUEST['rm_phone'] != '' || $_REQUEST['rm_email'] != '' )){
 		$qry_partner .= ",rm_name= '".$_REQUEST['rm_name']."',rm_mobile= '".$_REQUEST['rm_phone']."',rm_email= '".$_REQUEST['rm_email']."',rm_emp_code='".$_REQUEST['rm_emp_code']."',rm_email_flag= '".$_REQUEST['rm_email_flag']."',rm_sms_flag= '".$_REQUEST['rm_sms_flag']."'";
 	$message = '';
 	} else if($_REQUEST['rm_phone'] != ''){
 	 $message = "<span class='red'>RM Already Exist</span>";
 	} else {
 	   $message = ''; 
 	}
 	if(($result_sm == 0) && ($_REQUEST['sm_name'] != '' || $_REQUEST['sm_phone'] != '' || $_REQUEST['sm_email'] != '')){
 		$qry_partner .= ",sm_name= '".$_REQUEST['sm_name']."',sm_email= '".$_REQUEST['sm_email']."',sm_mobile= '".$_REQUEST['sm_phone']."',sm_emp_code='".$_REQUEST['sm_emp_code']."',sm_email_flag= '".$_REQUEST['sm_email_flag']."',sm_sms_flag= '".$_REQUEST['sm_sms_flag']."'";
 	$message_sm = '';
 	} else if($_REQUEST['sm_phone'] != ''){
       $message_sm = "<span class='red'>SM Already Exist</span>";
 	} else {
 	    $message_sm = '';
 	}


if(($result_exe == 0) && (!empty($_REQUEST['exe_name']) || !empty($_REQUEST['exe_email']) || !empty($_REQUEST['exe_phone']))) {
	$qry_partner .= ", executive_name = '".$_REQUEST['exe_name']."', executive_email = '".$_REQUEST['exe_email']."', executive_phone = '".$_REQUEST['exe_phone']."'";
	$message_exe = '';
} else if(!empty($_REQUEST['sm_phone'])) {
	$message_exe = "<span class='red'>Executive Already Exist</span>";
} else {
	$message_exe = '';
}


 $msg = $message.$message_sm.$message_exe;
 if($msg == ''){
 	$msg = "<span class='green'>Successfully Added!!!!!</span>";
 }
//echo $qry_partner;
 	$res_pat = mysqli_query($Conn1,$qry_partner);
      header("location:add.php?msg=".$msg);
 } else {  
 	$message = "RM and SM Details Already Exist";
header("location:add.php?msg=".$message);
 }

?>


