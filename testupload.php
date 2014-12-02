<?php
echo 'hai';
require('aws/aws-autoloader.php');
echo "require included";
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
/* $s3 =  S3Client::factory(array(
    'key'    => 'AKIAJ6ZDK6VP7WZUL4RQ',
    'secret' => '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',
)); */
$s3 =  S3Client::factory();

$bucket = 'tagyas3';
echo $bucket;
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
	//echo 'hai';
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="sample_upload.php" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>