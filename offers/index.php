<?php
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../include/helper.functions.php');
require_once(dirname(__FILE__) . '/../include/display-name-functions.php');
$qry1 = "select * from crm_masters where crm_masters_code_id = 10 and is_active = 1 ";
$res = mysqli_query($Conn1, $qry1) or die("Error: " . mysqli_error($Conn1));
$recordcount = mysqli_num_rows($res); 
if ($recordcount > 0) {
    $record = 0;
    while ($exe_form = mysqli_fetch_array($res)) {
        $record++;
        // if ($record > 10) {
        //      continue;
        // }
        $data_bnk[] = '<input type ="checkbox" style="position: unset !important;" class="check_bank" name = "check_bank[]" id = "check_bank_'.$exe_form['id'].'" value ="'.$exe_form['id'].'">'.$exe_form['value'];
    }
    echo implode($data_bnk);
}
?>