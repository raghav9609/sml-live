<?php 

require_once(dirname(__FILE__) . '/../config/session.php');
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../helpers/common-helper.php');
error_reporting(E_ALL); 
ini_set('display_errors', true); 
libxml_use_internal_errors(false);

$query_id = base64_decode($_REQUEST['query_id']);
$getbureaudetails = mysqli_query($Conn1,"Select * from crm_experian_data where query_id = '".$query_id."'");
    $resultbureaudetails = mysqli_fetch_array($getbureaudetails);
    $bureauData = $resultbureaudetails['xml_report'];
    if($bureauData != ''){
        $dispBureauData = base64_decode($bureauData);
        $ob = simplexml_load_string(html_entity_decode($dispBureauData));
        $json  = json_encode($ob);
        $returnResponse = json_decode($json, true);
        print_r($returnResponse);

    }
    ?>

<!DOCTYPE html>
<!-- saved from url=(0055)https://crm.moneywide.com/bureau/cibil.php?hid=ODQzMzI5 -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>Credit Report</title></head>
	<body style="background: #d6d6d6;font-family: inherit;margin-bottom: 20px;margin-top: 20px"><table style="min-width: 800px;max-width:900px;background: #ffffff;border: 1px solid #000000;margin: auto;font-size: 13px;padding: 20px">
		<tbody><tr>
			<td width="75%" style="padding-top:10px">
			</td>
			<td width="25%" style="font-size: 14px;text-align: right;padding-top:10px"><span style="color: #008db1;font-weight: bold;">ERN : </span><span>006539780914</span><br><span style="color: #008db1;font-weight: bold;">Report Date : </span><span><?php echo $returnResponse['Header']['ReportDate'];?></span><br><span style="color: #008db1;font-weight: bold;">Bureau Name : </span><span>Cibil</span></td>
		</tr>
		<tr><td colspan="2" style="color: #f06c00;text-align: center;font-weight: bold;font-size: 18px;padding: 10px"></td></tr>
		<tr><td style="border-top: 1px solid #d6d6d6" colspan="2"></td></tr>
		<tr> 
			<td style="font-size: 25px;padding: 20px 10px;">DEEPIKA KUMAR's Credit Report</td>
			<td style="text-align: right;">&nbsp;</td>
		</tr>
		<tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Credit Score</span></td></tr>
		<tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">Your Credit Report is summarized in the form of Credit Score which ranges from 300 - 900</td></tr>
		<tr>
			<td colspan="2">
				<table style="width: 100%;">
					<tbody><tr>
						<td width="20%"><img src="./Credit Report_files/experian-red.png" width="100%"></td>
						<td style="font-size: 25px;padding: 15px;font-weight: bold;" width="10%">000-1</td>
						<td width="70%">
							<table style="width: 100%;border: 1px solid #dddddd;">
								<tbody><tr><td colspan="2" style="padding: 10px 5px"><span style="font-size: 15px;font-weight: bold;text-decoration: underline;padding-bottom: 10px">Score Factors</span></td></tr>
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
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr><tr><td colspan="2" style="padding: 10px 0px"></td></tr>
		<tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Report Summary</span></td></tr>
		<tr>
			<td colspan="2" style="padding: 15px 0px">
				<table width="100%">
					<tbody><tr>
						<td width="33.33%" style="border-right: 1px solid #d6d6d6;">
							<table width="100%">
								<tbody><tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Credit Account Summary</td></tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Total Accounts</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Active Accounts</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Closed Accounts</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled</td><td width="25%">0</td>
								</tr>
							</tbody></table>
						</td>
						<td width="33.33%" style="border-right: 1px solid #d6d6d6;">
							<table width="100%">
								<tbody><tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Current Balance Amount Summary</td></tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Total Current Bal. amt</td><td></td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">SF/WD/WO/Settled amt</td><td></td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Secured Accounts amt</td><td></td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Unsecured Accounts amt</td><td></td>
								</tr>
							</tbody></table>
						</td>
						<td width="33.33%">
							<table width="100%">
								<tbody><tr><td colspan="2" style="font-size: 15px;font-weight: 600;color: #008db1;padding-bottom: 8px;">Credit Enquiry Summary</td></tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Last 7 days credit enquiries</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Last 30 days credit enquiries</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Last 90 days credit enquiries</td><td width="25%">0</td>
								</tr>
								<tr>
									<td style="color: #008db1;font-weight: 600;padding: 5px">Last 180 days credit enquiries</td><td width="25%">0</td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Address(es)</span></td></tr>
		
		<tr>
			<td colspan="2" style="padding-bottom: 20px">
				<table width="100%" style="border: 1px solid #dddddd;">
					<tbody><tr style="color: #008db1;font-weight: 600">
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Address</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Category</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Residence Code</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Date Reported</td>
					</tr><tr>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">MEERUT,UTTAR PRADESH     </td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">Residence Address</td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;"></td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">2023-10-04</td>
					</tr></tbody></table>
			</td>
		</tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Telephone(s)</span></td></tr>
	
		<tr>
			<td colspan="2" style="padding-bottom: 20px">
				<table width="100%" style="border: 1px solid #dddddd;">
					<tbody><tr style="color: #008db1;font-weight: 600">
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Telephone Type</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Telephone Number</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Telephone Extension</td>
					</tr><tr>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">Mobile Phone</td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">9634237584</td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;"></td>
					</tr></tbody></table>
			</td>
		</tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Email Address(es)</span></td></tr>

		<tr>
			<td colspan="2" style="padding-bottom: 20px">
				<table width="100%" style="border: 1px solid #dddddd;">
					<tbody><tr style="color: #008db1;font-weight: 600">
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Email Address</td>
					</tr></tbody></table>
			</td>
		</tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Identification(s)</span></td></tr>
		
		<tr>
			<td colspan="2" style="padding-bottom: 20px">
				<table width="100%" style="border: 1px solid #dddddd;">
					<tbody><tr style="color: #008db1;font-weight: 600">
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Identification Type</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Identification NUMBER</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Issue Date</td>
						<td style="border-right: 1px solid #d6d6d6;padding: 5px;">Expiration Date</td>
					</tr><tr>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">Income Tax ID Number (PAN)</td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;">EJGPK1826R</td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;"></td>
						<td style="border-right: 1px solid #d6d6d6;border-top:1px solid #d6d6d6;padding: 5px;"></td>
					</tr></tbody></table>
			</td>
		</tr><tr><td style="background: #efefef;padding: 5px 0px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">SUMMARY : Credit Account Information</span></td></tr>
		<tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section displays summary of all your reported credit accounts found in the Credit Bureau database.</td></tr>
		<tr>
			<td colspan="2" style="padding-bottom: 20px">
				<table width="100%" style="border: 1px solid #dddddd;">
					<tbody><tr style="color: #008db1;font-weight: 600">
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
					</tr></tbody></table>
			</td>
		</tr>
		<tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">Credit Account Information details</span></td></tr>
		<tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section has information based on the details provided to our Bureau Partner by all our member banks, credit / financial institutions and other credit grantors with whom you have a credit / loan account.</td></tr><tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">CREDIT ENQUIRIES</span></td></tr>
		<tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2"> This section shows the names of the credit institutions that have processed a credit / loan application for you.</td></tr><tr>
			<td colspan="2">
				<table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
					<tbody><tr>
						<td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">DEEPIKA KUMAR</td>
					</tr>
					<tr>
						<td style="font-weight: bold;color:#008db1;padding-right: 15px;padding: 5px">Address 1</td>
						<td colspan="4" style="padding-left: 15px;padding: 5px">-</td>
						<td style="text-align: center;font-weight: 600;padding: 5px"><img src="./Credit Report_files/tick.png"><span style="vertical-align: super;">Cr Enq 1</span></td>
					</tr>
					<tr><td height="10" colspan="6"></td></tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Date of Birth</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>PAN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>ERN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Telephone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Passport Number</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Search Type</b></td>
						<td style="padding: 5px;padding-left: 15px">Personal Loan</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Mobile Phone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Voter ID</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Credit Institution Name</b></td>
						<td style="padding: 5px;padding-left: 15px">NOT DISCLOSED</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Gender</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>Driving License</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Application date</b></td>
						<td style="padding: 5px;padding-left: 15px">2023-10-04</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Marital Status</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Ration Card</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Amount applied for</b></td>
						<td style="padding: 5px;padding-left: 15px">5,000</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Email</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Duration of Agreement</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
				</tbody></table>
			</td>
		</tr><tr>
			<td colspan="2">
				<table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
					<tbody><tr>
						<td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">DEEPIKA KUMAR</td>
					</tr>
					<tr>
						<td style="font-weight: bold;color:#008db1;padding-right: 15px;padding: 5px">Address 1</td>
						<td colspan="4" style="padding-left: 15px;padding: 5px">-</td>
						<td style="text-align: center;font-weight: 600;padding: 5px"><img src="./Credit Report_files/tick.png"><span style="vertical-align: super;">Cr Enq 1</span></td>
					</tr>
					<tr><td height="10" colspan="6"></td></tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Date of Birth</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>PAN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>ERN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Telephone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Passport Number</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Search Type</b></td>
						<td style="padding: 5px;padding-left: 15px">Personal Loan</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Mobile Phone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Voter ID</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Credit Institution Name</b></td>
						<td style="padding: 5px;padding-left: 15px">NOT DISCLOSED</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Gender</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>Driving License</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Application date</b></td>
						<td style="padding: 5px;padding-left: 15px">2023-10-04</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Marital Status</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Ration Card</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Amount applied for</b></td>
						<td style="padding: 5px;padding-left: 15px">3,000</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Email</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Duration of Agreement</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
				</tbody></table>
			</td>
		</tr><tr>
			<td colspan="2">
				<table cellpadding="0" cellspacing="0" style="border: 1px solid #dddddd;padding: 5px;font-size: 12px;width: 100%">
					<tbody><tr>
						<td style="font-weight: bold;color:#008db1;padding: 5px" colspan="6">DEEPIKA KUMAR</td>
					</tr>
					<tr>
						<td style="font-weight: bold;color:#008db1;padding-right: 15px;padding: 5px">Address 1</td>
						<td colspan="4" style="padding-left: 15px;padding: 5px">-</td>
						<td style="text-align: center;font-weight: 600;padding: 5px"><img src="./Credit Report_files/tick.png"><span style="vertical-align: super;">Cr Enq 1</span></td>
					</tr>
					<tr><td height="10" colspan="6"></td></tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Date of Birth</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>PAN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>ERN</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Telephone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Passport Number</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Search Type</b></td>
						<td style="padding: 5px;padding-left: 15px">Personal Loan</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Mobile Phone</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Voter ID</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Credit Institution Name</b></td>
						<td style="padding: 5px;padding-left: 15px">NOT DISCLOSED</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Gender</b></td>
						<td style="padding: 5px;padding-left: 15px"></td>
						<td style="color: #008db1;padding: 5px"><b>Driving License</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Application date</b></td>
						<td style="padding: 5px;padding-left: 15px">2023-10-04</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Marital Status</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Ration Card</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Amount applied for</b></td>
						<td style="padding: 5px;padding-left: 15px">5,000</td>
					</tr>
					<tr>
						<td style="color: #008db1;padding-right: 15px;padding: 5px"><b>Email</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
						<td style="color: #008db1;padding: 5px"><b>Duration of Agreement</b></td>
						<td style="padding: 5px;padding-left: 15px">-</td>
					</tr>
				</tbody></table>
			</td>
		</tr><tr><td colspan="2" style="padding-bottom: 20px"></td></tr>
		<!-- Account detals End 1--><tr><td style="background: #efefef;padding: 5px" colspan="2"><img src="./Credit Report_files/tick.png"><span style="font-size: 18px;font-weight: 600;padding: 8px;vertical-align: super;">NON-CREDIT ENQUIRIES</span></td></tr>
		<tr><td style="font-style: italic;color: orange;padding: 15px 0px;" colspan="2">This section shows non-credit enquiries such as authentication requests and request for your Experian Credit Report &amp; Credit Score by you.</td></tr>
		<tr><td colspan="2" style="padding-bottom: 20px"></td></tr></tbody></table>
</body><vmaker-container style="position: fixed; top: 0px; right: 0px; z-index: 99999999; width: 100%; height: 100%; pointer-events: none; user-select: none;"><template shadowrootmode="open"><vm-container id="vmaker-extension-root" data-color-mode="light" data-light-theme="light" style="display: none; margin-left: auto;"></vm-container><div></div></template><style>
          @font-face {
            font-family: 'VM-Poppins';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Poppins-Light.ttf) format('truetype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
          }
          @font-face {
            font-family: 'VM-Poppins';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Poppins-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
          }
          @font-face {
            font-family: 'VM-Poppins';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Poppins-Medium.ttf) format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
          }
          @font-face {
            font-family: 'VM-Poppins';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Poppins-SemiBold.ttf) format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
          }
          @font-face {
            font-family: 'VM-Poppins';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Poppins-Bold.ttf) format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
          }
          @font-face {
            font-family: 'VM-Allerta';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Allerta-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Charmonman';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Charmonman-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Comic Neue';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/ComicNeue-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Open Sans';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/OpenSans-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Poiret One';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/PoiretOne-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Signpainter';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Sign-Painter-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Futura';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Futura-Light-font.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Barlow';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/Barlow-Regular.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Norwester';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/norwester.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
          @font-face {
            font-family: 'VM-Europa';
            src: url(chrome-extension://bjibimlhliikdlklncdgkpdmgkpieplj/static/media/europa.ttf) format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: auto;
          }
        </style></vmaker-container></html>