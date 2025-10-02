<?php
class Mdl_imagescopy extends CI_Model
{
    public function getTampList($cat_id){

        $this->db->select('tid,path');
        if($cat_id!="all" && $cat_id!=""){
            $this->db->where('cat_id',$cat_id);
        }
        return $this->db->get('tamplet')->result_array();
    }
    public function getCategoryName(){

        $this->db->select('mid,mtitle,mslug');
        return $this->db->get('main_category')->result_array();
    }
    
}
