<?php
class Mdl_position extends CI_Model
{
    public function getPositionList()
    {
        $this->db->select("*");
        $this->db->from("position");
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getCTypeList()
    {
        $this->db->select("*");
        $this->db->from("c_type");
        $list = $this->db->get();
        return $list->result_array();
    }
    public function addPosition($data)
    {
        $this->db->insert('position', $data);
        return $this->db->insert_id();
    }
    public function UpdatePosition($data, $id)
    {
        $this->db->where('pid', $id);
        return $this->db->update('position', $data);
    }
    public function getPositionById($id)
    {
        $query = $this->db->where('pid', $id)->get('position');
        return $query->row_array();
    }








    public function TamplateDelete($id)
    {
        $this->db->where('tid', $id)->delete('tamplet');
    }
}
