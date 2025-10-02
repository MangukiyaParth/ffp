<?php
class Mdl_transaction extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array(null,'p.u_id','a.id','a.business_name','a.mobile','s.price','p.created_at');
        $this->column_search = array('p.u_id','a.id','a.business_name','a.mobile','s.plan_name','s.price','p.created_at');
        /* $this->column_order = array('u_id','id','business_name','mobile','plan_name','price','created_at');
        $this->column_search = array('u_id','id','business_name','mobile','plan_name','price','created_at'); */
        $this->order = array('p.created_at' => 'desc');
    }

    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $key => $value) {
            $result[$key]->totalUserPost = $this->countUserPost($value->id);
        }
        return $result;
    }
    
    public function countUserPost($user_id)
    {
        $this->db->select('count(post_id ) as totalUserPost');
        $this->db->where('user_id', $user_id);
        $list = $this->db->get("makepost");

        return $list->row()->totalUserPost;
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->select('p.*,a.business_name,a.id,a.mobile,a.status,a.ispaid,s.month,s.plan_name,s.price');
        $this->db->from('payments as p');
        $this->db->join('admin as a','p.u_id=a.id','LEFT');
        $this->db->join('subscriptionPlan as s','p.packageid=s.plan_id','LEFT');
        //$this->db->order_by('p.created_at','desc');
        /* $this->db->group_by('p.id'); */

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
        
        $this->db->select('p.*,a.business_name,a.id,a.mobile,a.ispaid,s.month,s.plan_name,s.price');
        $this->db->from('payments as p');
        $this->db->join('admin as a','p.u_id=a.id','LEFT');
        $this->db->join('subscriptionPlan as s','p.packageid=s.plan_id','LEFT');
        //$this->db->order_by('p.created_at','desc');
        /* $this->db->group_by('p.id'); */
        
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


    public function getTransactionUserListData(){
        $this->db->select('p.*,a.business_name,a.id,a.mobile,a.status,a.ispaid,s.month,s.plan_name,s.price');
        $this->db->from('payments as p');
        $this->db->join('admin as a','p.u_id=a.id','LEFT');
        $this->db->join('subscriptionPlan as s','p.packageid=s.plan_id','LEFT');
        $this->db->order_by('p.created_at','desc');
        
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
    public function getTransactionUserListDataByFilter($start_date,$end_date){
        $this->db->select('p.*,a.business_name,a.id,a.mobile,a.status,a.ispaid,s.month,s.plan_name,s.price');
        $this->db->from('payments as p');
        $this->db->join('admin as a','p.u_id=a.id','LEFT');
        $this->db->join('subscriptionPlan as s','p.packageid=s.plan_id','LEFT');
        $this->db->where('p.pdate >=',$start_date);
        $this->db->where('p.pdate <=',$end_date);
        $this->db->order_by('p.created_at','desc');
        
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
    
}
