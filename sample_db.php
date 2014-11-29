<?php
$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

 $sql = "INSERT INTO tagya_users(user_name,email, address,profile_image,fb_id,twitter_id,created_date) VALUES('test','test', 'test','test', 'test','test','2014-11-29')";
$result=mysql_query($sql);
echo $result;
//echo 'success';
mysql_close();
?>		