<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
$msg = $_REQUEST['msg'];
?>
<style>
.buttonsub {
    webkit-box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    -moz-box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    box-shadow: rgba(0,0,0,0.2) 0 1px 0 0;
    color: #000;
    background-color: #ffa84c;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border: none;
    text-decoration: none;
    font-family: roboto;
    font-size: 16px;
    font-weight: 700;
    height: 32px;
    padding: 4px 16px;
    text-shadow: ;
}

</style>
<div><b><?php echo $msg;?></b></div>
<div style="padding: 3%;">
<form name="add_pat_info" id="add_pat_info" method="POST" action="add_pat.php">
<table class="gridtable" style='margin-left:2%;width:80%;'>
<tr><th colspan="2"><div style="padding-top: 10px">
<input type="submit" name="add" class="buttonsub" value="Add"/></div></th></tr>
<tr>
<th>Partner Name</th>
<td><?php echo get_dropdown('partner_list','partner_name',$pat_id,'required'); ?></td>
</tr>
<tr>
<th>City Name</th>
<td>
<?php echo get_dropdown('city','city_name','','required'); ?>
<!-- <select name="city_name" required><option>Select Partner City</option>
<?php //$qry_city = mysqli_query($Conn1,"select city_id,city_name from lms_city");
//while($res_city = mysqli_fetch_array($qry_city)){?>
<option value="<?php// echo $res_city['city_id'];?>"><?php //echo $res_city['city_name'];?></option>
<?php //} ?></select> -->
</td>
</tr>
<tr>
<th>Loan Type</th>
<td>
<?php echo get_dropdown(1, 'loan_type', '', ''); ?>

</td>
</tr>
<tr>
<th>RM Name</th>
<td><input type="text" name="rm_name" placeholder="Enter RM Name" /></td>
</tr>
<tr>
<th>RM Email ID</th>
<td><input type="email" name="rm_email" placeholder="Enter RM Email ID" /></td>
</tr>
<tr>
<th>RM Contact No.</th>
<td><input type="tel" name="rm_phone" placeholder="Enter RM Contact Number" maxlength="10"/></td>
</tr>
<tr>
<th>RM Employee Code</th>
<td><input type="tel" name="rm_emp_code" placeholder="Enter RM Emp Code" maxlength="10"/></td>
</tr>
<tr>
<th>RM SMS FLag</th>
<td><select name="rm_sms_flag" ><option value="">SMS Flag</option><option value="1">Active</option><option value="0">Inactive</option></select></td>
</tr>
<tr>
<th>RM EMAIL Flag</th>
<td><select name="rm_email_flag" ><option value="">EMAIL Flag</option><option value="1">Active</option><option value="0">Inactive</option></select></td>
</tr>
<tr>
<th>SM Name</th>
<td><input type="text" name="sm_name" placeholder="Enter SM Name" /></td>
</tr>
<tr>
<th>SM Email ID</th>
<td><input type="email" name="sm_email" placeholder="Enter SM Email ID" /></td>
</tr>
<tr>
<th>SM Contact No.</th>
<td><input type="tel" name="sm_phone" placeholder="Enter SM Contact Number" maxlength="10"/></td>
</tr>
<tr>
<th>SM Employee Code</th>
<td><input type="tel" name="sm_emp_code" placeholder="Enter SM Emp Code" maxlength="10"/></td>
</tr>
<tr>
<th>SM SMS FLag</th>
<td><select name="sm_sms_flag" ><option value="">SMS Flag</option><option value="1">Active</option><option value="0">Inactive</option></select></td>
</tr>
<tr>
<th>SM EMAIL Flag</th>
<td><select name="sm_email_flag" ><option value="">EMAIL Flag</option><option value="1">Active</option><option value="0">Inactive</option></select></td>
</tr>

<tr>
<tr>
<th>Executive Name</th>
<td><input type="text" name="exe_name" placeholder="Enter Executive Name" /></td>
</tr>
<tr>
<th>Executive Email ID</th>
<td><input type="email" name="exe_email" placeholder="Enter Executive Email ID" /></td>
</tr>
<tr>
<th>Executive Contact No.</th>
<td><input type="tel" name="exe_phone" placeholder="Enter Executive Contact Number" maxlength="10"/></td>
</tr>
</tr>

</table>
</form></div>

<!-- <script>
$(".city_name").autocomplete({
        source: '<?php //echo $head_url; ?>/include/city_name.php'
    });
</script> -->