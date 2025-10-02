<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserVerify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($token, $id)
    {
        if ($token != '' && $id != "") {
            $query = $this->db->where('user_id', $id)->where('token', $token)->get('user_verify');
            $token_count = $query->num_rows();
            if ($token_count > 0) {
                $data = array(
                    'status' => 1,
                    'updated_date' => CURRENT_DATE,
                );
                $this->db->where('id', $id);
                $this->db->update('admin', $data);

                $this->db->where('user_id', $id);
                $this->db->delete('user_verify');

                echo "Your account is activet, Thank you! ";
            } else {
                redirect(base_url() . "verifySuccess");
            }
        } else {
            redirect(base_url() . "verifySuccess");
        }
    }
    public function verifySuccess()
    {
        echo "Free Festival Post <a href='https://playstore/' target='_blank'>Download App</a>";
    }
}
