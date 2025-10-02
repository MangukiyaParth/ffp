<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Couponcode extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_couponcode');
       
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_couponcode->getCouponCodeList(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/couponcode/listcouponcode';
        $this->load->view('admin/template', $data);
    }
    
    public function insertCouponCode()
    {
        $data_insert = array();

        $data_insert['c_name'] = $this->input->post('c_name');
        $data_insert['c_code'] = $this->input->post('c_code');
        $data_insert['c_title'] = $this->input->post('c_title');
        $data_insert['total_qty'] = $this->input->post('total_qty');
        $data_insert['start_date'] = $this->input->post('start_date');
        $data_insert['end_date'] = $this->input->post('end_date');
        $data_insert['total_days'] = $this->input->post('total_days');
        $data_insert['note'] = $this->input->post('note');
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;

        if($this->input->post('id')!=""){
            $data_insert['updated_at'] = CURRENT_DATE;
            $result = $this->mdl_couponcode->updateCouponCode($data_insert,$this->input->post('id'));
            $data['status'] = 'success';
            $data['message'] = 'Coupon Code Successfully update...!!';
            
        }else{
            $data_insert['total_count_user_apply'] = 0;
            $data_insert['created_at'] = CURRENT_DATE;
            $result = $this->mdl_couponcode->addCouponCode($data_insert);
            $data['status'] = 'success';
            $data['message'] = 'Coupon Code Successfully Added...!!';
        }
        echo json_encode($data);
    }


    public function couponCodeEdit($id)
    {
        $data['data'] = array(
            'list' => $this->mdl_couponcode->getCouponCodeList(),
            'edit' => $this->mdl_couponcode->getCouponCodeDataByID($id),
        );
        $data['middle'] = 'admin/couponcode/listcouponcode';
        $this->load->view('admin/template', $data);
    }


    public function deleteCouponCode()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $this->mdl_couponcode->couponCodeDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

    public function couponCodeApply($coupon,$user_id){
        if($coupon !="" && $coupon !=null){ // blank nathi te check krvu
            $this->input->post('status');
            $this->db->select("coupon_id");
            $this->db->where("c_code",$coupon);
            $this->db->where("total_qty >","total_count_user_apply");
            $this->db->where("start_date <=",ONLY_DATE);
            $this->db->where("end_date >=",ONLY_DATE);
            $this->db->where("status",1);
            $list = $this->db->get("coupon_code");

            $this->input->post('status');
            $this->db->select("coupon_id");
            $this->db->where("c_code",$coupon);
            $list = $this->db->get("coupon_code");

            if ($list->num_rows() > 0) {

                /* user not premium */
                /* user one time coupon code apply kri shake */
                /* total days count krva - day wise expire date */
                $expireDate = ""; /* biji */
                /* apply coupon */
                $data = array(
                    "u_id"=>"",/* user id */
                    "pamount"=>"0.00",
                    "pdate"=>ONLY_DATE,
                    "ptransactionid"=>"",
                    "pstatus"=>"", /* Coupon Code Name - Days */
                    "packageid"=>"1",
                    "pprice"=>"0.00",
                    "pmonth"=>"0",
                    "created_at"=>CURRENT_DATE,
                    /*"ref_status"=>"",
                     "refund_id"=>"",
                    "refundDate"=>"",
                    "userRole"=>"", */
                );

                /* payments table insert record */
                $ispaidUpdate = array(
                    'ispaid' => '1',
                    'expdate' => $expireDate, /* expired date */
                    'planStatus' => "1",
                );
                /* admin table update bu user id */

                $couponApplyCountUpdate = array(
                    'total_count_user_apply' => '+1',
                );
                /* Coupen Code ketli var active thayu te update krva - coupon_code - where("c_code","couponCode") */

                echo "This coupon has been successfully activated";
            }else{
                echo "This coupon has expired....";
            }

        }else{
            echo "Coupon Code is required....";
        }
    }
    

}
