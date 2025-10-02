<?php

class Mdl_makepost extends CI_Model
{

    public function getUserData($userId)
    {
        $query = $this->db->select('*')
            ->where('id', $userId)
            ->where('role', 1)
            ->where('status', 1)
            ->limit(1)
            ->get('admin');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function checkEmail($email)
    {
        $query = $this->db->select('ad_id')
            ->where('ad_email', $email)
            ->get('admin');

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
