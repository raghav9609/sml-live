<?php
iconv_set_encoding("internal_encoding", "UTF-8");
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
$query_id = urldecode(base64_decode($_REQUEST['query_id'])); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="<?php echo $head_url; ?>/assets/js/jquery-1.3.2.min.js" type="text/javascript" type="text/javascript"></script>
<script language="javascript">
function myMail_function(){
var temp_id = $( "#template" ).val() ;
 $.ajax({
			type: "GET",
			data: "temp=" + temp_id+ "&query_id=<?php echo $query_id; ?>",
			url: "fetch-template.php",
			success: function(html)
			{
			var data = JSON.parse(html);

                $("#email_query").val(atob(data.html_temp));
                $("#subject").val(data.subject);
                $("#recipient_email").val(data.customer_email_id);
                $("#cc_recipient_email").val(data.cc_email_id);
			}
 });   		
}  
</script>
</head>
<body>
<div class="mall_40" align="center">
<div class="wrapper">
<form name="sendemail" method="post" action="send-sms-process.php">
<table class="adminbox admintext" width="100%">
  <input type = "hidden" name= "query_id" id="query_id" value="<?php echo $query_id;?>">
<tr>
<td><span class="bodytext">Select Template:</span> </td>

         <td><select name="template" id="template" onchange="myMail_function(this.value);">
                    <option value="">Select template</option>
                <?php $sql_mail = "Select id,template_name from crm_communication_template where is_active = 1 and type =2 order by id";
               $qry_mail = mysqli_query($Conn1,$sql_mail) or die("Error :".mysqli_error($Conn1));
               while($res_mail = mysqli_fetch_array($qry_mail)){
               $temp_id = $res_mail['id'];
                $template_name = $res_mail['template_name']; ?>
                <option value="<?php echo $temp_id;?>"><?php echo $template_name ;?></option>
                <?php 
              } ?>
            </select>       
    </td>
    <td>Customer Ph No:- </td><td>
  <input type="text" name="subject" id="subject" Placeholder="Customer Phone No." size="10" value=""/>
</td>
</tr>
<tr>
</tr> 
<tr>
<td>Description:- </td>
<td colspan="5">
<textarea name="description" id="email_query" cols="80" rows="10"></textarea>
</td>    
</tr>
</tr>
<tr> <td><input type="submit" name="send" id="send" class="buttonsub" value="Send SMS"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr></table>
</form>
</div>   
</div>
<br/><br/><br/><br/><br/>
</body>
</html>
