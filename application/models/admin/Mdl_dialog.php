<?php
class Mdl_dialog extends CI_Model
{
    public function getDialogById()
    {
        $query = $this->db->get('olddailog');
        return $query->row_array();
    }
    public function updateDialogValue($data)
    {
        return $this->db->update('olddailog', $data);
    }
}
