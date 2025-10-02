<?php
class Mdl_tamplate extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('tid','t_event_date');
        $this->column_search = array('tid','type','p_name','t_event_date','path','mtitle','font_type','font_size','font_color');
        /* $this->order = array('tid' => 'asc'); */
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
        $this->db->select("c.mtitle,t.*,p.p_name");
        $this->db->from("tamplet as t");
        $this->db->join("main_category as c", 't.cat_id=c.mid', 'left');
        $this->db->join("position as p", 't.p_id=p.pid', 'left');

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
        
        $this->db->select("c.mtitle,c.mslug,t.*,p.p_name");
        $this->db->from("tamplet as t");
        $this->db->join("main_category as c", 't.cat_id=c.mid', 'left');
        $this->db->join("position as p", 't.p_id=p.pid', 'left');
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
            //$aaa = $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function getTamplatelist()
    {
        $this->db->select("c.mtitle,t.*,p.p_name");
        $this->db->from("tamplet as t");
        $this->db->join("main_category as c", 't.cat_id=c.mid', 'left');
        $this->db->join("position as p", 't.p_id=p.pid', 'left');
        $list = $this->db->get();
        return $list->result_array();
    }
    public function addTamplate($data)
    {
        $this->db->insert('tamplet', $data);
        return $this->db->insert_id();
    }
    public function UpdateTamplate($data, $id)
    {
        $this->db->where('tid', $id);
        return $this->db->update('tamplet', $data);
    }
    public function getTamplateById($id)
    {
        $this->db->select("t.*,p.*");
        $this->db->from("tamplet as t");
        $this->db->join("position as p", 't.p_id=p.pid', 'left');
        $this->db->where("t.tid", $id);
        $list = $this->db->get();
        return $list->row_array();

        /* $query = $this->db->where('tid', $id)->get('tamplet');
        return $query->row_array(); */
    }
    public function TamplateDelete($id)
    {
        $this->db->where('tid', $id)->delete('tamplet');
    }
    public function getPositionByCategoryName($c_type_id)
    {
        $this->db->select("*");
        $this->db->where("c_type", $c_type_id);
        $list = $this->db->get('position');
        return $list->result_array();
    }

    public function getLangList()
    {
        $this->db->select('*')->where("status",1);
        $list = $this->db->get("tamp_lang");
        return $list->result_array();
    }
}
