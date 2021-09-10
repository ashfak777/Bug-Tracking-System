<?php

 require_once 'connect.php';
 
 if(isTheseParametersAvailable(array('bug_details_idbug_details'))){
         $uid = filter_input(INPUT_POST, 'bug_details_idbug_details');
	 $stmt = $conn->prepare("SELECT idbug_soluction,soluction,time,status FROM bug_soluction WHERE bug_details_idbug_details=?");
	 $stmt->bind_param("s",$uid);
	 $result = $stmt->execute();
	 if($result == TRUE){
		 $response['error'] = false;
		 $response['message'] = "Retrieval Successful!";
		 $stmt->store_result();
		 $stmt->bind_result($cid,$name,$dist,$price);
		 $stmt->fetch();
                 $response['idbug_soluction'] = $cid;
		 $response['soluction'] = $name;
                 $response['time'] = $dist;
		 $response['status'] = $price;
                 
                 
	 } else{
		 $response['error'] = true;
		 $response['message'] = "Incorrect id";
	 }
 } else{
	  $response['error'] = true;
	  $response['message'] = "Insufficient Parameters";
 }
 
 function isTheseParametersAvailable($params) {


    foreach ($params as $param) {

        if (!empty(filter_input(INPUT_POST, $param)) == 0) {

            return false;
        }
    }
 
    return true;
}
 echo json_encode($response);
 
 
 