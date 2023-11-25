<?php 
class queryModel {
    function queryDetails ($offset = 0,$where=array(),$max_offset=11,$columns_to_fetch = array("*")){
        $queryReturn = "select ".implode($columns_to_fetch)." from crm_query";
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
		$queryReturn .= " ORDER BY id DESC LIMIT ".$offset.", ".$max_offset;
        return $queryReturn;
    }
	function fetchDetails ($offset = 0,$where=array(),$max_offset=11){
		$queryReturn = "SELECT qry.id As query_id, qry.crm_customer_id As customer_id, qry.loan_type_id As product_id,  qry.lead_assign_to As assign_user, qry.created_on, cust.name As customer_name, cust.email_id, cust.phone_no, cust.city_id from crm_query As qry left JOIN crm_customer As cust ON qry.crm_customer_id = cust.id ";
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
		$queryReturn .= " ORDER BY qry.id DESC LIMIT ".$offset.", ".$max_offset;
        return $queryReturn;
    }
	
	
    function customerDetails($where=array(),$columns_to_fetch = array("*")){
            $queryReturn = "Select ".implode(',' ,$columns_to_fetch)." FROM customer_info ";
			if(!empty($where)){
				$queryReturn .= " where ".implode(' and ',$where);
			}
        return $queryReturn;
    }

    function getQueryData($qryyy_id,$user_id_fetch,$user_role_fetch){
        $queryReturn = "SELECT city.city_name,qry.created_on, qry.follow_up_date_time,qry.verify_phone,qry.query_status,qry.updated_on, qry.loan_type_id As product_id, qry.assign_date_time, qry.remarks, cust.id as cust_id, cust.customer_name,cust.email_id,cust.phone_no, 
        cust.alternate_phone_no,cust.city_id, cust.pincode,cust.address,cust.is_mobile_blocked, cust.is_verified, prod.value as prod_name, plan.value as plan_name from query_details as qry 
        INNER JOIN customer_info as cust ON qry.crm_customer_id = cust.id 
        INNER JOIN master_product as prod ON qry.loan_type_id = prod.id 
        INNER JOIN master_plan as plan ON qry.plan_id = plan.id 
        LEFT JOIN tbl_user_assign as user ON qry.lead_assign_to = user.user_id 
        LEFT JOIN lms_city as city ON cust.city_id = city.city_id 
        where qry.id = '".$qryyy_id."'";
        if($user_role_fetch == 3){
            $queryReturn .= " and lead_assign_to = ".$user_id_fetch;
        }
        return $queryReturn;
    }

    function getCityID($city_name){
        $queryReturn = "select city_id from lms_city where city_name = '".$city_name."' limit 1";
        return $queryReturn;
    }

    function getCityRecord($city_name){
        $queryReturn = "SELECT * FROM lms_city WHERE city_name LIKE '".$city_name."%' ORDER BY city_name ASC LIMIT 0, 10";
        return $queryReturn;
    }

    function getPhoneAvail($phoneNo){
        $queryReturn = "SELECT id FROM customer_info WHERE phone_no = '".$phoneNo."'";
        return $queryReturn;
    }

    function updateQueryData ($table_name, $upd_arr, $where=array()){
        $queryReturn = "Update  ".$table_name." SET " ;
        $comma = " ";
        foreach($upd_arr as $key => $val) {
            $query .= $comma . $key . " = '" . $val. "'";
            $comma = ", ";
        }
        if(!empty($query)){
            $queryReturn .= $query;
        }
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
        return $queryReturn;
    }

    function insertQueryData ($table_name, $insert_arr){
        $queryReturn = "Insert  ".$table_name." SET " ;
        $comma = " ";
        foreach($insert_arr as $key => $val) {
                $query .= $comma . $key . " = '" . $val. "'";
                $comma = ", ";
        }
        if(!empty($query)){
            $queryReturn .= $query;
        }
        return $queryReturn;
    }

    function getQueryRecord($table_name,$columns_to_fetch = array("*"), $where=null, $order_by=null, $order=null, $offset = 0, $max_offset=null){
        $queryReturn = "select ".implode($columns_to_fetch)." from ".$table_name;
        if(!empty($where)){
            $queryReturn .= " where ".implode(' and ',$where);
        }
        if(!empty($order_by)){
		    $queryReturn .= " ORDER BY ".$order_by." ".$order;
        }
        if(!empty($max_offset)){
		    $queryReturn .= " LIMIT ".$offset.", ".$max_offset;
        }
        return $queryReturn;
    }
    

   
}
    
?>