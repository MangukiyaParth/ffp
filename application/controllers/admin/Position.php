<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_position');
        $this->load->helper('imgupload_helper');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_position->getPositionList(),
            'c_type' => $this->mdl_position->getCTypeList()
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/position/positionAdd';
        $this->load->view('admin/template', $data);
    }

    public function editPosition($id)
    {
        $edit_data = $this->mdl_position->getPositionById($id);
        if ($edit_data) {
            $data['data'] = array(
                'list' => $this->mdl_position->getPositionList(),
                'c_type' => $this->mdl_position->getCTypeList(),
                'edit' => $edit_data,
            );
            $data['middle'] = 'admin/position/positionAdd';
            $this->load->view('admin/template', $data);
        } else {
            redirect(ADMIN_URL . 'position');
        }
    }
    public function dublicatePosition($id)
    {
        $edit_data = $this->mdl_position->getPositionById($id);
        if ($edit_data) {
            $data_insert = array(
                'c_type' => $edit_data['c_type'],
                'p_name' => $edit_data['p_name'],
                'logo_pos' => $edit_data['logo_pos'],
                'mobile_pos' => $edit_data['mobile_pos'],
                'website_pos' => $edit_data['website_pos'],
                'email_pos' => $edit_data['email_pos'],
                'address_pos' => $edit_data['address_pos'],
                'name_pos' => $edit_data['name_pos'],
                'birthdayPhoto_pos' => $edit_data['birthdayPhoto_pos'],
                'birthdayName_pos' => $edit_data['birthdayName_pos'],
                'birthday_font' => $edit_data['birthday_font'],
            );
            $last_insert_id = $this->mdl_position->addPosition($data_insert);
            $this->session->set_flashdata('msg-success', 'Position dublicate Sucessfully.');

            /*  $edit_data_finL = $this->mdl_position->getPositionById($last_insert_id);
            $data['data'] = array(
                'list' => $this->mdl_position->getPositionList(),
                'edit' => $edit_data_finL,
            );
            $data['middle'] = 'admin/position/positionAdd';
            $this->load->view('admin/template', $data); */
            redirect(ADMIN_URL . 'position/editPosition/' . $last_insert_id);
        } else {
            redirect(ADMIN_URL . 'position');
        }
    }
    public function isertPosition()
    {

        if (!$_POST) {
            echo ('No direct script access allowed');
            exit;
        }
        $data_insert = array(
            'c_type' => $this->input->post('c_type'),
            'p_name' => $this->input->post('p_name'),
            'logo_pos' => $this->input->post('logo_pos'),
            'mobile_pos' => $this->input->post('mobile_pos'),
            'website_pos' => $this->input->post('website_pos'),
            'email_pos' => $this->input->post('email_pos'),
            'address_pos' => $this->input->post('address_pos'),
            'name_pos' => $this->input->post('name_pos'),
            'birthdayPhoto_pos' => $this->input->post('birthdayPhoto_pos'),
            'birthdayName_pos' => $this->input->post('birthdayName_pos'),
            'birthday_font' => $this->input->post('birthday_font'),
        );

        if (!empty($_FILES['image']['name'])) {
            $image = imageUpload($_FILES['image']['name'], 'image', '', 'media/position');
            $data_insert['p_image'] = $image;
        }
        if (empty($this->input->post('id'))) {
            $ret = $this->mdl_position->addPosition($data_insert);
            if ($ret) {
                $this->session->set_flashdata('msg-success', 'Position Sucessfully Added.');
            } else {
                $this->session->set_flashdata('msg-error', 'Position does not Add.');
            }
        } else {
            $ret = $this->mdl_position->UpdatePosition($data_insert, $this->input->post('id'));
            if ($ret == 1) {
                $this->session->set_flashdata('msg-success', 'Position Sucessfully Updated.');
            } else {
                $this->session->set_flashdata('msg-error', 'Position does not Edit.');
            }
        }

        redirect(base_url("admin/position/"));
    }
}
