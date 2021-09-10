<?php

require_once './connect.php';

$response = array();

 if(isset($_GET['apicall'])){
 
 switch($_GET['apicall']){

        case 'login':
            if (isTheseParametersAvailable(array('nic', 'password'))) {

                $nic = filter_input(INPUT_POST, 'nic');
                $password = md5(filter_input(INPUT_POST, 'password'));


                $stmt = $conn->prepare("SELECT iduser, nic, email, location FROM user WHERE nic = ? AND password = ? AND user_type='User' AND status ='active'");
                $stmt->bind_param("ss", $nic, $password);

                $stmt->execute();

                $stmt->store_result();


                if ($stmt->num_rows > 0) {

                    $stmt->bind_result($id, $nic, $email, $location);
                    $stmt->fetch();

                    $user = array(
                        'iduser' => $id,
                        'nic' => $nic,
                        'email' => $email,
                        'location' => $location
                    );

                    $response['error'] = false;
                    $response['message'] = 'Login successfull';
                    $response['user'] = $user;
                } else {

                    $response['error'] = false;
                    $response['message'] = 'Invalid username or password';
                }
            }
            break;

function isTheseParametersAvailable($params) {


    foreach ($params as $param) {

        if (!empty(filter_input(INPUT_POST, $param)) == 0) {

            return false;
        }
    }

    return true;
}

echo json_encode($response);
