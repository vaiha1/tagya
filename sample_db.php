<?php
$dbhost = 'mysql -h tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com -P 3306 -u tagya_user_1 -pS8DEh=)xz7wYT#-';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$link = mysql_connect($dbhost, $username, $password, $dbname);
mysql_select_db($dbname);

 $sql = "INSERT INTO tagya_users(user_name,email, address,profile_image,fb_id,twitter_id,created_date) VALUES('test','test', 'test','test', 'test','test','2014-11-29')";
$result=mysql_query($sql);
echo 'success';
mysql_close();
?>		