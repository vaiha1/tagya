<?php
require('aws/aws-autoloader.php');
use Aws\S3\S3Client;
define('AWS_KEY', 'AKIAIQUEG4LKFMZ6VLTQ');
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

?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>S3 upload example</h1>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    try {
     echo   $upload = $s3->upload($bucket, 'profile_images/'.$_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?php echo htmlspecialchars($upload->get('ObjectURL')); ?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :( <?php echo $e; ?></p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="testupload1.php" method="POST">
            <input name="userfile" type="file" /><input type="submit" value="Upload" />
        </form>
    </body>
</html>