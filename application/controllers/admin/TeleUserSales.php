<?php
class TeleUserSales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /* print_r($this->session->userdata());exit; */
        if ($this->session->userdata('is_admin_login') != true && $this->session->userdata('role_code') != ROLE_TELESALES_CODE){
            redirect(ADMIN_URL . 'login');
            exit;
        }
        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
        }
        $this->load->model('admin/mdl_teleusersales');
        $this->load->helper('array_group_by');
    }
    
/*     public function index()
    {
        $data['data'] = array();
        $data['middle'] = 'admin/teleusersales/telesaleuserlist';
        $this->load->view('admin/template', $data);
    } */
    function index()
    {
        $data = array();
        $startDate = "";
        $endDate = "";
        if($this->input->post()){
            $startDate = $this->input->post("start_date");
            $endDate = $this->input->post("end_date");
        }
        $queryData = $this->mdl_teleusersales->getDayWiseReportDataResult($startDate,$endDate);
        $groupedData = array_group_by($queryData, 'lead_status_title');
        /* print_r($groupedData);exit; */
        $data['data'] = array(
            "list"=>$groupedData,
        );
        $data['middle'] = 'admin/teleusersales/telesaleuserlist';
        $this->load->view('admin/template', $data);
    } 

    function promocode()
    {
        $data = array();
        $start_date = "";
        $end_date = "";
        $promo_filter_type = "";
        if($this->input->post()){
            $start_date = $this->input->post("start_date");
            $end_date = $this->input->post("end_date");
            $promo_filter_type = $this->input->post("promo_filter_type");
        }
        $data['data'] = array(
            "promoCodeData"=>$this->mdl_teleusersales->getPromoCodeData($start_date,$end_date,$promo_filter_type),
            "start_date"=>$start_date,
            "end_date"=>$end_date,
            "type"=>$promo_filter_type,
        );
        $data['middle'] = 'admin/teleusersales/promocode';
        $this->load->view('admin/template', $data);
    } 
    
    public function viewProfile()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $lead_assign_id = $this->input->post('lead_assign_id');

        $this->db->select('count(lead_assign_id) as totalOpen');
        $this->db->from("lead_assign_data");
        $this->db->where("final_status",0);
        $this->db->where("lead_status_id",2);
        $this->db->where("user_id",$this->session->userdata('admin_user_id'));
        $query = $this->db->get();
        $totalOpenRecord = $query->row_array();
        /* if($totalOpenRecord['totalOpen'] <= 3){ */
            $status = 2; /* open */        
            $data_update = array(
                "lead_status_id"=>$status,
                "open_status_time"=>CURRENT_DATE,
            );
            $this->db->where('lead_assign_id', $lead_assign_id)->update('lead_assign_data', $data_update);
    
            $data['status'] = 'success';
            $data['message'] = 'Successfully Open !!';
        /* }else{  
            $data['status'] = 'error';
            $data['message'] = 'Maximum allowed less than 3 client open at that time! so please do this first.';
        } */
        echo json_encode($data);
    }
    public function leadOpenViewPage($id,$lead_assign_id)
    {
        /* user ne data assign kryo che ke ny te check kre che only */
        $assignOrNot = $this->mdl_teleusersales->checkIDAssignBuThisUser($id,$lead_assign_id);
        $dataResumt = $this->mdl_teleusersales->getCustomerProfileData($id,$lead_assign_id);
        if($assignOrNot==true && $id !="" && $lead_assign_id !="" && !empty($dataResumt['dataResumt'])){
            /* $data['data'] = array(
                'dataResumt' => $dataResumt,
            ); */
            $data['data'] = $dataResumt;
            /* print_r($data['data']);exit; */
            $data['middle'] = 'admin/teleusersales/teleuserprofile';
            $this->load->view('admin/template', $data);
        }else{
            redirect(ADMIN_URL . 'teleUserSales'); 
        }
        
    }
    public function addReview(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();

        $filename = "";
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = './media/review/';
            $config['allowed_types'] = '*';
            $new_name = time() . slug_string($_FILES['image']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $message = $this->upload->display_errors();
            } else {
                $filename = $this->upload->data();
                $filename = $filename['file_name'];
                $message = "Successfully Upload...";
            }
        } 

        $insert_data = array(
            "lead_assign_id" => $this->input->post("lead_assign_id"),
            "review_date" => date('Y-m-d\Th:i:s', strtotime($this->input->post("reviewtime"))),
            "review_status" => 0,
            "review_amount" => 10,
            "review_photo" => $filename,
            "note" => $this->input->post("note"),
            "created_at" => CURRENT_DATE,
        );
        $this->mdl_teleusersales->addReviewData($insert_data);
        
        $data['status'] = 'success';
        $data['message'] = 'Successfully send request !!';

        echo json_encode($data);
        
    }

    public function addSubscriptionForSales(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $filename = "";
        if (isset($_FILES['images']['name'])) {
            $config['upload_path'] = './media/subss/';
            $config['allowed_types'] = '*';
            $new_name = time() . slug_string($_FILES['images']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('images')) {
                $message = $this->upload->display_errors();
            } else {
                $filename = $this->upload->data();
                $filename = $filename['file_name'];
                $message = "Successfully Upload...";
            }
        } 

        $insert_data = array(
            "lead_assign_id" => $this->input->post("lead_assign_id"),
            "pack_id" => $this->input->post("pack_id"),
            "sales_amount" => $this->input->post("ampunt"),
            "pack_buy_date" => date('Y-m-d\Th:i:s', strtotime($this->input->post("buydatetime"))),
            "sub_ss" => $filename,
            "note" => $this->input->post("note"),
            "created_at" => CURRENT_DATE,
        );
        $this->mdl_teleusersales->addSubscriptionForSalesData($insert_data);
        
        $data['status'] = 'success';
        $data['message'] = 'Successfully send request !!';

        echo json_encode($data);
        
    }

    public function addChatHistoryMessage(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $next_schedule_time = null;
        $client_percentage = 0;
        $custom_status_list = $this->input->post("custom_status_list");
        /* lead_customer_feedback_status  table*/
        switch($custom_status_list){
            case 1:/* Call Receive */
                $status = 10; /* Call Receive */
                break;  
            case 2:/* Call Not Receive  */
                $status = 11; /* Call Not Receive  */
                break;          
            case 3:/* Call Cut */
                $status = 12; /* Call Cut */
                break;  
            case 4:/* Next Schedule */
                $next_schedule_time = date('Y-m-d\Th:i:s', strtotime($this->input->post("next_schedule")));
                $status = 9;/* Next Schedule */
                break;            
            case 5: /* Out of Reach */
                $status = 13; /* Out of Reach */
                break;
            case 6: /* Switch Off */
                $status = 14; /* Switch Off */
                break;        
            case 7:/* Interested % */
                $client_percentage = $this->input->post("client_percentage");
                $status = 3; /* Interested */
                break;     
            case 8: /* Other */
                $status = 15; /* Other */
                break;        
            case 9:  /* Permanent Closed */ 
                $status = 6; /* Close */
                break;     
            case 10:/* Link Share */
                $status = 7; /* Link Share */
                break;          
            case 11:/* Waiting For Review */
                $status = 8; /* Waiting For Review */
                break;          
            case 12:/* Other Language */
                $status = 16; /* Other Language */
                break;          
            default:
                $status = 1;
        }

        $data_update = array(
            "lead_status_id"=>$status,
        );
        $this->db->where('lead_assign_id', $this->input->post("lead_assign_id"))->update('lead_assign_data', $data_update);

        $insert_data = array(
            "lead_assign_id" => $this->input->post("lead_assign_id"),
            "call_type" => $this->input->post("call_type"),
            "customer_status_id" => $this->input->post("custom_status_list"),
            "start_time" => date('h:i:s', strtotime($this->input->post("start_time"))),
            "end_time" => date('h:i:s', strtotime($this->input->post("end_time"))),
            "messages" => $this->input->post("note"),
            "next_schedule_date" => $next_schedule_time,
            "client_percentage" => $client_percentage,
            "created_time" => CURRENT_DATE,
        );
        $this->mdl_teleusersales->addChatHistoryData($insert_data);
        
        $data['status'] = 'success';
        $data['message'] = 'Successfully call log added..';
        echo json_encode($data);
        
    }
    
}
