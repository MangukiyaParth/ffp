<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'auth/login');
            exit;
        }
        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
        }
        $this->load->model('admin/mdl_setting');
        $aid = $this->session->userdata('admin_user_id');
        $this->load->helper('imgupload_helper');
    }

    public function index()
    {
        $data['data'] = array(
            'result' => $this->mdl_setting->get_All_Setting()
        );
        $data['middle'] = 'admin/setting';
        $this->load->view('admin/template', $data);
    }

    public function save_edit()
    {
        $data1 = array();
        $data = $this->input->post();
        if (array_key_exists('active', $this->input->post())) {
            $status = 1;
        } else {
            $status =  0;
        }
        
        if (array_key_exists('forceFullyLogout', $this->input->post())) {
            $forceFullyLogout = 1;
        } else {
            $forceFullyLogout =  0;
        }
        if (array_key_exists('help-support', $this->input->post())) {
            $helpsupport = 1;
        } else {
            $helpsupport =  0;
        }
        if (array_key_exists('feedback-suggestion', $this->input->post())) {
            $feedbacksuggestion = 1;
        } else {
            $feedbacksuggestion =  0;
        }
        if (array_key_exists('premium-subscription', $this->input->post())) {
            $premiumsubscription = 1;
        } else {
            $premiumsubscription =  0;
        }
        if (array_key_exists('refer-earn', $this->input->post())) {
            $referearn = 1;
        } else {
            $referearn =  0;
        }
        if (array_key_exists('complaint_menu', $this->input->post())) {
            $complaint_menu = 1;
        } else {
            $complaint_menu =  0;
        }
        $data['active'] = $status;
        $data['forceFullyLogout'] = $forceFullyLogout;
        $data['help-support'] = $helpsupport;
        $data['feedback-suggestion'] = $feedbacksuggestion;
        $data['premium-subscription'] = $premiumsubscription;
        $data['refer-earn'] = $referearn;
        $data['complaint_menu'] = $complaint_menu;
        $dat = $this->mdl_setting->get_All_Setting();
        if (isset($_FILES['site_logo']['name'])) {

            $filestring = PUBPATH . "media/users/" . $dat['site_logo'];
            $image = imageUpload($_FILES['site_logo']['name'], 'site_logo', 'setting', 'media/users/');

            $data['site_logo'] = $image;
            if (file_exists($filestring)) {
                unlink($filestring);
                /* if ($dat['site_logo']) {
                } */
            }
        }
        if (isset($_FILES['sharingBanner']['name'])) {
            $filestring1 = PUBPATH . "media/sharingBanner/" . $dat['sharingBanner'];
            $image1 = imageUpload($_FILES['sharingBanner']['name'], 'sharingBanner', 'setting', 'media/sharingBanner/');

            $data['sharingBanner'] = $image1;
            if (file_exists($filestring1)) {
                unlink($filestring1);
                /* if ($dat['sharingBanner']) {
                } */
            }
        }
        foreach ($data as $key => $value) {
            $this->mdl_setting->updateRow($key, array('value' => $value));
        }

        $data1['status'] = 'success';
        $data1['message'] = 'Setting Successfully Updated..!';

        clear_cache();
        echo json_encode($data1);
    }
    /*Setting Logo Remove*/
    public function logoremove()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id = $this->input->post('id');
        $filestring = PUBPATH . "media/users/" . $id;
        if (file_exists($filestring)) {
            unlink($filestring);
        }
        $this->mdl_setting->deleteSettingLogo($id);

        $data['status'] = 'success';
        $data['message'] = 'Successfully logo Deleted !!';
        clear_cache();
        echo json_encode($data);
    }
    public function sharingBannerRemove()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
       /*  $id = $this->input->post('id');
        $filestring = PUBPATH . "media/sharingBanner/" . $id;
        if (file_exists($filestring)) {
            unlink($filestring);
        } */
        $this->mdl_setting->deleteSharingBanner();

        $data['status'] = 'success';
        $data['message'] = 'Successfully logo Deleted !!';
        clear_cache();
        echo json_encode($data);
    }


    public function role()
    {

        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == true) {
            /*print_r($this->input->post());exit;*/
            /* print_r($this->input->post());exit;*/
            $data = array(
                'title' => $this->input->post('role')
            );
            if ($this->input->post('id') != '') {
                $data['updated_date'] = CURRENT_DATE;
                $n = editchk(array('r_id' => $this->input->post('id')), $this->input->post('role'), array('title' => $this->input->post('role')), 'role');
                /*print_r($n);*/
                /*$n = $this->editrolechk($this->input->post('id'),$this->input->post('role'));*/
                if ($n == 1) {
                    $data['status'] = 'error';
                    $data['message'] = $this->input->post('role') . ' role already Exist...!!';
                } else {
                    if ($this->input->post('permission')) {
                        $this->mdl_setting->deletepermission($this->input->post('id'));
                        $result = $this->mdl_setting->updaterole($this->input->post('id'), $data);
                        foreach ($this->input->post('permission') as $key) {
                            $type['r_id'] = $this->input->post('id');
                            $type['m_id'] = $key;
                            $type['updated_date'] = CURRENT_DATE;
                            $this->mdl_setting->insertpermission($type);
                            $data['status'] = 'success';
                            $data['message'] = 'Role Successfully Updated...!!';
                        }
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = 'Please Select Atleast One Permission...!!';
                    }
                }
            } else {
                $data['created_date'] = CURRENT_DATE;
                $check_exist = count($this->mdl_setting->checkrole($this->input->post('role')));
                if ($check_exist) {
                    $data['status'] = 'error';
                    $data['message'] = $this->input->post('role') . ' role already Exist...!!';
                } else {
                    if ($this->input->post('permission')) {
                        $result = $this->mdl_setting->insertrole($data);
                        foreach ($this->input->post('permission') as $key) {
                            $type['r_id'] = $result;
                            $type['m_id'] = $key;
                            $type['created_date'] = CURRENT_DATE;
                            $this->mdl_setting->insertpermission($type);
                        }
                        if ($result) {
                            $data['status'] = 'success';
                            $data['message'] = 'Role Successfully Added...!!';
                        } else {
                            $data['status'] = 'error';
                            $data['message'] = 'Failed To Add...!!';
                        }
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = 'Please Select Atleast One Permission...!!';
                    }
                }
            }
            echo json_encode($data);
        } else {
            $data['data'] = array(
                'role' => $this->mdl_setting->getrolelist(),
                'module' => $this->mdl_setting->getmodule()
            );
            $data['data']['edit'] = '';
            if ($this->uri->segment(4)) {
                $data['data']['edit'] = $this->mdl_setting->getrolebyid($this->uri->segment(4));
                $data['data']['permission'] = $this->mdl_setting->getpermissionid($this->uri->segment(4));
            }
            $data['middle'] = 'admin/setting/role';
            $this->load->view('admin/template', $data);
        }
    }

    public function deleterole()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        /*$role = $this->mdl_surname->checkrole($id);
            if ($role) {
                $data['status']='error';
                $data['message']='First Delete Users !!';
            } else {*/
        $this->mdl_setting->deletepermission($id);
        $this->mdl_setting->roledelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Role deleted !!';

        /* }*/
        echo json_encode($data);
    }


    public function statuschk()
    {

        $this->mdl_setting->status($this->input->post('id'), array('status' => $this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "Status Changed Success..!";

        echo json_encode($data);
    }
}
