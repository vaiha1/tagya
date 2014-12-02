<?php
/*$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);

*/
$filen = "";

	$filepath = 'tagyas3/profile_images';
	//$file_path = "../upload_files/dishes_image/";
	
	$file_name=$_FILES['fileToUpload']['name'];
	/* generate file name with random no */
	$file_rand=rand(1, 1000000); 
	 $file_name = $file_rand.".jpg";
echo $file_path = $file_path . basename( $_FILES['fileToUpload']['name']);
    //$file_path = $file_path . basename( $file_name);
	echo $file_path;
$bucket = 'tagyas3';
$keyname = 'fileToUpload';
// $filepath should be absolute path to a file on disk						

						
// Instantiate the client.
$s3 = S3Client::factory();

// Upload a file.
$result = $s3->putObject(array(
    'Bucket'       => $bucket,
    'Key'          => $keyname,
    'SourceFile'   => $filepath,
    'ContentType'  => 'text/plain',
    'ACL'          => 'public-read',
    'StorageClass' => 'REDUCED_REDUNDANCY',
    
));

mysql_close();
?>		