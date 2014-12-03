<?php

/*require('aws/aws-autoloader.php');
use Aws\S3\S3Client;*/


$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$user_name=$_REQUEST['username'];
$email=$_REQUEST['email'];
$city_state=$_REQUEST['address'];

$fb_id=$_REQUEST['fb_id'];
$twitter_id=$_REQUEST['twitter_id'];
$register_date=$_REQUEST['created_date'];

$user_id=$_REQUEST['user_id'];
$profile=$_REQUEST['profile_image'];

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

if($user_id!='')
{ 

}

else
{
	
 $sql = "INSERT INTO tagya_users(user_name,email, address,fb_id,twitter_id,created_date) VALUES('$user_name','$email', '$city_state','$fb_id','$twitter_id','$register_date')";
 $result=mysql_query($sql);
 $get_id = mysql_insert_id();

 $res = array("status"=>"success", "message"=>"register successfully.","user_id"=>$get_id);
	
header('Content-type: application/json');
echo json_encode($res);

}
?>		