<?php

 require_once './connect.php';
 
 if(isTheseParametersAvailable(array('idbug_details','user_iduser'))){
	 $id = filter_input(INPUT_POST, 'idbug_details');
         $uid = filter_input(INPUT_POST, 'user_iduser');
	 $stmt = $conn->prepare("SELECT bug_topic,bug_piroty,bug_deatails,time,status FROM bug_details WHERE idbug_details = ? and user_iduser=? ");
	 $stmt->bind_param("ss",$id,$uid);
	 $result = $stmt->execute();
	 if($result == TRUE){
		 $response['error'] = false;
		 $response['message'] = "Track Successful!";
		 $stmt->store_result();
		 $stmt->bind_result($name,$price,$description,$date,$status);
		 $stmt->fetch();
		 $response['bug_topic'] = $name;
		 $response['bug_piroty'] = $price;
		 $response['bug_deatails'] = $description;
                 $response['time'] = $date;
				 $response['status'] = $status;
                 
                 
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
 
 
 