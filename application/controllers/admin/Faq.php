<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_faq');
       
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_faq->getfaqlist(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/faq/listfaq';
        $this->load->view('admin/template', $data);
    }
    
    public function insertfaq()
    {
        $data_insert = array();
        $data_insert['quetion'] = $this->input->post('quetion');
        $data_insert['anwser'] = $this->input->post('anwser');
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;

        if($this->input->post('id')!=""){
            $result = $this->mdl_faq->updatefaq($data_insert,$this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Faq Successfully update...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To update...!!';
            }
        }else{
            $data_insert['created_at'] = CURRENT_DATE;
            $result = $this->mdl_faq->addfaq($data_insert);
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Faq Successfully Added...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To Add...!!';
            }
        }
        echo json_encode($data);
    }

    public function faqEdit($id)
    {
        $data['data'] = array(
            'list' => $this->mdl_faq->getfaqlist(),
            'edit' => $this->mdl_faq->getfaqDataByID($id),
        );
        $data['middle'] = 'admin/faq/listfaq';
        $this->load->view('admin/template', $data);
    }


    public function deletefaq()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $this->mdl_faq->faqDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

}
