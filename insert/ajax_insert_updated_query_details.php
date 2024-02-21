<?php
require_once "../config/config.php";
require_once "../include/helper.functions.php";

$qryyy_id = $_REQUEST['query_id'];
$return_html = "";

 $qry_get_data = "select * from crm_raw_data as raw_data left join crm_query as qry on raw_data.id = qry.crm_raw_data_id where qry.id = ".$qryyy_id;
$res = mysqli_query($Conn1, $qry_get_data);
 $recordcount = mysqli_num_rows($res);
if($recordcount > 0) {
    $res_data = mysqli_fetch_array($res);
  // print_r($res_data);
    $company_nm = "";
    // $cust_id = $res_data['cust_id'];
    if($res_data['company_id'] > 0 ) {
        $company_nmfetch = get_name('comp_name',$res_data['company_id']); 
        $company_nm = $company_nmfetch['company_name']; 
    } else {
        $company_nm = $res_data['company_name'];
    }
   
    $net_incm = ($res_data['net_income'] > 0) ? $res_data['net_income'] : "--";
 
    $pan_card_get = trim($res_data['pan_no']);
    
    $pan_card = ($pan_card_get != "") ? $pan_card_get : "--";
    $salary_pay_id = (!empty($res_data['mode_of_salary'])) ? $res_data['mode_of_salary'] : "";
    
    $salry_py_mod = "--";
    if($salary_pay_id > 0 ) {
        $salry_py_modget = get_name('master_code_id',$salary_pay_id);
        $salry_py_mod = $salry_py_modget['value'];
    }

    $city_nm = "--";
    if($res_data['city_id'] > 0) {
        $getcityId = get_name("city_id", $res_data['city_id']);
        $city_nm = $getcityId["city_name"];
    }
    $return_html .= "<table class='gridtable table_set' border='1'><tr class='font-weight-bold'><th>Net Monthly Income</th><th>City</th><th>Pin Code</th><th>Loan Amount</th><th>Email Id</th><th>Name</th><th>DOB</th></tr>";

    $pincode = ($res_data['pincode'] > 0) ? $res_data['pincode'] : "--";

    $return_html .= "<tr class='center-align'><td>".$net_incm."</td><td>".$city_nm."</td><td>".$pincode."</td><td>".$res_data['loan_amount']."</td><td>".$res_data['email_id']."</td><td>".$res_data['name']."</td><td>".$res_data['dob']."</td></tr>";
    $return_html .= "</table>";
    echo $return_html; 

    }
?>