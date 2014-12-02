<?php
//echo 'hai';
require('aws/aws-autoloader.php');
//require 'vendor/autoload.php';

$aws = Aws\S3\S3Client::factory();

$s3v1 = $aws->get('v1.s3');
$s3v2 = $aws->get('s3');

echo "ListBuckets with SDK Version 1:\n";
echo "-------------------------------\n";
$response = $s3v1->listBuckets();
if ($response->isOK()) {
    foreach ($response->body->Buckets->Bucket as $bucket) {
        echo "- {$bucket->Name}\n";
    }
} else {
    echo "Request failed.\n";
}
echo "\n";
?>