<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../include/header.php');
require_once(dirname(__FILE__) . '/../config/config.php');
echo $getreport = "SELECT usr.name As user_name,count(qry.id) As Total_count, stat.value As status FROM `crm_query` As qry left JOIN crm_master_user As usr ON qry.lead_assign_to = usr.id LEFT JOIN crm_master_status As stat ON qry.query_status = stat.id WHERE stat.status_type = 1 GROUP by qry.query_status,qry.lead_assign_to";
$resreport = mysqli_query($Conn1,$getreport);

$resultqryReport = mysqli_fetch_array($resreport);

?>
<table width="100%" class="gridtable">
    <tbody>
        <tr>
            <th width="10%">User Name </th>
            <th width="10%">Query Status</th>
            <th width="10%">Total Leads</th>
        </tr>
        <?php  foreach($resultqryReport As $resdata){?>
            <tr>
                <td><span><?php echo $resdata['user_name'];?> </span> </td>
                <td><span><?php echo $resdata['status'];?> </span> </td>
                <td><span><?php echo $resdata['Total_count'];?> </span> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php //print_r($resultqryReport);

?>