<?php
class Mdl_users extends CI_Model
{
    function __construct()
    {
        /* $this->table = 'tamplet'; */
        $this->column_order = array('id', 'name', 'email', 'mobile', 'gender', 'created_date', 'updated_date');
        $this->column_search = array('id', 'app_version', 'name', 'email', 'mobile', 'created_date', 'updated_date', 'app_version');
        /* $this->order = array('tid' => 'asc'); */
    }
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData)
    {

        $type = 0;
        if($this->input->post('type') && $this->input->post('type')!="1" && $this->input->post('type')!=""){
            $type = $this->input->post('type');
        }
       
        $this->db->select('a.*,n.app_version');
        $this->db->from('admin as a');
        $this->db->join('notification as n','a.id=n.user_id','LEFT');
        

        if($this->input->post('version') && $this->input->post('version')!="")
        {
            $this->db->where('n.app_version', $this->input->post('version'));
        }
        /* 

        * 1 New User
        * 2 Total Package Paid User
        * 6 Total Package Expried User
        * 3 Trial Plan Active User
        * 5 Trial Plan Expried User
        * 4 Without Logo
        * 8 Total Free User

        */
        
        if($type==2){
            $this->db->join('payments as p','p.u_id = a.id','LEFT');
             /* $this->db->where('a.planStatus', '2'); */
        }
        if($type==3){
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', '1');
        }
        if($type==4){
            $this->db->where('a.photo', "");
        }
        if($type==5){
           /*  $this->db->where('a.expdate <', ONLY_DATE); */
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.planStatus', 1);
        }
        if($type==6){
           /*  $this->db->where('a.expdate <', ONLY_DATE); */
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', 2);
        }
        if($type==8){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.planStatus', null);
        }

 
        if($type==2){
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                $this->db->where('p.pdate >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                $this->db->where('p.pdate <=', $this->input->post('end_date'));
            }
        }elseif($type==6){
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                $this->db->where('a.expdate >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                $this->db->where('a.expdate <=', $this->input->post('end_date'));
            }
        }else{
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                $this->db->where('a.created_date >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                $endDate = date('Y-m-d', strtotime("+1 day", strtotime($this->input->post('end_date'))));
                $this->db->where('a.created_date <=', $endDate);
            }
        }

        $this->db->where('role >', '0');
        $this->db->group_by('a.id');
        /* $this->db->from($this->table); */

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
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        
      
        $query = $this->db->get();
        
        $result = $query->result();
        foreach ($result as $key => $value) {
            $result[$key]->totalUserPost = $this->countUserPostTotal($value->id);
        }
        return $result;
    }

    /*
     * Count all records
     */
    public function countAll()
    {
        $this->db->select('a.*,n.app_version');
        $this->db->from('admin as a');
        $this->db->join('notification as n', 'a.id=n.user_id', 'LEFT');
        $this->db->where('role >', '0');
        $this->db->group_by('a.id');

        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function addusers($type)
    {
        $this->db->insert('admin', $type);
        return $this->db->insert_id();
    }
    public function addUserCustomFrame($type)
    {
        $this->db->insert('customframe', $type);
        return $this->db->insert_id();
    }
    public function updateCustomFrame($data, $id)
    {
        $this->db->where('cframeid', $id);
        $this->db->update('customframe', $data);
        return true;
    }

    public function getuserslist()
    {
        $this->db->from('admin');
        /* $this->db->join('role', 'role.r_id = admin.role', 'left'); */
        $this->db->where('role >', '0');
        $list = $this->db->get();
        $result = $list->result_array();
        foreach ($result as $key => $value) {
            $result[$key]['totalUserPost'] = $this->countUserPostTotal($value['id']);
        }
        /*  print_r($result);
        exit; */
        return $result;
    }

    public function countUserPost($user_id)
    {
        $this->db->select('count(post_id ) as totalUserPost');
        $this->db->where('user_id', $user_id);
        $list = $this->db->get("makepost");

        return $list->row()->totalUserPost;
    }
    public function countUserPostTotal($user_id)
    {
        $this->db->select('tamp_count');
        $this->db->where('user_id', $user_id);
        $list = $this->db->get("daily_post_count");
        if($list->num_rows() > 0){
            return $list->row()->tamp_count;
        }else{
            return 0;
        }
    }

    public function getrolelist()
    {
        $list = $this->db->get('role');
        return $list->result_array();
    }

    public function usersdchk($email)
    {
        $email = $this->db->where('email', $email)
            ->get('admin');
        return $email->num_rows();
    }
    public function usersdchkMobile($mobile)
    {
        $mobile = $this->db->where('mobile', $mobile)
            ->get('admin');
        return $mobile->num_rows();
    }

    public function getusersbyid($id)
    {
        $query = $this->db->select('*')->join('role', 'admin.role = role.r_id', 'left')->where('id', $id)->get('admin');
        return $query->row_array();
    }

    public function getusersbyidWithRole($id)
    {
        $query = $this->db->select('a.*, r.role_id')
        ->join('admin_role as r', 'a.id = r.user_id', 'left')
        ->where('a.id', $id)->get('admin as a');
        return $query->row_array();
    }
    public function getViewCustomFrame($id)
    {
        $query = $this->db->select('*')->where('user_id', $id)->get('customframe');
        return $query->result_array();
    }
    public function getCustomFrameUserById($id)
    {
        $query = $this->db->select('*')->where('cframeid', $id)->get('customframe');
        return $query->row_array();
    }
    public function getCustomFramByID($id)
    {
        $this->db->select("*")->from("customframe");
        $this->db->where("cframeid", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function userCustomFrameDelete($id)
    {
        $this->db->where('cframeid', $id)->delete('customframe');
    }
    public function updateuser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        return "updated";
    }

    public function usersdelete($id)
    {
        $this->db->where('id', $id)->delete('admin');
    }

    public function getUserProfileDataResult($id)
    {
        $query = $this->db->select('a.*,count(m.post_id) as totalPost')
            ->from('admin as a')
            ->join('makepost as m', 'a.id = m.user_id', 'left')
            ->where('a.id', $id)
            ->get();
        $result = $query->row_array();
        $result['photo'] = ($result['photo'] != "") ? base_url('media/logo/') . $result['photo'] : base_url('media/Admin.png');
        $result['created_date'] = ($result['created_date'] != "0000-00-00 00:00:00") ? date('d/m/Y H:i', strtotime($result['created_date'])) : '-';
        $result['updated_date'] = ($result['updated_date'] != "0000-00-00 00:00:00") ? date('d/m/Y H:i', strtotime($result['updated_date'])) : '-';
        $result['last_login'] = ($result['last_login'] != "0000-00-00 00:00:00") ? date('d/m/Y H:i', strtotime($result['last_login'])) : '-';
        $result['expdate'] = ($result['expdate'] != "0000-00-00" && $result['expdate'] != "") ? date('d/m/Y', strtotime($result['expdate'])) : '-';
        $query1 = $this->db->select('p.*,s.month,s.plan_name')
            ->from('payments as p')
            ->join('subscriptionPlan as s', 'p.packageid = s.plan_id', 'left')
            ->where('p.u_id', $id)
            ->get();
        $payment = $query1->result_array();
        foreach ($payment as $key => $value) {
            $payment[$key]['created_at'] = ($value['created_at'] != "0000-00-00 00:00:00") ? date('d/m/Y H:i', strtotime($value['created_at'])) : '-';
            $payment[$key]['pdate'] = ($value['pdate'] != "0000-00-00") ? date('d/m/Y', strtotime($value['pdate'])) : '-';
            //$payment[$key]['pexpdate'] = ($value['pexpdate'] != "0000-00-00") ? date('d/m/Y', strtotime($value['pexpdate'])) : '-';
        }
        $result['payments'] = $payment;

        $query2 = $this->db->select('*')
            ->where('user_id', $id)
            ->get('notification');
        $deviceInfo = $query2->result_array();
        $result['deviceInfo'] = $deviceInfo;

        /* package get */
        $query3 = $this->db->select('plan_id,plan_name,price')
        ->where('status',1)
        ->get('subscriptionPlan');
        $packageList = $query3->result_array();
        $result['packageList'] = $packageList;

        $query3 = $this->db->select('count(cframeid) as totalCustomFrame')
            ->where('user_id', $id)
            ->get('customframe');
        $totalCustomFrame = $query3->row_array();

        /* get lead assign user name*/
        $query4 = $this->db->select('l.*,s.lead_status_title')
        ->from('lead_assign_data as l')
        ->join("lead_status as s","l.lead_status_id = s.lead_status_id","LEFT")
        ->where('l.cus_id',$id)->limit(1)
        ->get();
        $assignDataRow = $query4->row_array();
        if($query4->num_rows() > 0){
            $result['assignDataRow'] = $assignDataRow;
            $result['assignDataRow']["user_id"] = getUserFullData($assignDataRow["user_id"])['name'];
            /* $result['assignDataRow']["cus_id"] = getUserFullData($assignDataRow["cus_id"])['name']; */
        }else{
            $result['assignDataRow'] = array(
                "lead_assign_id"=>"",
                "lead_status_title"=>"",
                "user_id"=>"",
                "cus_id"=>"",
                "lead_status_id"=>"",
                "open_status_time"=>"",
                "final_status"=>"",
                "assign_by"=>"",
                "created_at"=>"",
                "updated_at"=>"",
            );
        }
        
        $result['totalCustomFrame'] = $totalCustomFrame['totalCustomFrame'];

        return $result;
    }
    public function getOtpList()
    {
        $query = $this->db->select('*')->get('sms_log');
        return $query->result();
    }
    public function getUserFeedBack()
    {
        $query = $this->db->select('admin.business_name,admin.mobile,feedback.*')
            ->join('admin', 'admin.id = feedback.user_id', 'left')
            ->order_by('feedback.created_at', 'desc')
            ->get('feedback');
        return $query->result();
    }

    public function deleteUserFeedBack($id)
    {
        $this->db->where('feedid', $id)->delete('feedback');
    }

    public function usersDeviceIDdelete($id)
    {
        $this->db->where('n_id', $id)->delete('notification');
    }

    private function _get_admin_datatables_query($postData)
    {

        $this->db->select('a.*, n.role_id, r.title as r_title, r.code as r_code');
        $this->db->from('admin as a');
        $this->db->join('admin_role as n', 'a.id=n.user_id', 'LEFT');
        $this->db->join('role as r', 'n.role_id=r.r_id', 'LEFT');

        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {

            $this->db->where('a.created_date >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
            $this->db->where('a.created_date <=', $this->input->post('end_date'));
        }

        $this->db->where('role', '0');
      
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

    public function getAdminList($postData)
    {
        $this->_get_admin_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function countFilteredAdmin($postData)
    {
        $this->_get_admin_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function adminTotalCount()
    {
        $this->db->where('role', '0');
        $query = $this->db->get('admin');
        return $query->num_rows();
    }

    public function getDailyUserRegCount($postData)
    {
        $this->db->select("DATE_FORMAT(created_date, '%d-%m-%Y') as formatDate, count(id) as totalCount");
    
        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {
                $this->db->where('created_date >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
                $this->db->where('created_date <=', $this->input->post('end_date'));
        }

        $this->db->where('role >', '0');
        $this->db->group_by('formatDate');
        $this->db->order_by('formatDate', 'DESC');
        $query = $this->db->get('admin');

        // echo $this->db->last_query();
        // exit();

        $result = $query->result();
        return $result;
    }
}
