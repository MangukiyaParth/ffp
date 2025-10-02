<?php
class Mdl_webhook_failed extends CI_Model
{
    function __construct()
    {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('web_fail_id', 'transaction_id', 'w_email', 'w_amount', 'w_mobile');
        $this->column_search = array('web_fail_id', 'transaction_id', 'w_email', 'w_amount', 'w_mobile');
        /* $this->order = array('tid' => 'asc'); */
    }

    private function _get_datatables_query($postData){
        
        $this->db->select('*');
        $this->db->from('webhook_failed');
        /* $this->db->join('admin as a',"w.w_mobile=a.mobile","LEFT"); */
        /* $this->db->join('payment_link as p',"w.w_mobile=p.mobile","LEFT"); */
        /* $this->db->where("a.role",1); */
        /* $this->db->group_by("w.w_mobile"); */

        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {
            $this->db->where('w_date >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
            $this->db->where('w_date <=', $this->input->post('end_date'));
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
        $query = $this->db->get();
       /*  echo $this->db->last_query();exit; */
        $result = $query->result();
        return $result;
    }

    public function countAll(){
        $this->db->select('*');
        $this->db->from('webhook_failed');
        return $this->db->count_all_results();
    }

    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
}
