<?php
class Mdl_role extends CI_Model
{
    protected $tableName = 'role';


    function __construct()
    {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('r_id', 'title', 'code', 'created_date', 'updated_date');
        $this->column_search = array('r_id', 'title', 'code', 'created_date', 'updated_date');
        /* $this->order = array('tid' => 'asc'); */
    }
 


    private function _get_datatables_query($postData)
    {

        $this->db->select('r.*');
        $this->db->from('role as r');
      

        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {
            $this->db->where('r.created_date >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
            $this->db->where('r.created_date <=', $this->input->post('end_date'));
        }
      
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($postData['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getList($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function totalCount()
    {
        $query = $this->db->get('role');
        return $query->num_rows();
    }

    public function add($data)
    {
        $this->db->insert($this->tableName, $data);
        return true;
    }

    public function update($data,$id)
    {
        $this->db->where('r_id', $id);
       return  $this->db->update($this->tableName, $data);
    }

    public function codeExistsCheck($code)
    {
        $this->db->where('code', $code);
        $query = $this->db->get($this->tableName);
        return $query->num_rows();
    }

    public function getActiveList()
    {
        $this->db->where('is_active', 1);
        $query = $this->db->get($this->tableName);
        $result = $query->result();
        return $result;
    }
}
