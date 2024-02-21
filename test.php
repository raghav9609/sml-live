<?php 


    require_once(dirname(__FILE__) . '/config/config.php');	
    echo "Helloooo";

exit;
    if($Conn1){
        echo "Connected";
    }

    $query = "CREATE TRIGGER `Data Split` AFTER INSERT ON `crm_raw_data`
    FOR EACH ROW BEGIN
   DECLARE get_cust_id bigint(20);
   DECLARE get_last_raw_data_id bigint(20);
   IF new.phone_no > 0 THEN
   SELECT id INTO get_cust_id from crm_customer where phone_no = new.phone_no;
   IF get_cust_id IS NULL THEN
   INSERT INTO crm_customer (phone_no,name,email_id,pincode,dob,net_income) VALUES (new.phone_no,new.name,new.email_id,new.pincode,new.dob,new.net_income);
   SELECT id INTO get_cust_id from crm_customer where phone_no = new.phone_no;
   ELSE
   update crm_customer set occupation_id = new.occupation_id,name = new.name,email_id=new.email_id, city_id=new.city_id,pincode=new.pincode,pan_no =new.pan_no,marital_status_id=new.marital_status_id,gender=new.gender,dob=new.dob,net_income=new.net_income,mode_of_salary = new.mode_of_salary, salary_bank_id = new.salary_bank_id,total_work_exp=new.total_work_exp,company_id = new.company_id,company_name = new.company_name, is_phone_no_verified=1, phone_verified_on=NOW() where phone_no = new.phone_no;
   END IF;
   IF get_cust_id > 0 THEN
   INSERT INTO crm_query (net_income,crm_raw_data_id,crm_customer_id,loan_type_id,loan_amount,purpose_of_loan,lead_assign_to,lead_assign_on,query_status,query_status_desc,verify_phone, tool_type, page_url,created_on) VALUES (new.net_income,new.id,get_cust_id,new.loan_type_id,new.loan_amount,new.purpose_of_loan, new.lead_assign_to, new.lead_assign_on, new.query_status, new.description, new.verify_phone, new.tool_type, new.page_url, NOW());
   SELECT id INTO get_last_raw_data_id from crm_query where crm_raw_data_id = new.id;
   IF get_last_raw_data_id > 0 THEN
   IF new.xml_report IS NOT NULL THEN
   INSERT INTO crm_experian_data (query_id,xml_report) VALUES(get_last_raw_data_id,new.xml_report);
   END IF;
   END IF;
   END IF;
   END IF;
   END;";
    mysqli_query($Conn1,$query) or die(mysqli_error($Conn1));
?>