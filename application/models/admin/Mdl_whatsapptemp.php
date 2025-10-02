<?php
class Mdl_whatsapptemp extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('template','type','media','param','lang','created_at');
        $this->column_search = array('template','type','media','param','lang','created_at');
        /* $this->order = array('tid' => 'asc'); */
    }

    public function addTemp($type)
    {
        $this->db->insert('whatsapp_template', $type);
        return true;
    }
    
    public function getTemplist()
    {
        $list =$this->db->select("*")->order_by('sort', 'asc')->get("whatsapp_template");
        return $list->result_array();
    }

    public function getTempDataByID($id)
    {
        $this->db->select("*")->from("whatsapp_template");
        $this->db->where("wtemp_id", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    
    public function tempDelete($id)
    {
        $this->db->where('wtemp_id', $id)->delete('whatsapp_template');
    }

    public function updateTemp($data,$id)
    {
        $this->db->where('wtemp_id', $id);
        return $this->db->update('whatsapp_template', $data);
    }
}
