<?php
class Mdl_whatsappmedia extends CI_Model
{
    function __construct() {
    }

    public function addMedia($type)
    {
        $this->db->insert('whatsapp_media', $type);
        return true;
    }
    public function getMediaList()
    {
        $list =$this->db->select("*")->get("whatsapp_media");
        return $list->result_array();
    }
    public function getMediaDataByID($id)
    {
        $this->db->select("*")->from("whatsapp_media");
        $this->db->where("wmid", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function mediaDelete($id)
    {
        $this->db->where('wmid', $id)->delete('whatsapp_media');
    }
     public function updateSlider($data,$id)
    {
        $this->db->where('wmid', $id);
        return $this->db->update('whatsapp_media', $data);
    }
    
}
