<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');

$query_id = $_REQUEST['query_id'];
$get_applicationcreated = mysqli_query($Conn1,"Select * from crm_query_application where crm_query_id = '".$query_id."'");

while($resultApp = mysqli_fetch_array($get_applicationcreated)){
    $createdApplications[] = $resultApp['bank_id'];
}

//print_r($createdApplications);
$qry1 = "select * from crm_masters where crm_masters_code_id = 10 and is_active = 1 ";
$res = mysqli_query($Conn1, $qry1) or die("Error: " . mysqli_error($Conn1));
echo $recordcount = mysqli_num_rows($res); 
if ($recordcount > 0) {
    $record = 0;
    while ($exe_form = mysqli_fetch_array($res)) {
        print_r($exe_form);
        $record++;
        $disablcls = '';
        $textclas = '';
        if(in_array($exe_form['id'],$createdApplications)){
            $disablcls = 'checked disabled';
            $textclas = 'green bold';
        }
        $data_bnk[] = 'anu';
        // $data_bnk[] = '<input type ="checkbox" style="position: unset !important;" class="check_bank" name = "check_bank[]" id = "check_bank_'.$exe_form['id'].'" value ="'.$exe_form['id'].'" '.$disablcls.'><label class="cursor '.$textclas.'" for="check_bank_'.$exe_form['id'].'">'.$exe_form['value'].'</label>&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    echo implode($data_bnk);
}
?>