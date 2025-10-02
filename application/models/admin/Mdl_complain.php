<?php
class Mdl_complain extends CI_Model
{   

    public $tabelName = 'complain';
    public $column_order = ['com_id', 'user_id', 'complain_id', 'message', 'reply', 'status', 'created_at'];
    public $column_search = ['com_id', 'user_id', 'complain_id', 'message', 'reply', 'status', 'created_at'];
    
    private function _get_admin_datatables_query($postData)
    {

        $this->db->select('c.*, a.name , a.mobile');
        $this->db->from($this->tabelName .' as  c');
        $this->db->join('admin as a', 'a.id=c.user_id', 'LEFT');

        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {

            $this->db->where('c.created_at >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
            $this->db->where('c.created_at <=', $this->input->post('end_date'));
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
        $this->_get_admin_datatables_query($postData);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function countFiltered($postData)
    {
        $this->_get_admin_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function update($id, $data)
    {
        $query = $this->db->where('com_id', $id)
            ->update($this->tabelName, $data);
            return true;
    }
}