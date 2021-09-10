<?php

require('./Server.php');

if (isset($_POST['btn'])) {

    $user_name = filter_input(INPUT_POST, 'uname');
    $fisrt_name = filter_input(INPUT_POST, 'fname');
    $last_name = filter_input(INPUT_POST, 'lname');
    $gender = filter_input(INPUT_POST, 'emm');
    $email_add = filter_input(INPUT_POST, 'pass');
    $password = filter_input(INPUT_POST, 'st');
    $branch = filter_input(INPUT_POST, 'loc');
    $status = filter_input(INPUT_POST, 'typ');
	$stat = filter_input(INPUT_POST, 'stu');


    $sql= "insert into user(nic,fname,lname,email,password,software_type,location,user_type,status) values "
            . "('$user_name','$fisrt_name', '$last_name','$gender','$email_add','$password','$branch','$status','$stat')";

    if (mysqli_query($connection, $sql)) {
        echo "<script type='text/javascript'>alert('New record created successfully !')</script>";
        require('./Super_adminadduser.php');
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($connection);
    }
    mysqli_close($connection);
}

