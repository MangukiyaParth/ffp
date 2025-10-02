<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Msgwebhook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $request = $_REQUEST["data"];
        $jsonData = json_decode($request,true);
        /* foreach($jsonData as $key => $value){
            $requestID = $value['requestId'];
            $userId = $value['userId'];
            $senderId = $value['senderId'];
            foreach($value['report'] as $key1 => $value1){
                $desc = $value1['desc'];
                $status = $value1['status'];
                $receiver = $value1['number'];
                $deliver_repotr_time = $value1['date'];
            }

            $data = array(
                'request_id' => $jsonData['requestId'],
                'date' => ONLY_DATE,
                'receiver' => $jsonData['report']['number'],
                'status' => $jsonData['report']['status'],
                'description' => $jsonData['report']['desc'],
            ); */
            $data = array(
                'request_id' => $request,
                'date' => ONLY_DATE,
                'receiver' => "",
                'status' => "",
                'description' => "",
            ); 
            $this->db->insert("sms_report", $data);
    }
   
}
