<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Webhooks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function whatsapp() {

        $mod = $this->input->get('hub_mode');
        $challenge = $this->input->get('hub_challenge');
        $verify_token = $this->input->get('hub_verify_token');
        if($verify_token!="")
        {
            echo $challenge;
        }


        $payload = file_get_contents('php://input');
        if($payload)
        {
            $data_test = array(
                'testName' =>"webhook",
                'testData' =>$payload,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('test', $data_test);
        }
    }
    
}
