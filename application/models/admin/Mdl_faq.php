<?php
class Mdl_faq extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('photoId','pcat_title','title','photo','created_at');
        $this->column_search = array('photoId','pcat_title','title','photo','created_at');
        /* $this->order = array('tid' => 'asc'); */
    }

    public function addfaq($type)
    {
        $this->db->insert('faq', $type);
        return true;
    }
    public function getfaqlist()
    {
        $list =$this->db->select("*")->get("faq");
        return $list->result_array();
    }
    public function getfaqDataByID($id)
    {
        $this->db->select("*")->from("faq");
        $this->db->where("faq_id", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function faqDelete($id)
    {
        $this->db->where('faq_id', $id)->delete('faq');
    }
     public function updatefaq($data,$id)
    {
        $this->db->where('faq_id', $id);
        return $this->db->update('faq', $data);
    }
    
}
