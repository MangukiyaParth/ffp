<?php
class Mdl_home_category extends CI_Model
{

    public $homeCategoryTable = 'home_category';
    public $mainCategoryTable = 'main_category';

    public function addCategory($data)
    {
        $this->db->insert($this->homeCategoryTable, $data);
        return $this->db->insert_id();
    }

    public function getList()
    {
      $query =  $this->db->select('hc.*, mc.mtitle')
        ->join($this->mainCategoryTable . ' as mc', 'hc.category_id = mc.mid')
        ->order_by('sequence', 'ASC')
        ->get($this->homeCategoryTable .' as hc');

        return $query->result_array();
        
    }

    public function getDataByID($id)
    {
        $this->db->select("*");
        $this->db->where("id", $id);
        $list = $this->db->get($this->homeCategoryTable);
        return $list->row_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->homeCategoryTable);
    }

    public function update($data,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->homeCategoryTable, $data);
    }


}
