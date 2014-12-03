<?php

$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

$user_id = $_REQUEST['user_id'];
$utype = $_REQUEST['utype'];
$email = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$created_at = $_REQUEST['created_at'];

if($user_id!='')
{ 
	$sql = "INSERT INTO tagya_users(user_id,utype,fname, lname, email, address, created_at) VALUES('$user_id','$utype','$fname','$lname','$email', '$address','$created_at')";
	$result=mysql_query($sql);
	$get_id = mysql_insert_id();
	
	$res = array("status"=>"success", "message"=>"register successfully.", "user_id" => $user_id);
	
	header('Content-type: application/json');
	echo json_encode($res);
}
else{
	$res = array("status"=>"fail", "message"=>"Insufficient input.", "user_id" => "-");
	
	header('Content-type: application/json');
	echo json_encode($res);	
}
?>		