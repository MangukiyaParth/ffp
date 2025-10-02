<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use Aws\S3\S3Client;

class Sdemo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
     
    }

    public function index()
    {
        
        $s3Client  = new S3Client([
            'version' => 'latest',
            'region'  => 'ap-south-1',
            'credentials' => [ 
                'key'=>'AKIAZWSAVTCVP6AU2RCP',
                'secret'=>'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'
           ]
        ]);
        
        $bucket = 'ffp-s3-f';
        /* upload krvani image no path - jyathi image ave che te */
        $file_Path =  PUBPATH .'media/Admin.png';
        $fileName = basename($file_Path);
        /* jya s3 buket ma upload krvani che te path */
        $bucketPath = 'media/category/' . $fileName;

       
        try {
            $result = $s3Client->putObject([
                'Bucket' => $bucket,
                'Key'    => $bucketPath,
                'Body'   => fopen($file_Path, 'r'),
                'ACL'    => 'public-read',
            ]);
            $msg = 'File has been uploaded';
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo $e->getMessage();
        }
        $msg = 'File has been uploaded';
        echo $msg;
    }
}
