<?php
class Mdl_category extends CI_Model
{
    public function addCategory($data)
    {
        $this->db->insert('main_category', $data);
        return $this->db->insert_id();
    }

    public function editCategoryById($data, $id)
    {
        $this->db->where('mid', $id);
        $this->db->update('main_category', $data);

        $date_update = array(
            't_event_date' => $data['event_date'],
        );

        $this->db->where('cat_id', $id);
        return $this->db->update('tamplet', $date_update);
    }

    public function CategoryList($start_date,$end_date)
    {
        $this->db->select('m.*,c.cat_title');
        $this->db->from('main_category as m');
        if($start_date !="" && $end_date !=""){
            $this->db->where('m.event_date >',$start_date);
            $this->db->where('m.event_date <',$end_date);
        }
        $this->db->join('category as c', 'm.c_id=c.cid', 'left');
        $list = $this->db->get();
        return $list->result_array();
    }
    public function MainCategoryList()
    {
        $list = $this->db->get('category');
        return $list->result_array();
    }

    public function getCategoryById($id)
    {
        $query = $this->db->where('mid', $id)->get('main_category');
        return $query->row_array();
    }

    public function deleteCategoryById($id)
    {
        $this->db->where('mid', $id);
        return $this->db->delete('main_category');
    }

    public function categorychk($name)
    {
        $result = $this->db->where('mtitle', $name)
            ->get('main_category');
        return $result->result_array();
    }
    public function updatecategory($id, $data)
    {
        $syn = explode('/', $id);
        $this->db->where($syn[0], $syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    /*public function checkcategorybyid($id)
    {
        $this->db->select('count(*) as count');
        $this->db->where('mid', $id);
        $record = $this->db->get('ads_api')->row_array();

        return $record['count'];
    }*/

    function checkCategoryData($c_id, $mtitle)
    {
        $this->db->select('mid');
        $this->db->where('c_id', $c_id);
        $this->db->where('mtitle', $mtitle);
        $query = $this->db->get('main_category');
        return $query->num_rows();
    }
    public function updateCategoryByExcell($data, $c_id, $mtitle)
    {
        $this->db->where('c_id', $c_id);
        $this->db->where('mtitle', $mtitle);
        return $this->db->update('main_category', $data);
    }

    function insertExcellCategory($data)
    {
        $this->db->insert_batch('main_category', $data);
    }
}
