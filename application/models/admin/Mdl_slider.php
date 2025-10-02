<?php
class Mdl_slider extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('photoId','pcat_title','title','photo','created_at');
        $this->column_search = array('photoId','pcat_title','title','photo','created_at');
        /* $this->order = array('tid' => 'asc'); */
    }

    public function addSlider($type)
    {
        $this->db->insert('appSlider', $type);
        return true;
    }
    public function getSliderDeactivelist()
    {
        $list =$this->db->select("*")->where("status","0")->get("appSlider");
        return $list->result_array();
    }
    public function getSliderActivelist()
    {
        $list =$this->db->select("*")->where("status","1")->get("appSlider");/* ->order_by('sid','asc') */
        return $list->result_array();
    }
    public function getSliderDataByID($id)
    {
        $this->db->select("*")->from("appSlider");
        $this->db->where("sid", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function sliderDelete($id)
    {
        $this->db->where('sid', $id)->delete('appSlider');
    }
     public function updateSlider($data,$id)
    {
        $this->db->where('sid', $id);
        return $this->db->update('appSlider', $data);
    }
    
}
