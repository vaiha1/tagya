<?php
$dbhost = 'tagya-db.cgxgvzgqoani.us-east-1.rds.amazonaws.com';
$username = 'tagya_user_1';
$password = 'S8DEh=)xz7wYT#-';
$dbname = 'tagya_db';

$link = mysql_connect($dbhost, $username, $password);
mysql_select_db($dbname);
?>
<html>
<body>

<form action="sample1.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="UploadImage" name="submit">
</form>

</body>
</html>

<?php
$bucket = 'tagyas3';
$keyname = 'UploadImage';
// $filepath should be absolute path to a file on disk						
$filepath = ' tagyas3/profile_images';
						
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
    'Metadata'     => array(    
        'param1' => 'value 1',
        'param2' => 'value 2'
    )
));

mysql_close();
?>		