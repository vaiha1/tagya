<?php

$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';
$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

require('aws/aws-autoloader.php');
use Aws\S3\S3Client;
define('AWS_KEY', 'AKIAIQUEG4LKFMZ6VLTQ');
define('AWS_SECRET_KEY', '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');
$s3 = S3Client::factory(array(
    'key'      => AWS_KEY,
    'secret'   => AWS_SECRET_KEY
));

$bucket = 'tagyas3';
$user_id=$_REQUEST['user_id'];
if(isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
	$upload = $s3->upload($bucket, 'profile_images/'.$_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
    $path= htmlspecialchars($upload->get('ObjectURL')); 
   	$updat_sql = "update tagya_users set profile_image= '$path' where id= '$user_id'";  
	$result= mysql_query($updat_sql);   
	if (!$result) {
		//$arr = array("Registration"=>"Failed", "message"=>"Error");	
		$result1 = array("status"=>"Failed", "message"=>"Error");
	}
	else{
		
		$result1 = array("status"=>"success", "message"=>"Profile image updated  successfully.");
	}
}
 
header('Content-type: application/json');
echo json_encode($result1); 

?>
<!--<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="profile_image.php" method="POST">
            <input name="userfile" type="file" /><input type="submit" value="Upload" />
            <input name="user_id" type="hidden" value="<?php echo $user_id; ?>"/>
        </form>
    </body>
</html>-->