<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyUnit extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->library('user_agent');
        $this->load->model('admin/mdl_advertise');
    }

    public function index()
    {
        $data['data'] = array(
            'app_list' => $this->mdl_advertise->getApplicationList(),
            'list' => $this->mdl_advertise->AdvertiseList()
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/advertise/advertiselist';
        $this->load->view('admin/template', $data);
    }
    public function add()
    {
        /*  $status = empty($this->input->post('status')) ? 0 : 1; */
        $data = array(
            'ads_title' => $this->input->post('title'),
            'ads_id' => $this->input->post('advertise'),
            'app_id' => $this->input->post('application'),
            'ads_type' => $this->input->post('ads_type'),
            'created_date' => CURRENT_DATE,
            'updated_date' => CURRENT_DATE
        );
        $msg = [];
        if (empty($this->input->post('id'))) {
            $ret = $this->mdl_advertise->addAdvertise($data);
            if ($ret) {
                $msg['status'] = 'success';
                $msg['message'] = 'Advertise Sucessfully Added.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Advertise does not Add.';
            }
        } else {
           /*  $n = editchk(array('a_id' => $this->input->post('id')), $this->input->post('title'), array('ads_id' => $this->input->post('advertise')), 'ads_api');
            if ($n == 1) {
                $msg['status'] = 'error';
                $msg['message'] = $this->input->post('title') . ' already Exist...!!';
            } else { */
                $ret = $this->mdl_advertise->editAdvertiseById($data, $this->input->post('id'));
                $msg = [];
                if ($ret == 1) {
                    $msg['status'] = 'success';
                    $msg['message'] = 'Advertise Sucessfully Updated.';
                } else {
                    $msg['status'] = 'error';
                    $msg['message'] = 'Advertise does not Edit.';
                }
           /*  } */
        }

        echo json_encode($msg);

        exit();
    }
    public function edit($id)
    {
        $data['data'] = array(
            'app_list' => $this->mdl_advertise->getApplicationList(),
            'list' => $this->mdl_advertise->AdvertiseList()
        );

        $data['data']['edit'] = $this->mdl_advertise->getAdvertiseById($id);


        $data['middle'] = 'admin/advertise/advertiselist';
        $this->load->view('admin/template', $data);
    }
    public function statuschk()
    {
        $this->mdl_advertise->updatestatus($this->input->post('id'), array('status' => $this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "Advertise Status Changed Success..!";
        echo json_encode($data);
    }
    public function deleteAdvertise()
    {
        $ret = $this->mdl_advertise->deleteAdvertiseById($this->input->post('id'));
        $msg = [];
        if ($ret == 1) {
            $msg['status'] = 'success';
            $msg['message'] = 'Advertise Sucessfully Deleted.';
        } else {
            $msg['status'] = 'error';
            $msg['message'] = 'Advertise does not Delete.';
        }


        echo json_encode($msg);

        exit();
    }
}
