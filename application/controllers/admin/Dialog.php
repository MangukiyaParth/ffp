<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dialog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }

        $this->load->model('admin/mdl_dialog');
    }

    public function index()
    {
        $data['data']['edit'] = $this->mdl_dialog->getDialogById();
        $data['middle'] = 'admin/dialog/dialog';
        $this->load->view('admin/template', $data);
    }
    public function save()
    {
        $forcefully_update = empty($this->input->post('forcefully_update')) ? 0 : 1;
        $app_on_off = empty($this->input->post('app_on_off')) ? 1 : 0;
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'button_name' => $this->input->post('button_name'),
            'link' => $this->input->post('link'),
            'forcefully_update' => $forcefully_update,
            'version' => $this->input->post('version'),
            'app_on_off' => $app_on_off,
        );


        $this->mdl_dialog->updateDialogValue($data);
        $this->session->set_flashdata('msg-success', 'Sucessfully update.');
        redirect(base_url("admin/dialog/"));
    }
}
