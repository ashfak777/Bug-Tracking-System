<?php 
 
 require_once 'connect.php';
 
 $upload_path = 'uploads/';
 
 $server_ip = gethostbyname(gethostname());
 
 $upload_url = 'http://'.$server_ip.'/Bug_api/'.$upload_path; 
 
 $response = array(); 
 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 if(isset($_POST['bug_topic'],$_POST['bug_piroty'],$_POST['bug_deatails'],$_POST['uid']) and isset($_FILES['image']['name'])){
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
 
 
 $bug_topic = $_POST['bug_topic'];
 $bug_piroty = $_POST['bug_piroty']; 
 $bug_deatails = $_POST['bug_deatails'];
 $name = $_POST['name']; 
 $uid = $_POST['uid'];
 
 $fileinfo = pathinfo($_FILES['image']['name']);

 $extension = $fileinfo['extension'];
 
 $file_url = $upload_url . getFileName() . '.' . $extension;
 
 $file_path = $upload_path . getFileName() . '.'. $extension; 
 
 try{

 move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
 $sql = "INSERT INTO `bug_db`.`bug_details` (`idbug_details`, `bug_topic`, `bug_piroty`,`bug_deatails`, `date`,`time`,
 `img_name`,`image`,`status`,`user_iduser`) VALUES (NULL,'$bug_topic','$bug_piroty','$bug_deatails',NULL,CURRENT_TIMESTAMP,'$name','$file_url','inprocess','$uid');";
 
 if(mysqli_query($con,$sql)){
 
 $response['error'] = false; 
 $response['url'] = $file_url; 
 $response['name'] = $name;
 $response['bug_topic'] = $bug_topic;
 $response['bug_piroty'] = $bug_piroty;
 $response['bug_deatails'] = $bug_deatails;
 }

 }catch(Exception $e){
 $response['error']=true;
 $response['message']=$e->getMessage();
 } 

 echo json_encode($response);
 
 mysqli_close($con);
 }else{
 $response['error']=true;
 $response['message']='Please choose a file';
 }
 }

 function getFileName(){
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
 $sql = "SELECT max(idbug_details) as idbug_details FROM bug_details";
 $result = mysqli_fetch_array(mysqli_query($con,$sql));
 
 mysqli_close($con);
 if($result['idbug_details']==null)
 return 1; 
 else 
 return ++$result['idbug_details']; 
 }