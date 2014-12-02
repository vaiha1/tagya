<?php
$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$user_name=$_REQUEST['username'];
$email=$_REQUEST['email'];
$city_state=$_REQUEST['address'];
$profile=$_REQUEST['profile_image'];
$fb_id=$_REQUEST['fb_id'];
$twitter_id=$_REQUEST['twitter_id'];
$register_date=$_REQUEST['created_date'];

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

 $sql = "INSERT INTO tagya_users(user_name,email, address,profile_image,fb_id,twitter_id,created_date) VALUES('$user_name','$email', '$city_state','$profile', '$fb_id','$twitter_id','$register_date')";
$result=mysql_query($sql);
echo $result;
//echo 'success';
mysql_close();
?>		