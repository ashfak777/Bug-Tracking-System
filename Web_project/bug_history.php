<?php
 require_once 'connect.php';
 

 if(isTheseParametersAvailable(array('user_iduser'))){
         $uid = filter_input(INPUT_POST, 'user_iduser');
	 $stmt = $conn->prepare("SELECT idbug_details,bug_topic,bug_piroty,bug_deatails,time FROM bug_details WHERE user_iduser=?");
	 $stmt->bind_param("s",$uid);
	 $result = $stmt->execute();
	 if($result == TRUE){
		 $response['error'] = false;
		 $response['message'] = "Retrieval Successful!";
		 $stmt->store_result();
		 $stmt->bind_result($cid,$name,$dist,$price,$state);
		 $stmt->fetch();
                 $response['idbug_details'] = $cid;
		 $response['bug_topic'] = $name;
                 $response['bug_piroty'] = $dist;
		 $response['bug_deatails'] = $price;
                 $response['time'] = $state;
                 
                 
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
 
 
 