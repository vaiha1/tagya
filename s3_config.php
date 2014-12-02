<?php
// Bucket Name
$bucket="BucketName";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJ6ZDK6VP7WZUL4RQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
?>