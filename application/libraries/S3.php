<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once './vendor/autoload.php'; // Load AWS SDK for PHP

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3
{
    protected $ci;
    protected $s3Client;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->config->load('aws');

        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region'  => $this->ci->config->item('aws_region'),
            "endpoint" => "https://sgp1.digitaloceanspaces.com",
            'credentials' => [
                'key'    => $this->ci->config->item('aws_access_key'),
                'secret' => $this->ci->config->item('aws_secret_key'),
            ],
        ]);
    }

    public function uploadObject($filePath, $fileName, $bucket)
    {
        try {
            $result = $this->s3Client->putObject([
                'Bucket' => $bucket,
                'Key'    => $fileName,
                 'ACL' => 'public-read', 
                'SourceFile' => $filePath,
            ]);
           /*  echo "1---";
            print_r($result['ObjectURL']);exit; */
            return $result['ObjectURL'];
        } catch (S3Exception $e) {
           /*  echo "3---";
            print_r($e->getMessage());exit; */
            return $e->getMessage();
        }
    }
}
