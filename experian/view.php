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
		$enquiry_reason_array = array("1"=>"Agricultural Machinery","2"=>" Animal Husbandry","3 "=>"Aquaculture","4 "=>"Biogas Plant","5 "=>"Crop Loan","6 "=>"Horticulture","7 "=>"Irrigation System","99 "=>"Others", "8 "=>"New Car","9 "=>"Overdraft against Car","10 "=>"Used Car","11 "=>"General","12 "=>"Small & Medium Business","13 "=>"Professionals","14 "=>"Trade","15 "=>"Bus","16 "=>"Tempo","17 "=>"Tipper","18 "=>"Truck","20 "=>"Forklift","21 "=>"Wheel Loaders","22 "=>"Consumer Search","66 "=>"Consumer Search Loan","68 "=>"Consumer Search Loan","23 "=>"Credit Card","24 "=>"Fleet Card","25 "=>"For Working Executives","26 "=>"Study Abroad","27 "=>"Study in India","28 "=>"Leasing","29 "=>"Bank Deposits","30 "=>"Gold","31 "=>"Govt. Bonds / PPF / NSC / KVP / FD","32 "=>"Shares and Mutual Funds","33 "=>"Business Loan","34 "=>"Housing Loan","35 "=>"Personal Loan","36 "=>"Agriculture","37 "=>"General","38 "=>"Small Business","39 "=>"Computers / Laptops","40 "=>"Consumer Durables","41 "=>"Marriage / Religious Ceremonies","42 "=>"Travel","43 "=>"Balance Transfer","44 "=>"Home Improvement / Extension","45"=>" Land","46 "=>"Lease Rental Discounting","47 "=>"Loan against Property","48 "=>"New Home","49 "=>"Office Premises","50 "=>"Under construction","51 "=>"Broadband","52 "=>"Landline","53 "=>"Mobile","54 "=>"Three Wheeler","55 "=>"Two Wheeler","56 "=>"Cash credit facility","57 "=>"Overdraft","58 "=>"Term Loan","60 "=>"Microfinance Detailed Report","61 "=>"Summary Report","62 "=>"VB OLM Retrieval Service","63 "=>"Account Review","64 "=>"Retro Enquiry","65 "=>"Locate Plus","67 "=>"Indicative Report","69 "=>"Bank OLM Retrieval Service","70 "=>"Adviser Liability","71 "=>"Secured (Account Group for Portfolio Review response)","72 "=>"Unsecured (Account Group for Portfolio Review response)");
    }
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
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Total Current Bal. amt</td><td>'.number_format($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_All']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled amt</td><td>'.number_format($returnResponse['CAIS_Account']['CAIS_Summary']['Credit_Account']['CADSuitFiledCurrentBalance']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Secured Accounts amt</td><td>'.number_format($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_Secured']).'</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #008db1;font-weight: 600;padding: 5px">Unsecured Accounts amt</td><td>'.number_format($returnResponse['CAIS_Account']['CAIS_Summary']['Total_Outstanding_Balance']['Outstanding_Balance_UnSecured']).'</td>
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
            </tr>';

         
             $template .= '<tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="'.$head_url.'/assets/images/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">CREDIT ENQUIRIES</span></td></tr>
            <tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2"> This section shows the names of the credit institutions that have processed a credit / loan application for you.</td></tr>';
        
    
         foreach($returnResponse['CAPS']['CAPS_Application_Details'] as $key=>$result_credit_query){
             $gender_status = 0;
        if($result_credit_query['CAPS_Applicant_Details']["Gender_Code"] == '1'){
            $gender_status = 'Male';
        }else if($result_credit_query['CAPS_Applicant_Details']["Gender_Code"] == '2'){
            $gender_status = 'Female';
        }
    
        if($result_credit_query['CAPS_Applicant_Details']["Date_Of_Birth_Applicant"] != '0000-00-00' && $result_credit_query['CAPS_Applicant_Details']["Date_Of_Birth_Applicant"] != '' && $result_credit_query['CAPS_Applicant_Details']["Date_Of_Birth_Applicant"] != '1970-01-01'){$dob_applicant = date('d-m-Y',strtotime($result_credit_query['CAPS_Applicant_Details']["Date_Of_Birth_Applicant"]));}else{$dob_applicant = '-';}
        
        if($result_credit_query["Date_of_Request"] != '0000-00-00' && $result_credit_query["Date_of_Request"] != '' && $result_credit_query["Date_of_Request"] != '1970-01-01'){$req_date = date('d-m-Y',strtotime($result_credit_query["Date_of_Request"]));}else{$req_date = '-';}
        
        
                $template .= '<tr>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
                        <tr>
                            <td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">'.$result_credit_query['CAPS_Applicant_Details']["First_Name"].'</td>
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
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query['CAPS_Applicant_Details']["IncomeTaxPan"].'</td>
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
                            <td style="padding: 5px;padding-left: 15px">'.$result_credit_query['CAPS_Applicant_Details']["MobilePhoneNumber"].'</td>
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