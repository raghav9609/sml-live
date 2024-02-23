<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
error_reporting(0); 
// libxml_use_internal_errors(false);
$query_id = base64_decode($_REQUEST['query_id']);
$getbureaudetails = mysqli_query($Conn1,"Select * from crm_experian_data where query_id = '".$query_id."'");
    $resultbureaudetails = mysqli_fetch_array($getbureaudetails);
    $bureauData = $resultbureaudetails['xml_report'];
    if($bureauData != ''){
        $dispBureauData = base64_decode($bureauData);
        $ob = simplexml_load_string(html_entity_decode($dispBureauData));
       $json  = json_encode($ob);
        $returnResponse = json_decode($json, true);
    }
    if($returnResponse['SCORE']['BureauScore'] >= '750'){$img_experian = 'experian-green.png';}else if($returnResponse['SCORE']['BureauScore'] < '650'){
        $img_experian = 'experian-red.png';}else{   $img_experian = 'experian-yellow.png';}
    echo $template = '<!DOCTYPE html><html><head><title>Credit Report</title></head>
    <body style="background: #d6d6d6;font-family: inherit;margin-bottom: 20px;margin-top: 20px"><table style="min-width: 800px;max-width:900px;background: #ffffff;border: 1px solid #000000;margin: auto;font-size: 13px;padding: 20px">
            <tr>
                <td width="75%" style="padding-top:10px">
                    &nbsp;
                </td>
                <td width="25%" style="font-size: 14px;text-align: right;padding-top:10px"><span style="color: #008db1;font-weight: bold;">ERN : </span><span>'.$returnResponse['CreditProfileHeader']['ReportNumber'].'</span><br><span style="color: #008db1;font-weight: bold;">Report Date : </span><span>'.date("d-m-Y",strtotime($returnResponse['Header']['ReportDate'])).'</span><br><span style="color: #008db1;font-weight: bold;">Bureau Name : </span><span>Experian</span></td>
            </tr>
            <tr><td colspan="2" style="color: #f06c00;text-align: center;font-weight: bold;font-size: 18px;padding: 10px"></td></tr>
            <tr><td style="border-top: 1px solid #d6d6d6" colspan="2"></td></tr>
            <tr> 
                <td style="font-size: 25px;padding: 20px 10px;">'.ucwords(strtolower($returnResponse['Current_Application']['Current_Application_Details']['Current_Applicant_Details']['First_Name'])).'&#39;s Credit Report</td>
                <td style="text-align: right;">&nbsp;</td>
            </tr>
            <tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Credit Score</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">Your Credit Report is summarized in the form of Credit Score which ranges from 300 - 900</td></tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;">
                        <tr>
                            <td width="20%"><img src="'.$head_url.'/assets/images/'.$img_experian.'" width="100%"></td>
                            <td style="font-size: 25px;padding: 15px;font-weight: bold;" width="10%">'.$returnResponse['SCORE']['BureauScore'].'</td>
                            <td width="70%">
                                <table style="width: 100%;border: 1px solid #dddddd;">
                                    <tr><td colspan="2" style="padding: 10px 5px"><span style="font-size: 15px;font-weight: bold;text-decoration: underline;padding-bottom: 10px">Score Factors</span></td></tr>
                                    <tr>
                                        <td style="font-weight: bold;color: #313131;padding: 5px">Payment History : </td><td style="color: #313131;padding: 5px">Percentage of payments made on time</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: #313131;padding: 5px">Credit Card Utilization : </td><td style="color: #313131;padding: 5px">Percentage of your Credit Limit being used</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: #313131;padding: 5px">Age Of Credit History : </td><td style="color: #313131;padding: 5px">Age of your oldest open account</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: #313131;padding: 5px">Total Account : </td><td style="color: #313131;padding: 5px">Total number of your Credit Card and Loans</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="2" style="padding: 10px 0px"></td></tr>
            <tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Report Summary</span></td></tr>
            <tr>
                <td colspan="2" style="padding: 15px 0px">
                    <table width="100%">
                        <tr>
                            <td width="33.33%" style="border-right: 1px solid #d6d6d6;">
                                <table width="100%">
                                    <tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Credit Account Summary</td></tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Total Accounts</td><td width="25%">'.$result_get_cust_id_qry['CreditAccountTotal'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Active Accounts</td><td width="25%">'.$result_get_cust_id_qry['CreditAccountActive'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Closed Accounts</td><td width="25%">'.$result_get_cust_id_qry['CreditAccountClosed'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled</td><td width="25%">'.$result_get_cust_id_qry['CreditAccountDefault'].'</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%" style="border-right: 1px solid #d6d6d6;">
                                <table width="100%">
                                    <tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Current Balance Amount Summary</td></tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Total Current Bal. amt</td><td>'.number_format($result_get_cust_id_qry['Outstanding_Balance_All']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled amt</td><td>'.number_format($result_get_cust_id_qry['CADSuitFiledCurrentBalance']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Secured Accounts amt</td><td>'.number_format($result_get_cust_id_qry['Outstanding_Balance_Secured']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Unsecured Accounts amt</td><td>'.number_format($result_get_cust_id_qry['Outstanding_Balance_UnSecured']).'</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%">
                                <table width="100%">
                                    <tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Credit Enquiry Summary</td></tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 7 days credit enquiries</td><td width="25%">'.$result_get_cust_id_qry['CAPSLast7Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 30 days credit enquiries</td><td width="25%">'.$result_get_cust_id_qry['CAPSLast30Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 90 days credit enquiries</td><td width="25%">'.$result_get_cust_id_qry['CAPSLast90Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 180 days credit enquiries</td><td width="25%">'.$result_get_cust_id_qry['CAPSLast180Days'].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">SUMMARY : Credit Account Information</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section displays summary of all your reported credit accounts found in the Credit Bureau database.</td></tr>
            <tr>
                <td colspan="2" style="padding-bottom: 20px">
                    <table width="100%" style="border: 1px solid #dddddd;">
                        <tr style="color: #008db1;font-weight: 600">
                            <td colspan="2" style="border-right: 1px solid #d6d6d6;padding: 5px;">Lender</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Account type</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Account No</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Ownership</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Date Reported</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Account Status</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Date Opened</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Sanction Amt / Highest Credit</td>
                            <td style="border-right: 1px solid #d6d6d6;padding: 5px;">Current Balance</td>
                            <td style="padding: 5px;">Amount Overdue</td>
                        </tr>';
                        $qry_account_details  = mysqli_query($Conn1,"select status.short as status,atype.description as atype,acc_holder_type.description as acc_holder_type,sum_h.* from mlc_experian_customer_account_report_summary_history as sum_h left join mlc_experian_account_type as atype on sum_h.Account_Type = atype.value left join mlc_experian_acc_holder_type_code as acc_holder_type on sum_h.AccountHoldertypeCode = acc_holder_type.value left join mlc_experian_expected_on_web_status as status on sum_h.Account_Status = status.value where experian_history_id = '".$hid."' and cust_id = '".$result_get_cust_id_qry['cust_id']."' group by history_id") or die(mysqli_error($Conn1));
                    $i =0;$data=array();
                        while($result_fetch_acc_details = mysqli_fetch_array($qry_account_details)){
                            $data[] = $result_fetch_acc_details;
                            if($result_fetch_acc_details['Open_Date'] != '1970-01-01' && $result_fetch_acc_details['Open_Date'] != '0000-00-00' && $result_fetch_acc_details['Open_Date'] !='' ){
                                $open_date_to_display = date('d-m-Y',strtotime($result_fetch_acc_details['Open_Date']));
                            }else{
                                $open_date_to_display = '';
                            }
                            
                            $i++;
                    $template .= '<tr>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;font-weight: bold;color: #008db1;padding: 5px;">Acct '.$i.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['Subscriber_Name'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['atype'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['Account_Number'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['acc_holder_type'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.date('d-m-Y',strtotime($result_fetch_acc_details['Date_Reported'])).'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['status'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$open_date_to_display.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.number_format($result_fetch_acc_details['Highest_Credit_or_Original_Loan_Amount']).'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.number_format($result_fetch_acc_details['Current_Balance']).'</td>
                            <td style="border-top:1px solid #d6d6d6;padding: 5px;">'.number_format($result_fetch_acc_details['Amount_Past_Due']).'</td>
                        </tr>';
                        }
                 $template .= '</table>
                </td>
            </tr>
            <tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Credit Account Information details</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section has information based on the details provided to our Bureau Partner by all our member banks, credit / financial institutions and other credit grantors with whom you have a credit / loan account.</td></tr>';
        //print_r($data);
            foreach($data as $key=>$val){
                if($data[$key][Gender_Code] == 1){$gender = 'Male';}else if($data[$key][Gender_Code] == 2){$gender = 'Female';}else if($data[$key][Gender_Code] == 3){$gender = 'Transgender';}
                if($data[$key][Date_of_Last_Payment] != '0000-00-00' && $data[$key][Date_of_Last_Payment] != '1970-01-01' && $data[$key][Date_of_Last_Payment] != ''){$Date_of_Last_Payment = date('d-m-Y',strtotime($data[$key][Date_of_Last_Payment]));}else{$Date_of_Last_Payment = '-';}
        if($data[$key][Rate_of_Interest] != '0.00'){$Rate_of_Interest = $data[$key][Rate_of_Interest] ;}else{$Rate_of_Interest = '-';}
                    if($data[$key][Date_Closed] != '0000-00-00' && $data[$key][Date_Closed] != '' && $data[$key][Date_Closed] != '1970-01-01'){$Date_Closed = date('d-m-Y',strtotime($data[$key][Date_Closed]));}else{$Date_Closed = '-';}
    
                    if($data[$key][Open_Date] != '0000-00-00' && $data[$key][Open_Date] != '' && $data[$key][Open_Date] != '1970-01-01'){$date_opened = date('d-m-Y',strtotime($data[$key][Open_Date]));}else{$date_opened = '-';}
                     
                    if($data[$key][Date_Reported] != '0000-00-00' && $data[$key][Date_Reported] != '' && $data[$key][Date_Reported] != '1970-01-01'){$date_reported = date('d-m-Y',strtotime($data[$key][Date_Reported]));}else{$date_reported = '-';}
    
                    if($data[$key][Date_of_birth] != '0000-00-00' && $data[$key][Date_of_birth] != '' && $data[$key][Date_of_birth] != '1970-01-01'){$Date_of_birth = date('d-m-Y',strtotime($data[$key][Date_of_birth]));}else{$Date_of_birth = '-';}
                    
                    
    
                    
    
    
    
    $occup_name_qry = mysqli_query($Conn1,"select description from mlc_experian_employment_status where value = '".$data[$key][Occupation_Code]."'") or die(mysqli_error($Conn1));
    $result_occup_name = mysqli_fetch_array($occup_name_qry);
    $year_data_dpd = array();
        $get_dpd = mysqli_query($Conn1,"select distinct(year) as dpd_year from mlc_experian_customer_credit_account_history where account_report_id = '".$data[$key][history_id]."' order by year desc") or die(mysqli_error($Conn1));
        while($result_dpd_qry = mysqli_fetch_array($get_dpd)){
            $get_detail_data = mysqli_query($Conn1,"select month,Days_Past_Due from mlc_experian_customer_credit_account_history where account_report_id = '".$data[$key][history_id]."' and year = '".$result_dpd_qry['dpd_year']."'") or die(mysqli_error($Conn1));
        $dpd_year_data = array();
            while($result_detail_data = mysqli_fetch_array($get_detail_data)){
                $dpd_year_data[$result_detail_data[month]] = $result_detail_data['Days_Past_Due'];
            }
            $year_data_dpd[$result_dpd_qry['dpd_year']] = $dpd_year_data;
        }
    
        $state_name_qry = mysqli_query($Conn1,"SELECT state.state_name FROM `mlc_partner_state_mapping` as mapp INNER JOIN mlc_master_state as state ON mapp.mlc_state_id = state.id where partner_id = 2 and partner_state_id = '".$data[$key][State_non_normalized]."'") or die(mysqli_error($Conn1));
        $result_state_qry = mysqli_fetch_array($state_name_qry);
            $template .= '	
            <!-- Account Detals Satrt 1-->
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td style="width: 33.33%;color: #008db1;font-weight: 600;">'.$data[$key][atype].'</td>
                            <td style="width: 33.33%;color: #008db1;font-weight: 600;">'.$data[$key][Subscriber_Name].'</td>
                            <td style="width: 33.33%;text-align: center;font-weight: 600;"><img src="'.$head_url.'/assets/images/tick.png"><span style="vertical-align: super;">Acct '.($key+1).'</span></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-bottom: 2px solid orange"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="color: #008db1;font-weight: 600;width: 20%;padding: 15px 0px">Address 1 <span style="color: #000000;font-weight: normal;padding-left: 10%">
                            '.$data[$key][First_Line_Of_Address_non_normalized].' '.$data[$key][Second_Line_Of_Address_non_normalized].' '.$data[$key][Third_Line_Of_Address_non_normalized].' '.$data[$key][City_non_normalized].' '.$data[$key][Fifth_Line_Of_Address_non_normalized].' '.$result_state_qry['state_name'].' '.$data[$key][ZIP_Postal_Code_non_normalized].'</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;border: 1px solid #d6d6d6">
                        <tr><td colspan="3" style="color: #008db1;font-weight: bold;padding-left: 10px;border-bottom: 1px solid #d6d6d6;padding: 5px">'.$data[$key][atype].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;font-weight: 600;width: 33.33%;padding: 5px">Account terms</td>
                            <td style="color: #008db1;border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;font-weight: 600;width: 33.33%;padding: 5px">Account description</td>
                            <td style="color: #008db1;border-bottom: 1px solid #d6d6d6;font-weight: 600;width: 33.33%;padding: 5px">Account details</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #d6d6d6">
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Account Number</td><td>'.$data[$key][Account_Number].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Date Opened</td><td>'.$date_opened.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Date Closed</td><td>'.$Date_Closed.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Ownership</td><td>'.$data[$key][acc_holder_type].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Rate of Interest</td><td>'.$Rate_of_Interest.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Value of Collateral</td><td>'.$data[$key][Value_of_Collateral].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Type of Collateral</td><td>'.$data[$key][Type_of_Collateral].'</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-right: 1px solid #d6d6d6">
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Date Reported</td><td>'.$date_reported.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Loan Type</td><td>'.$data[$key][atype].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Account Status</td><td>'.$data[$key][status].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Highest Credit</td><td>'.number_format($data[$key][Highest_Credit_or_Original_Loan_Amount]).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Current Balance</td><td>'.number_format($data[$key][Current_Balance]).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Amount Overdue</td><td>'.number_format($data[$key][Amount_Past_Due]).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Last Payment Date</td><td>'.$Date_of_Last_Payment.'</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Credit Limit Amt</td><td>'.$data[$key][Credit_Limit_Amount].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">EMI</td><td>'.number_format($data[$key][Scheduled_Monthly_Payment_Amount]).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Repayment Tenure</td><td>'.$data[$key][Repayment_Tenure].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Total Write-off Amt</td><td>'.$data[$key][Written_Off_Amt_Total].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Principal Write-off</td><td>'.$data[$key][Written_Off_Amt_Principal].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Settlement Amt</td><td>'.$data[$key][Settlement_Amount].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="2" style="color: #008db1;font-weight: bold;font-size: 18px;padding-top: 15px">Payment History</td></tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%;border: 1px solid#d6d6d6;text-align: center;">
                        <tr>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">DPD</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Dec</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Nov</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Oct</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Sep</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Aug</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Jul</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Jun</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">May</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Apr</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Mar</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">Feb</td>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5pxbackground: #dadada;padding: 5px">Jan</td>
                        </tr>';
                        foreach($year_data_dpd as $key_y=>$val_y){
                        $template .= '<tr>
                            <td style="font-weight: bold;color: #008db1;border-right: 1px solid #ffffff;border-bottom: 1px solid #ffffff;background: #dadada;padding: 5px">'.$key_y.'</td>';
                        for($i=12;$i>=1;$i--){	
                            if($year_data_dpd[$key_y][$i] == ''){
                                $style='border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;padding: 5px';
                            }else if($year_data_dpd[$key_y][$i] == '0'){
                               $style='font-weight: bold;color: #ffffff;border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;padding: 5px;background: #43ad43';
                            }else if($year_data_dpd[$key_y][$i] >= '90'){
                             $style='font-weight: bold;color: #ffffff;border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;padding: 5px;background: red';
                            }else{
                             $style='font-weight: bold;color: #ffffff;border-right: 1px solid #d6d6d6;border-bottom: 1px solid #d6d6d6;padding: 5px;background: #f6650b';
                            }
                        $template .= '<td style="'.$style.'">'.$year_data_dpd[$key_y][$i].'</td>';
                        }
                    $template .= '</tr>';}
                    $template .= '</table>
                </td>
            </tr>
            <tr><td colspan="2" style="font-size: 16px;font-weight: bold;color: #008db1;padding-top: 20px">Consumer Personal details on the '.$data[$key][atype].'</td></tr>
            <tr>
                <td colspan="2">
                    <table style="border: 1px solid #d6d6d6;padding-top: 5px;width: 100%">
                        <tr>
                            <td width="33.33%" style="border-right: 1px solid #d6d6d6;font-size: 12px;vertical-align: top;">
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Date of Birth</td><td>'.$Date_of_birth.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Gender</td><td>'.$gender.'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Occupation</td><td>'.$result_occup_name["description"].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Email address</td><td>'.$data[$key][EMailId].'</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%" style="border-right: 1px solid #d6d6d6;font-size: 12px;vertical-align: top;">
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;font-weight: bold;padding: 5px;font-weight: bold;font-size: 14px">Phone Type</td>
                                        <td style="color: #008db1;font-weight: bold;padding: 5px;font-weight: bold;font-size: 14px">Phone Number</td>
                                        <td style="color: #008db1;font-weight: bold;padding: 5px;font-weight: bold;font-size: 14px">Extension</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">Mobile</td><td>'.$data[$key][Telephone_Number].'</td><td>-</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%" style="font-size: 12px;vertical-align: top;">
                                <table width="100%">
                                    <tr>
                                        <td style="color: #008db1;font-weight: bold;padding: 5px;font-weight: bold;font-size: 14px;vertical-align: top;">ID Type</td>
                                        <td style="color: #008db1;font-weight: bold;padding: 5px;font-weight: bold;font-size: 14px;vertical-align: top;">ID Number</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;padding: 5px;font-weight: bold;">PAN</td><td>'.$data[$key][Income_TAX_PAN].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan="2" style="padding-bottom: 20px"></td></tr>
            <!-- Account detals End 1-->';
         } 
         
             $template .= '<tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">CREDIT ENQUIRIES</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2"> This section shows the names of the credit institutions that have processed a credit / loan application for you.</td></tr>';
        
        $credit_query = mysqli_query($Conn1,"select hist.*,search.search_desc as search_desc,marital.description as marital_status from mlc_experian_customer_credit_enquiry_report_history as hist left join mlc_experian_search_type as search on hist.Enquiry_Reason = search.search_val left join mlc_experian_marital_status as marital on hist.Marital_Status = marital.id where experian_history_id = ".$hid." and enquiry_type = 'credit'") or die(mysqli_error($Conn1));
         while($result_credit_query = mysqli_fetch_array($credit_query)){
             $gender_status = 0;
        if($result_credit_query["Gender_Code"] == '1'){
            $gender_status = 'Male';
        }else if($result_credit_query["Gender_Code"] == '2'){
            $gender_status = 'Female';
        }
    
        if($result_credit_query["Date_Of_Birth_Applicant"] != '0000-00-00' && $result_credit_query["Date_Of_Birth_Applicant"] != '' && $result_credit_query["Date_Of_Birth_Applicant"] != '1970-01-01'){$dob_applicant = date('d-m-Y',strtotime($result_credit_query["Date_Of_Birth_Applicant"]));}else{$dob_applicant = '-';}
        
        if($result_credit_query["Date_of_Request"] != '0000-00-00' && $result_credit_query["Date_of_Request"] != '' && $result_credit_query["Date_of_Request"] != '1970-01-01'){$req_date = date('d-m-Y',strtotime($result_credit_query["Date_of_Request"]));}else{$req_date = '-';}
        
        
                $template .= '<tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
                        <tr>
                            <td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">'.$result_credit_query["Name"].'</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;color:#008db1;padding-right: 15px;padding: 5px">Address 1</td>
                            <td colspan="4" style="padding-left: 15px;padding: 5px">'.$result_credit_query["Address"].'</td>
                            <td style="text-align: center;font-weight: 600;padding: 5px"><img src="'.$head_url.'/assets/images/tick.png"><span style="vertical-align: super;">Cr Enq 1</span></td>
                        </tr>
                        <tr><td height="10" colspan="6"></td></tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Date of Birth</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$dob_applicant.'</td>
                            <td style="color: #008db1;padding: 5px"><b>PAN</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["IncomeTaxPan"].'</td>
                            <td style="color: #008db1;padding: 5px"><b>ERN</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["ReportNumber"].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Telephone</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Passport Number</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Search Type</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["search_desc"].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Mobile Phone</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["MobilePhoneNumber"].'</td>
                            <td style="color: #008db1;padding: 5px"><b>Voter ID</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Credit Institution Name</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["Subscriber_Name"].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Gender</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$gender_status.'</td>
                            <td style="color: #008db1;padding: 5px"><b>Driving License</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Application date</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$req_date.'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Marital Status</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["marital_status"].'</td>
                            <td style="color: #008db1;padding: 5px"><b>Ration Card</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Amount applied for</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.number_format($result_credit_query["Amount_Financed"]).'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Email</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["EMailId"].'</td>
                            <td style="color: #008db1;padding: 5px"><b>Duration of Agreement</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["Duration_Of_Agreement"].'</td>
                        </tr>
                    </table>
                </td>
            </tr>';
            }
       echo $template .= '
        </table></body>
    </html>';
    ?>