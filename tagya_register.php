<?php

require('aws/aws-autoloader.php');
use Aws\S3\S3Client;


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

$user_id=$_REQUEST['username'];
$profile=$_REQUEST['profile_image'];

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);



if(user_id!='')
{
	
define('AWS_KEY', 'AKIAJ6ZDK6VP7WZUL4RQ');
define('AWS_SECRET_KEY', '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');
$s3 = S3Client::factory(array(
    'key'      => AWS_KEY,
    'secret'   => AWS_SECRET_KEY
));

$bucket = 'tagyas3';
$blist = $s3->listBuckets();
echo "<br>Buckets belonging to " . $blist['Owner']['ID'] . ":<br>";
echo "<br>Bucket listing ..<br>";
foreach ($blist['Buckets'] as $b) {
    echo "{$b['Name']} &nbsp;&nbsp;&nbsp; {$b['CreationDate']}<br>";
}


if($_SERVER['REQUEST_METHOD'] == '_REQUEST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
	echo 'hai1';
    try {
        $upload = $s3->upload($bucket, 'profile_images/'.$_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
       $a="echo htmlspecialchars($upload->get('ObjectURL'))";
	   $updat_sql = "update tagya_users set profile_image='$upload' where id='$user_id'";
	 //  header('Content-type: application/json');
	  // echo json_encode($result);
} 
catch(Exception $e) { 
        echo  $e; 
 } }
 
}




else
{
	echo 'hai2';
 $sql = "INSERT INTO tagya_users(user_name,email, address,fb_id,twitter_id,created_date) VALUES('$user_name','$email', '$city_state','$fb_id','$twitter_id','$register_date')";
$result=mysql_query($sql);
$get_id = $db->lastInsertId();
$res = array("status"=>"success", "message"=>"register successfully.","user_id"=>$get_id);
	
header('Content-type: application/json');
echo json_encode($result);
//echo $result;
}
//echo 'success';
mysql_close();

?>		