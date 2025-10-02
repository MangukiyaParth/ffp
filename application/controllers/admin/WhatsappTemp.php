<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapptemp extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_whatsapptemp');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsapptemp->getTemplist(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/whatsapp/listtemp';
        $this->load->view('admin/template', $data);
    }
    
    public function insertTemp()
    {
        $data_insert = array();
        $data_insert['tamp_name'] = $this->input->post('tamp_name');
        $data_insert['template'] = $this->input->post('template');
        $data_insert['type'] = $this->input->post('type');
        $data_insert['param'] = $this->input->post('param');
        $data_insert['lang'] = $this->input->post('lang');
        $data_insert['media'] = $this->input->post('media');
        $data_insert['note'] = $this->input->post('note');
        $data_insert['sort'] = $this->input->post('sort');
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;
        $data_insert['bulk_status'] = empty($this->input->post('bulk_status')) ? 0 : 1;

        if($this->input->post('id')!=""){
            $result = $this->mdl_whatsapptemp->updateTemp($data_insert,$this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Template Successfully update...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To update...!!';
            }
        }else{
            $data_insert['created_at'] = CURRENT_DATE;
            $result = $this->mdl_whatsapptemp->addTemp($data_insert);
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Template Successfully Added...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To Add...!!';
            }
        }
        echo json_encode($data);
    }

    public function tempEdit($id)
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsapptemp->getTemplist(),
            'edit' => $this->mdl_whatsapptemp->getTempDataByID($id),
        );
        $data['middle'] = 'admin/whatsapp/listtemp';
        $this->load->view('admin/template', $data);
    }

    public function deletetemp()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $this->mdl_whatsapptemp->tempDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

}
