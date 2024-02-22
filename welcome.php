<?php 
require_once(dirname(__FILE__) . '/config/session.php');
require_once(dirname(__FILE__) . '/helpers/common-helper.php');
require_once(dirname(__FILE__) . '/include/header.php');
require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/include/helper.functions.php');
$dispDateArr = array('Today','Yesterday','Last 7 Days','Last 30 Days');
?>
<!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <script type="text/javascript" src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
        <script>
            function filter_validation() {
                if ($("#email_search").val().trim() != "") {
                    var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    if (!email_regex.test($("#email_search").val())) {
                        alert("Customer Email not valid")
                        return false;
                    }
                }
            }
        </script>
    </head>

    <body>
        <div class="color-bar-1"></div>
        <div class="color-bar-2 color-bg"></div>

        <div class="container main-container">
            <!-- End Header -->

            <div class="row">
                <!--Container row-->
                <!-- Title Header -->
                <div class="span9">
                    <?php 
                        
                        $getreport = "SELECT usr.name As user_name,count(qry.id) As Total_count, stat.value As status FROM `crm_query` As qry left JOIN crm_master_user As usr ON qry.lead_assign_to = usr.id LEFT JOIN crm_master_status As stat ON qry.query_status = stat.id WHERE stat.status_type = 1 ";
                        if($user_role != 1){
                            $getreport = " and qry.lead_assign_to = '".$user_id."' ";
                        }
                        foreach($dispDateArr As $dat){
                            $getreportnew = '';
                            $getreportcreated = '';
                            if($dat == 'Today'){
                                $getreportnew = " and date(qry.created_on) = CURDATE() GROUP by qry.query_status ";
                            } else if($dat == 'Yesterday'){
                                $getreportnew = " and date(qry.created_on) = date_sub(CURDATE(),interval 1 day) GROUP by qry.query_status ";
                            } else if($dat == 'Last 7 Days'){
                                $getreportnew = " and date(qry.created_on) = date_sub(CURDATE(),interval 7 day) GROUP by qry.query_status ";
                            } else if($dat == 'Last 30 Days'){
                                $getreportnew = " and date(qry.created_on) = date_sub(CURDATE(),interval 30 day) GROUP by qry.query_status ";
                            }
                            $getreportcreated = $getreport.$getreportnew;
                            $resreport = mysqli_query($Conn1,$getreportcreated);
                            while($resdata = mysqli_fetch_array($resreport)){
                                $datadisp[$dat][$resdata['status']] = $resdata['Total_count'];
                            }
                        }
                    ?>

                    <h2>Welcome <span class="orange"><?php echo ucwords($_SESSION['userDetails']['user_name']);?></span>, Please find your Summary Report</h2>
                    <table width="80%" class="gridtable" style="margin-left:5%">
                        <tbody>
                            <tr>
                                <th width="10%">User Name </th>
                                <th width="10%">Open</th>
                                <th width="10%">Ringing</th>
                                <th width="10%">Ringing1</th>
                                <th width="10%">Ringing2</th>
                                <th width="10%">Ringing3</th>
                                <th width="10%">Finally Not contactable</th>
                                <th width="10%">Not Interested</th>
                                <th width="10%">Call Back</th>
                                <th width="10%">Future Prospect</th>
                                <th width="10%">Not Eligible - Cibil/Recent Bounces</th>
                                <th width="10%">Not Eligible Negative Profile</th>
                                <th width="10%">Not Eligible/Foir</th>
                                <th width="10%">Foir</th>
                            </tr>
                        <?php  foreach(array_unique($dispDateArr) As $dat){?>
                            <tr>
                                <td><span><?php echo $dat;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Open'] > 0 ? $datadisp[$dat]['Open']:0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing'] > 0 ? $datadisp[$dat]['Ringing'] : 0 ;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing1'] > 0 ? $datadisp[$dat]['Ringing1'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing2'] > 0 ? $datadisp[$dat]['Ringing2'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Ringing3'] > 0 ? $datadisp[$dat]['Ringing3'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Finally Not contactable'] > 0 ? $datadisp[$dat]['Finally Not contactable'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Interested'] > 0 ? $datadisp[$dat]['Not Interested'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Call Back'] > 0 ? $datadisp[$dat]['Call Back'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Future Prospect'] > 0 ? $datadisp[$dat]['Future Prospect'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible - Cibil/Recent Bounces'] > 0 ? $datadisp[$dat]['Not Eligible - Cibil/Recent Bounces'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible Negative Profile'] > 0 ? $datadisp[$dat]['Not Eligible Negative Profile'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Not Eligible/Foir'] > 0 ? $datadisp[$dat]['Not Eligible/Foir'] : 0;?> </span> </td>
                                <td><span><?php echo $datadisp[$dat]['Foir'] > 0 ? $datadisp[$dat]['Foir'] : 0;?> </span> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
