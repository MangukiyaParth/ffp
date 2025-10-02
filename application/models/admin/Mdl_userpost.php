<?php
class Mdl_userpost extends CI_Model
{
    function __construct() {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('post_id','tamp_id','created_at','updated_at');
        $this->column_search = array('post_id','name','mobile','tamp_id','post','created_at','updated_at');
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
        $this->db->select("a.name,a.mobile,m.*");
        $this->db->from("makepost as m");
        $this->db->join("admin as a", 'm.user_id=a.id', 'left');
        /* $this->db->order_by("created_at", "desc"); */
        //$list = $this->db->get();

        //$this->db->from($this->table);
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
        
        $this->db->select("a.name,a.mobile,m.*");
        $this->db->from("makepost as m");
        $this->db->join("admin as a", 'm.user_id=a.id', 'left');
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
    public function getUserPostlist()
    {
        $this->db->select("a.name,a.mobile,m.*");
        $this->db->from("makepost as m");
        $this->db->join("admin as a", 'm.user_id=a.id', 'left');
        /* $this->db->order_by("created_at", "desc"); */
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getGetUserPostDataForRemove()
    {
        $this->db->select("*");
        $this->db->from("makepost");
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getUserPostById($id)
    {
        $query = $this->db->where('post_id', $id)->get('makepost');
        return $query->row_array();
    }

    public function UserPostDelete($id)
    {
        $this->db->where('post_id', $id)->delete('makepost');
    }
    public function totalUserPostDelete()
    {
        $this->db->where(1, 1)->delete('makepost');
    }
    public function addUserPost($userNewFileName, $userId, $tamplateId)
    {

        $query = $this->db->select("post")
            ->where('user_id', $userId)
            ->where('tamp_id', $tamplateId)
            ->get('makepost');

        if ($query->num_rows() > 0) {
            $res_post = $query->row_array();

            $filestring = PUBPATH . "media/upload/" . $res_post['post'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
            $isertData = array(
                "post" => $userNewFileName,
                "updated_at" => CURRENT_DATE,
            );
            $this->db->where('user_id', $userId)->where('tamp_id', $tamplateId)->update('makepost', $isertData);
        } else {
            /* echo "insert";
            exit; */
            $isertData = array(
                "user_id" => $userId,
                "tamp_id" => $tamplateId,
                "post" => $userNewFileName,
                "created_at" => ONLY_DATE,
                "updated_at" => CURRENT_DATE,
            );
            $this->db->insert('makepost', $isertData);
        }
        //return $this->db->insert_id();
    }
}
