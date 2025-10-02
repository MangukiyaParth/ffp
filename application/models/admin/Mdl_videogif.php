<?php
class Mdl_videogif extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('v_id');
        $this->column_search = array('c.mtitle','v.v_id','v.mid','v.type','v.free_paid','v.path','v.lable','v.lablebg','v.created_at','v.updated_at');
        /* $this->order = array('v_id' => 'asc'); */
    }

    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->select("c.mtitle,v.*");
        $this->db->from("videogif as v");
        $this->db->join("main_category as c", 'v.mid=c.mid', 'left');
        /* $this->db->from($this->table); */
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
        
        $this->db->select("c.mtitle,v.*");
        $this->db->from("videogif as v");
        $this->db->join("main_category as c", 'v.mid=c.mid', 'left');
        /* $this->db->from($this->table); */
        
        $i = 0;
        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function getVideogiflist()
    {
        $this->db->select("c.mtitle,v.*");
        $this->db->from("videogif as v");
        $this->db->join("main_category as c", 'v.mid=c.mid', 'left');
        $list = $this->db->get();
        return $list->result_array();
    }
    public function addVideogif($data)
    {
        $this->db->insert('videogif', $data);
        return $this->db->insert_id();
    }
    public function UpdateVideogif($data, $id)
    {
        $this->db->where('v_id', $id);
        return $this->db->update('videogif', $data);
    }
    public function getVideogifById($id)
    {
        $this->db->select("*");
        $this->db->where("v_id", $id);
        $list = $this->db->get('videogif');
        return $list->row_array();

        /* $query = $this->db->where('v_id', $id)->get('videogif');
        return $query->row_array(); */
    }
    public function VideogifDelete($id)
    {
        $this->db->where('v_id', $id)->delete('videogif');
    }
    public function getPositionByCategoryName($c_type_id)
    {
        $this->db->select("*");
        $this->db->where("c_type", $c_type_id);
        $list = $this->db->get('position');
        return $list->result_array();
    }
}
