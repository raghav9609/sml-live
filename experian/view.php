<?php 
require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
error_reporting(1); 
// libxml_use_internal_errors(false);
$query_id = base64_decode($_REQUEST['query_id']);
$getbureaudetails = mysqli_query($Conn1,"Select * from crm_experian_data where query_id = '".$query_id."'");
    $resultbureaudetails = mysqli_fetch_array($getbureaudetails);
    $bureauData = $resultbureaudetails['xml_report'];
    if($bureauData != ''){
        $dispBureauData = base64_decode($bureauData);
        $ob = simplexml_load_string(html_entity_decode($dispBureauData));
       echo $json  = json_encode($ob);
        $returnResponse = json_decode($json, true);
    }
	$enquiry_reason_array = array("01"=>"Agricultural Machinery","02"=>" Animal Husbandry","03"=>"Aquaculture","04"=>"Biogas Plant","05"=>"Crop Loan","06"=>"Horticulture","07"=>"Irrigation System","1"=>"Agricultural Machinery","2"=>" Animal Husbandry","3"=>"Aquaculture","4"=>"Biogas Plant","5"=>"Crop Loan","6"=>"Horticulture","7"=>"Irrigation System","99"=>"Others","08"=>"New Car","09"=>"Overdraft against Car","8"=>"New Car","9"=>"Overdraft against Car","10"=>"Used Car","11"=>"General","12"=>"Small & Medium Business","13"=>"Professionals","14"=>"Trade","15"=>"Bus","16"=>"Tempo","17"=>"Tipper","18"=>"Truck","20"=>"Forklift","21"=>"Wheel Loaders","22"=>"Consumer Search","66"=>"Consumer Search Loan","68"=>"Consumer Search Loan","23"=>"Credit Card","24"=>"Fleet Card","25"=>"For Working Executives","26"=>"Study Abroad","27"=>"Study in India","28"=>"Leasing","29"=>"Bank Deposits","30"=>"Gold","31"=>"Govt. Bonds / PPF / NSC / KVP / FD","32"=>"Shares and Mutual Funds","33"=>"Business Loan","34"=>"Housing Loan","35"=>"Personal Loan","36"=>"Agriculture","37"=>"General","38"=>"Small Business","39"=>"Computers / Laptops","40"=>"Consumer Durables","41"=>"Marriage / Religious Ceremonies","42"=>"Travel","43"=>"Balance Transfer","44"=>"Home Improvement / Extension","45"=>" Land","46"=>"Lease Rental Discounting","47"=>"Loan against Property","48"=>"New Home","49"=>"Office Premises","50"=>"Under construction","51"=>"Broadband","52"=>"Landline","53"=>"Mobile","54"=>"Three Wheeler","55"=>"Two Wheeler","56"=>"Cash credit facility","57"=>"Overdraft","58"=>"Term Loan","60"=>"Microfinance Detailed Report","61"=>"Summary Report","62"=>"VB OLM Retrieval Service","63"=>"Account Review","64"=>"Retro Enquiry","65"=>"Locate Plus","67"=>"Indicative Report","69"=>"Bank OLM Retrieval Service","70"=>"Adviser Liability","71"=>"Secured (Account Group for Portfolio Review response)","72"=>"Unsecured (Account Group for Portfolio Review response)");

	$account_type_array = array("1"=>"AUTO LOAN","2"=>"HOUSING LOAN","3"=>"PROPERTY LOAN","4"=>"LOAN AGAINST SHARES/SECURITIES","5"=>"PERSONAL LOAN","6"=>"CONSUMER LOAN","7"=>"GOLD LOAN","8"=>"EDUCATIONAL LOAN","9"=>"LOAN TO PROFESSIONAL","10"=>"CREDIT CARD","11"=>"LEASING","12"=>"OVERDRAFT","13"=>"TWO-WHEELER LOAN","14"=>"NON-FUNDED CREDIT FACILITY","15"=>"LOAN AGAINST BANK DEPOSITS","16"=>"FLEET CARD","17"=>"Commercial Vehicle Loan","18"=>"Telco – Wireless","19"=>"Telco – Broadband","20"=>"Telco – Landline","23"=>"GECL Secured","24"=>"GECL Unsecured","31"=>"Secured Credit Card",	"32"=>"Used Car Loan","33"=>"Construction Equipment Loan","34"=>"Tractor Loan","35"=>"Corporate Credit Card",	"36"=>"Kisan Credit Card","37"=>"Loan on Credit Card","38"=>"Prime Minister Jaan Dhan Yojana - Overdraft","39"=>"Mudra Loans – Shishu / Kishor / Tarun","40"=>"Microfinance – Business Loan","41"=>"Microfinance – Personal Loan","42"=>"Microfinance – Housing Loan","43"=>"Microfinance – Others","44"=>"Pradhan Mantri Awas Yojana - Credit Link Subsidy Scheme MAY CLSS","45"=>"P2P Personal Loan","46"=>"P2P Auto Loan","47"=>"P2P Education Loan","51"=>"BUSINESS LOAN – GENERAL","52"=>"BUSINESS LOAN –PRIORITY SECTOR – SMALL BUSINESS","53"=>"BUSINESS LOAN –PRIORITY SECTOR – AGRICULTURE","54"=>"BUSINESS LOAN –PRIORITY SECTOR – OTHERS","55"=>"BUSINESS NON-FUNDED CREDIT FACILITY – GENERAL","56"=>"BUSINESS NON-FUNDED CREDIT FACILITY – PRIORITY SECTOR – SMALL BUSINESS","57"=>"BUSINESS NON-FUNDED CREDIT FACILITY – PRIORITY SECTOR – AGRICULTURE","58"=>"BUSINESS NON-FUNDED CREDIT FACILITY – PRIORITY SECTOR – OTHERS","59"=>"BUSINESS LOANS AGAINST BANK DEPOSITS","60"=>"Staff Loan","61"=>"Business Loan - Unsecured","00"=>"Others","01"=>"AUTO LOAN","02"=>"HOUSING LOAN","03"=>"PROPERTY LOAN","04"=>"LOAN AGAINST SHARES/SECURITIES","05"=>"PERSONAL LOAN","06"=>"CONSUMER LOAN","07"=>"GOLD LOAN","08"=>"EDUCATIONAL LOAN","09"=>"LOAN TO PROFESSIONAL");

	$account_status = array("0"=>"NoSuitFiled","89"=>"Wilfuldefault","93"=>"SuitFiled(Wilfuldefault)","97"=>"SuitFiled(WilfulDefault)andWritten-off","30"=>"Restructured","31"=>"RestructuredLoan(Govt.Mandated)","32"=>"Settled","33"=>"Post(WO)Settled","34"=>"AccountSold","35"=>"WrittenOffandAccountSold","36"=>"AccountPurchased","37"=>"AccountPurchasedandWrittenOff","38"=>"AccountPurchasedandSettled","39"=>"AccountPurchasedandRestructured","40"=>"StatusCleared","41"=>"RestructuredLoan","42"=>"RestructuredLoan(Govt.Mandated)","43"=>"Written-off","44"=>"Settled","45"=>"Post(WO)Settled","46"=>"AccountSold","47"=>"WrittenOffandAccountSold","48"=>"AccountPurchased","49"=>"AccountPurchasedandWrittenOff","50"=>"AccountPurchasedandSettled","51"=>"AccountPurchasedandRestructured","52"=>"StatusCleared","53"=>"SuitFiled","54"=>"SuitFiledandWritten-off","55"=>"SuitFiledandSettled","56"=>"SuitFiledandPost(WO)Settled","57"=>"SuitFiledandAccountSold","58"=>"SuitFiledandWrittenOffandAccountSold","59"=>"SuitFiledandAccountPurchased","60"=>"SuitFiledandAccountPurchasedandWrittenOff","61"=>"SuitFiledandAccountPurchasedandSettled","62"=>"SuitFiledandAccountPurchasedandRestructured","63"=>"SuitFiledandStatusCleared","64"=>"WilfulDefaultandRestructuredLoan","65"=>"WilfulDefaultandRestructuredLoan(Govt.Mandated)","66"=>"WilfulDefaultandSettled","67"=>"WilfulDefaultandPost(WO)Settled","68"=>"WilfulDefaultandAccountSold","69"=>"WilfulDefaultandWrittenOffandAccountSold","70"=>"WilfulDefaultandAccountPurchased","72"=>"WilfulDefaultandAccountPurchasedandWrittenOff","73"=>"WilfulDefaultandAccountPurchasedandSettled","74"=>"WilfulDefaultandAccountPurchasedandRestructured","75"=>"WilfulDefaultandStatusCleared","76"=>"Suitfiled(Wilfuldefault)andRestructured","77"=>"Suitfiled(Wilfuldefault)andRestructuredLoan(Govt.","79"=>"Suitfiled(Wilfuldefault)andSettled","81"=>"Suitfiled(Wilfuldefault)andPost(WO)Settled","85"=>"Suitfiled(Wilfuldefault)andAccountSold","86"=>"Suitfiled(Wilfuldefault)andWrittenOffandSold","87"=>"Suitfiled(Wilfuldefault)andAccountPurchased","88"=>"Suitfiled(Wilfuldefault)andAccountPurchasedandOff","94"=>"Suitfiled(Wilfuldefault)andAccountPurchasedand","90"=>"Suitfiled(Wilfuldefault)andAccountPurchasedand","91"=>"Suitfiled(Wilfuldefault)andStatusCleared","13"=>"CLOSED","14"=>"CLOSED","15"=>"CLOSED","16"=>"CLOSED","16"=>"CLOSED","16"=>"CLOSED","17"=>"CLOSED","12"=>"CLOSED","11"=>"ACTIVE","71"=>"ACTIVE","78"=>"ACTIVE","80"=>"ACTIVE","82"=>"ACTIVE","83"=>"ACTIVE","84"=>"ACTIVEDEFAULTVALUEACTIVE","21"=>"ACTIVE","22"=>"ACTIVE","23"=>"ACTIVE","24"=>"ACTIVE","25"=>"ACTIVE","131"=>"Restructuredduetonaturalcalamity","130"=>"RestructuredduetoCOVID-19");

	$account_holder_type = array("1"=>"Individual","2"=>"Joint","3"=>"Authorized User","7"=>"Guarantor","20"=>"Deceased");

    if($returnResponse['SCORE']['BureauScore'] >= '750'){$img_experian = 'experian-green.png';}else if($returnResponse['SCORE']['BureauScore'] < '650'){
        $img_experian = 'experian-red.png';}else{   $img_experian = 'experian-yellow.png';}
      $template = '<!DOCTYPE html><html><head><title>Credit Report</title></head>
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
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Total Accounts</td><td width="25%">'.$returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CreditAccountTotal'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Active Accounts</td><td width="25%">'.$returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CreditAccountActive'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Closed Accounts</td><td width="25%">'.$returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CreditAccountClosed'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled</td><td width="25%">'.$returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CreditAccountDefault'].'</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%" style="border-right: 1px solid #d6d6d6;">
                                <table width="100%">
                                    <tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Current Balance Amount Summary</td></tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Total Current Bal. amt</td><td>'.($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_All']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled amt</td><td>'.($returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CADSuitFiledCurrentBalance']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Secured Accounts amt</td><td>'.($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_Secured']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Unsecured Accounts amt</td><td>'.($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_UnSecured']).'</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="33.33%">
                                <table width="100%">
                                    <tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Credit Enquiry Summary</td></tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 7 days credit enquiries</td><td width="25%">'.$returnResponse['TotalCAPS_Summary']['TotalCAPSLast7Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 30 days credit enquiries</td><td width="25%">'.$returnResponse['TotalCAPS_Summary']['TotalCAPSLast30Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 90 days credit enquiries</td><td width="25%">'.$returnResponse['TotalCAPS_Summary']['TotalCAPSLast90Days'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Last 180 days credit enquiries</td><td width="25%">'.$returnResponse['TotalCAPS_Summary']['TotalCAPSLast180Days'].'</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">SUMMARY : Credit Account Information</span></td></tr>
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
                        
                    $i =0;$data=array();
                        foreach($returnResponse['CAIS_Account']['CAIS_Account_DETAILS'] as $key => $result_fetch_acc_details){
							$i++;
                            $data[] = $result_fetch_acc_details;
                            if($result_fetch_acc_details['Open_Date'] != '1970-01-01' && $result_fetch_acc_details['Open_Date'] != '0000-00-00' && $result_fetch_acc_details['Open_Date'] !='' ){
                                $open_date_to_display = date('d-m-Y',strtotime($result_fetch_acc_details['Open_Date']));
                            }else{
                                $open_date_to_display = '';
                            }
							if($result_fetch_acc_details['Date_Reported'] != '1970-01-01' && $result_fetch_acc_details['Date_Reported'] != '0000-00-00' && $result_fetch_acc_details['Date_Reported'] !='' ){
                                $report_date_to_display = date('d-m-Y',strtotime($result_fetch_acc_details['Date_Reported']));
                            }else{
                                $report_date_to_display = '';
                            }

							if(!empty($result_fetch_acc_details['Highest_Credit_or_Original_Loan_Amount']) && $result_fetch_acc_details['Highest_Credit_or_Original_Loan_Amount'] !='' ){
                                $Highest_Credit_or_Original_Loan_Amount = number_format($result_fetch_acc_details['Highest_Credit_or_Original_Loan_Amount']);
                            }else{
                                $Highest_Credit_or_Original_Loan_Amount = '';
                            }

							if(!empty($result_fetch_acc_details['Current_Balance']) && $result_fetch_acc_details['Current_Balance'] !='' ){
                                $Current_Balance = number_format($result_fetch_acc_details['Current_Balance']);
                            }else{
                                $Current_Balance = '';
                            }


							if(!empty($result_fetch_acc_details['Amount_Past_Due']) && $result_fetch_acc_details['Amount_Past_Due'] !='' ){
                                $Amount_Past_Due = number_format($result_fetch_acc_details['Amount_Past_Due']);
                            }else{
                                $Amount_Past_Due = '';
                            }

							
						
                     $template .= '<tr>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;font-weight: bold;color: #008db1;padding: 5px;">Acct '.$i.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['Subscriber_Name'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$account_type_array[$result_fetch_acc_details['Account_Type']].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$result_fetch_acc_details['Account_Number'].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$account_holder_type[$result_fetch_acc_details['AccountHoldertypeCode']].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$report_date_to_display.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$account_status[$result_fetch_acc_details['Account_Status']].'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$open_date_to_display.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$Highest_Credit_or_Original_Loan_Amount.'</td>
                            <td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">'.$Current_Balance.'</td>
                            <td style="border-top:1px solid #d6d6d6;padding: 5px;">'.$Amount_Past_Due.'</td>
                        </tr>';
                        }
                  $template .= '</table>
                </td>
            </tr>
            <tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Credit Account Information details</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section has information based on the details provided to our Bureau Partner by all our member banks, credit / financial institutions and other credit grantors with whom you have a credit / loan account.</td></tr>';
			foreach($data as $key=>$val){
				$gender = 'Unknown';
                if(val[Gender_Code] == 1){$gender = 'Male';}else if(val[Gender_Code] == 2){$gender = 'Female';}else if(val[Gender_Code] == 3){$gender = 'Transgender';}
				
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
        
    
         foreach($returnResponse['CAPS']['CAPS_Application_Details'] as $key=>$result_credit_query){
             $gender_status = "Unkown";
        if($result_credit_query["CAPS_Applicant_Details"]["Gender_Code"] == '1'){
            $gender_status = 'Male';
        }else if($result_credit_query["CAPS_Applicant_Details"]["Gender_Code"] == '2'){
            $gender_status = 'Female';
        }

        if($result_credit_query["Date_of_Request"] != '0000-00-00' && $result_credit_query["Date_of_Request"] != '' && $result_credit_query["Date_of_Request"] != '1970-01-01'){$req_date = date('d-m-Y',strtotime($result_credit_query["Date_of_Request"]));}else{$req_date = '-';}
        if($result_credit_query["CAPS_Applicant_Details"]["Telephone_Number_Applicant_1st"] != '' && !empty($result_credit_query["CAPS_Applicant_Details"]["Telephone_Number_Applicant_1st"])){
			$telephoneno = $result_credit_query["CAPS_Applicant_Details"]["Telephone_Number_Applicant_1st"];
		}else if($result_credit_query["CAPS_Applicant_Details"]["MobilePhoneNumber"] != '' && !empty($result_credit_query["CAPS_Applicant_Details"]["MobilePhoneNumber"])){
			$telephoneno = $result_credit_query["CAPS_Applicant_Details"]["MobilePhoneNumber"];
		}else{
			$telephoneno = '';
		}

		if($result_credit_query["CAPS_Applicant_Details"]["Date_Of_Birth_Applicant"] != '' && !empty($result_credit_query["CAPS_Applicant_Details"]["Date_Of_Birth_Applicant"])){
			$dob_applicant = date('d-m-Y',strtotime($result_credit_query["CAPS_Applicant_Details"]["Date_Of_Birth_Applicant"]));
		}else{
			$dob_applicant = '-';
		}
        if(!empty($result_credit_query["Amount_Financed"]) && $result_credit_query["Amount_Financed"] !='' ){
			$Amount_Financed = number_format($result_credit_query["Amount_Financed"]);
		}else{
			$Amount_Financed = '';
		}
                $template .= '<tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
                        <tr>
                            <td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">'.$result_credit_query["CAPS_Applicant_Details"]["First_Name"].' '.$result_credit_query["CAPS_Applicant_Details"]["Last_Name"].'</td>
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
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["CAPS_Applicant_Details"]["IncomeTaxPan"].'</td>
                            <td style="color: #008db1;padding: 5px"><b>ERN</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["ReportNumber"].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Telephone</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Passport Number</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Search Type</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$enquiry_reason_array[$result_credit_query["Finance_Purpose"]].'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Mobile Phone</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$telephoneno.'</td>
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
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Ration Card</b></td>
                            <td style="padding: 5px;padding-left: 15px">-</td>
                            <td style="color: #008db1;padding: 5px"><b>Amount applied for</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$Amount_Financed.'</td>
                        </tr>
                        <tr>
                            <td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Email</b></td>
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query["CAPS_Applicant_Details"]["EMailId"][0].'</td>
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