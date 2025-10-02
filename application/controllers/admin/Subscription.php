<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subscription extends CI_Controller
{

    protected $current_user;
    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_subscription');
    }

    public function index()
    {
        $data['data'] = array(
            'sub_list' => $this->mdl_subscription->getSubScriptionPlanList(),
            'planlist' => $this->mdl_subscription->getAllPlanData(),
            'totalSubRecord' => $this->mdl_subscription->countTotalSubRecord(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/subscription/subscriptionlist';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $data = array(
            'plan_id' => $this->input->post('plan_id'),
            'sign' => $this->input->post('sign'),
            'title' => $this->input->post('title'),
        );
        $msg = array();
        if (empty($this->input->post('id'))) {
            $ret = $this->mdl_subscription->addSubScriptionPlan($data);
            if ($ret) {
                $msg['status'] = 'success';
                $msg['message'] = 'Subscription Sucessfully Added.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Subscription does not Add.';
            }
        } else {
            $ret = $this->mdl_subscription->editSubScriptionById($data, $this->input->post('id'));
            if ($ret == 1) {
                $msg['status'] = 'success';
                $msg['message'] = 'Subscription Sucessfully Updated.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Subscription does not Edit.';
            }
        }
        echo json_encode($msg);
        exit();
    }
    public function updatePlan()
    {
        $data = array(
            'month' => $this->input->post('month'),
            'plan_name' => $this->input->post('plan_name'),
            'price' => $this->input->post('price'),
            'discount_price' => $this->input->post('discount_price'),
            'special_title' => $this->input->post('special_title'),
            'status' => $this->input->post('status'),
        );
        $msg = array();
        if (!empty($this->input->post('pl_id'))) {
            
            $ret = $this->mdl_subscription->updateSubPlanById($data, $this->input->post('pl_id'));
            if ($ret == 1) {
                $msg['status'] = 'success';
                $msg['message'] = 'Subscription Plan Sucessfully Updated.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Subscription Plan does not update.';
            }
        }else{
            $msg['status'] = 'error';
            $msg['message'] = 'Subscription Plan does not update.';
        }
        echo json_encode($msg);
        exit();
    }
    
    public function edit($id)
    {
        $data['data'] = array(
            'sub_list' => $this->mdl_subscription->getSubScriptionPlanList(),
            'planlist' => $this->mdl_subscription->getAllPlanData(),
            'totalSubRecord' => $this->mdl_subscription->countTotalSubRecord(),
        );
        $data['data']['edit'] = $this->mdl_subscription->getSubScriptionById($id);

        $data['middle'] = 'admin/subscription/subscriptionlist';
        $this->load->view('admin/template', $data);
    }
    public function deleteSubDescription()
    {
        $ret = $this->mdl_subscription->deleteSubDescriptionById($this->input->post('id'));
        $msg = array();
        if ($ret == 1) {
            $msg['status'] = 'success';
            $msg['message'] = 'Subscription Sucessfully Deleted.';
        } else {
            $msg['status'] = 'error';
            $msg['message'] = 'Subscription does not Delete.';
        }

        echo json_encode($msg);
        exit();
    }
    public function getPlanData()
    {
        $msg = array();
        
        $result = $this->mdl_subscription->getPlanDataById($this->input->post('id'));
        if ($result) {
            $msg['status'] = 'success';
            $msg['message'] = 'Subscription Sucessfully get.';
            $msg['data'] = $result;
        } else {
            $msg['status'] = 'error';
            $msg['message'] = 'Subscription does not get.';
            $msg['data'] = array();
        }

        echo json_encode($msg);
        exit();
    }

}
