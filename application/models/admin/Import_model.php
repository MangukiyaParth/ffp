<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('admin', $data);
    }
}
