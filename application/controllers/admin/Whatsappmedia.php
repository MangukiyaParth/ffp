<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsappmedia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_whatsappmedia');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsappmedia->getMediaList(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/whatsappmedia/listmedia';
        $this->load->view('admin/template', $data);
    }
    
    public function insertMedia()
    {
        $data_insert = array();
        $title = $this->input->post('title');
        $data_insert['title'] = $title;
        $data_insert['created_at'] = CURRENT_DATE;
        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = './media/whatsappmedia/';
            $config['allowed_types'] = '*';
            $new_name = time() . slug_string($_FILES['image']['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $directory = './media/whatsappmedia/';
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true); 
                //echo "Directory created: $directory";
            } 

            if (!$this->upload->do_upload('image')) {
                $data['status'] = 'error';
                $data['message'] = $this->upload->display_errors();
            } else {
                $data1 = $this->upload->data();
                $data_insert['image'] = $data1['file_name'];
                $result = $this->mdl_whatsappmedia->addMedia($data_insert);
                if ($result) {
                    $data['status'] = 'success';
                    $data['message'] = 'Medi Successfully Added...!!';
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed To Add...!!';
                }
            }
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Please Select Images!!';
        }
        echo json_encode($data);
    }
    

    public function deletemediasingle()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_whatsappmedia->getMediaDataByID($id);
        if ($chek['image']) {
            $filestring = PUBPATH . "media/whatsappmedia/" . $chek['image'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_whatsappmedia->mediaDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';
        echo json_encode($data);
    }


}
