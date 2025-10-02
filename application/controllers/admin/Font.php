<?php
class Font extends CI_Controller
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
        $this->load->model('admin/mdl_fonts');
    }

    public function index()
    {
        $data['data'] = array('list' => $this->mdl_fonts->getFontList());
        $data['middle'] = 'admin/font/listfont';
        $this->load->view('admin/template', $data);
    }

    public function insertFont()
    {
        $data_insert = array();
        if (isset($_FILES['image']['name'])) {
            $this->load->helper('imgupload_helper');
            $config['upload_path'] = './assets/fonts/';
            $config['allowed_types'] = '*';
            $new_name = $_FILES['image']['name'];
            $config['file_name'] = $new_name;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $data['status'] = 'error';
                $data['message'] = $this->upload->display_errors();;
            } else {
                $data1 = $this->upload->data();
                $data_insert['font_name'] = $data1['file_name'];
                $result = $this->mdl_fonts->addFonts($data_insert);
                if ($result) {
                    $data['status'] = 'success';
                    $data['message'] = 'Font Successfully Added...!!';
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed To Add...!!';
                }
            }
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Please select font!!';
        }

        echo json_encode($data);
    }
}
