<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_slider');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_slider->getSliderDeactivelist(),
            'Activelist' => $this->mdl_slider->getSliderActivelist(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/slider/listslider';
        $this->load->view('admin/template', $data);
    }
    
    public function insertSlider()
    {
        $data_insert = array();
        $data_insert['cat_title'] = $this->input->post('cat_title');
        $data_insert['mid'] = $this->input->post('mid');
        $data_insert['sub'] = $this->input->post('sub');
        $data_insert['url'] = $this->input->post('url');
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;
        $data_insert['sort'] = $this->input->post('sort');
        $data_insert['festivalDate'] = $this->input->post('festivalDate');

        if($this->input->post('id')!=""){
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/slider/';
                $config['allowed_types'] = '*';
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                } else {
                    $data1 = $this->upload->data();
                    $data_insert['image'] = $data1['file_name'];
                }
            } 
            $result = $this->mdl_slider->updateSlider($data_insert,$this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Slider Successfully update...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To update...!!';
            }
        }else{
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/slider/';
                $config['allowed_types'] = '*';
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                } else {
                    $data1 = $this->upload->data();
                    $data_insert['image'] = $data1['file_name'];
                    $result = $this->mdl_slider->addSlider($data_insert);
                    if ($result) {
                        $data['status'] = 'success';
                        $data['message'] = 'Slider Successfully Added...!!';
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = 'Failed To Add...!!';
                    }
                }
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Please Select Images!!';
            }
        }
        clear_cache();
        echo json_encode($data);
    }
    public function sliderEdit($id)
    {
        $data['data'] = array(
            /* 'list' => $this->mdl_slider->getSliderlist(), */
            'list' => $this->mdl_slider->getSliderDeactivelist(),
            'Activelist' => $this->mdl_slider->getSliderActivelist(),
            'edit' => $this->mdl_slider->getSliderDataByID($id),
        );
        $data['middle'] = 'admin/slider/listslider';
        $this->load->view('admin/template', $data);
    }


    public function deleteSlider()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_slider->getSliderDataByID($id);
        if ($chek['image']) {
            $filestring = PUBPATH . "media/slider/" . $chek['image'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_slider->sliderDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';
        clear_cache();
        echo json_encode($data);
    }

    public function sliderUpdateStatus()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $data = array(
            'status' => $status
        );


        $this->mdl_slider->updateSlider($data, $id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully updated !!';
        clear_cache();
        echo json_encode($data);

    }  

}
