<?php
class Telesales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
        }
        $this->load->model('admin/mdl_telesales');
        //$this->load->library('excel');
    }
    
    public function index()
    {
        $telesalesUser = $this->mdl_telesales->getTelesaleUser();
        if($this->input->post()){
            $result = $this->mdl_telesales->getFilterUserDate($this->input->post());
            switch($this->input->post('type')){
                case 6:
                    $type = "new";
                break;
                case 1:
                    $type = "free";
                break;
                case 2:
                    $type = "e#paid";
                break;
                case 3:
                    $type = "a#tril";
                break;
                case 4:
                    $type = "e#trial";
                break;
                case 5:
                    $type = "user#postcount";
                break;
                /*case 6:
                    $type = "e#paid";
                break;
                case 8:
                    $type = "free";
                break; */
                default:
                    $type = "All";
            }
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $data['data'] = array(
                'list' => $result,
                'versioncode' => $this->input->post('version'),
                'type' => $type,
                'start' => ($start!="")?date("d-m-Y",strtotime($start)):"All",
                'end' => ($end!="")?date("d-m-Y",strtotime($end)):"All",
                'telesalesUser' => $telesalesUser,
                'msg' => "",
            );
            $data['middle'] = 'admin/telesales/telesaleslist';
            $this->load->view('admin/template', $data);
        }else{
            $data['data'] = array(
                'list' =>array(),
                'versioncode' =>"",
                'type' =>"",
                'start' =>"",
                'end' =>"",
                'telesalesUser' => $telesalesUser,
                'msg' => "",
            );
            $data['middle'] = 'admin/telesales/telesaleslist';
            $this->load->view('admin/template', $data);
        }
    }
    public function assignData()
    {
       /*  print_r($this->input->post()); */
        $telesalesUser = $this->mdl_telesales->getTelesaleUser();
        if($this->input->post()){

            $user_id = $this->input->post("telesales_user");
            $cust_id = $this->input->post("cust_id");
            $count = 0;
            $dublicate = 0;
            foreach($cust_id as $key =>$c_id)
            {
                $q =  $this->db->select('lead_assign_id')
                ->from('lead_assign_data')
                ->where("cus_id",$c_id)->get();
                if($q->num_rows() == 0){
                    $data_insert = array(
                        'user_id' => $user_id,
                        'cus_id' => $c_id,
                        'assign_by' => $this->session->userdata('admin_user_id'),
                        'created_at' => CURRENT_DATE,
                        'updated_at' => CURRENT_DATE,
                    );
                    $this->mdl_telesales->addDataAssign($data_insert);
                    $count++;
                }else{
                    $dublicate++;
                }
            }
            $msg = 'Total '.$count.' user assign sucessfully...! Duplicate record '.$dublicate;

            $start_dt = $this->input->post("l_start");
            $start_dt = ($start_dt!="" && $start_dt!="All")?date("Y-m-d",strtotime($start_dt)):null;
            $end_dt = $this->input->post("l_end");
            $end_dt = ($end_dt!="" && $end_dt!="All")?date("Y-m-d",strtotime($end_dt)):null;
            /* lead logs start */
            $data_log_insert = array(
                'user_id' => $this->session->userdata('admin_user_id'),
                'version' => $this->input->post("l_versioncode"),
                'type' => $this->input->post("l_type"),
                'start_date' => $start_dt,
                'end_date' => $end_dt,
                'telesales_id' => $user_id,
                'total_assign' => $count,
                'created_at' => CURRENT_DATE,
            );
            $this->mdl_telesales->addDataLogInsert($data_log_insert);
            /* lead logs enf */


            $data['data'] = array(
                'list' =>array(),
                'versioncode' =>"",
                'type' =>"",
                'start' =>"",
                'end' =>"",
                'telesalesUser' => $telesalesUser,
                'msg' => $msg,
            );
            $data['middle'] = 'admin/telesales/telesaleslist';
            $this->load->view('admin/template', $data);
        }else{
            $data['data'] = array(
                'list' =>array(),
                'versioncode' =>"",
                'type' =>"",
                'start' =>"",
                'end' =>"",
                'telesalesUser' => $telesalesUser,
                'msg' => "",
            );
            $data['middle'] = 'admin/telesales/telesaleslist';
            $this->load->view('admin/template', $data);
        }

    }
    public function saleslist(){
        $data['data'] = array(
            'list' => $this->mdl_telesales->getTelesaleUser(),
        );
        $data['middle'] = 'admin/telesales/telesaleUserList';
        $this->load->view('admin/template', $data);
    }
    public function telesalesprofile(){
        $id = $this->uri->segment(4);
        $userData =  $this->mdl_telesales->getTelesaleUser($id);
        $data['data'] = array(
            'list' => $userData,
        );
        $data['middle'] = 'admin/telesales/telesaleUserList';
        $this->load->view('admin/template', $data);
    }
    public function dashboard(){
        $pendingReview =  $this->mdl_telesales->getPendingReviewList();
        $pendingSubscription =  $this->mdl_telesales->getPendingSubscriptionList();
        $data['data'] = array(
            'pendingReview' => $pendingReview,
            'pendingSubscription' => $pendingSubscription,
            'allTeleSalesOverView' => $this->mdl_telesales->getAllTeleSalesOverView(),
        );
        $data['middle'] = 'admin/telesales/dashboard';
        $this->load->view('admin/template', $data);
    }
    public function changesStatusUpdate(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = explode("_",$this->input->post("id"));
        $custom_review_id = $this->input->post("custom_review_id");
        $data = array();
        if($id[1]=="rev"){
            $update_data = array(
                "review_status" => $id[0],
            );
            $this->db->where('custom_review_id', $custom_review_id);
            $this->db->update('lead_customer_review', $update_data);
        }
        if($id[1]=="sub"){
            $update_data = array(
                "sub_status" => $id[0],
            );
            $this->db->where('sales_report_id', $custom_review_id);
            $this->db->update('lead_sales_report', $update_data);
            if($id[0] == "2"){
                $update_assign_data = array(
                    "lead_status_id" => 5, /* auto buy */
                );
            }
            if($id[0] == "1"){
                $update_assign_data = array(
                    "lead_status_id" => 4, /* payment */
                );
            }
            if($id[0] == "0"){
                $update_assign_data = array(
                    "lead_status_id" => 2, /* open */
                );
            }
            
            $lead_assign_id = $this->getAssignIDBySalesReportID($custom_review_id);
            $this->db->where('lead_assign_id', $lead_assign_id);
            $this->db->update('lead_assign_data', $update_assign_data);
        }

        $data['status'] = 'success';
        $data['message'] = 'Successfully update status';

        echo json_encode($data);
    }

    public function getAssignIDBySalesReportID($sales_report_id){
        $query = $this->db->select('lead_assign_id')
            ->where('sales_report_id', $sales_report_id)
            ->get('lead_sales_report');
            $data = $query->row_array();
        return $data['lead_assign_id'];
    }

    public function leadassignlogs(){
        $data['data'] = array(
            'list' => $this->mdl_telesales->getLeadsLogs(),
        );
        $data['middle'] = 'admin/telesales/assignlogs';
        $this->load->view('admin/template', $data);
    }
}
