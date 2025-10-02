<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Application extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }

        $this->load->model('admin/mdl_application');
		
    }

    public function index()
    {
        $data['data'] = array('list' => $this->mdl_application->ApplicationList());
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/application/applicationlist';
        $this->load->view('admin/template', $data);
    }
    public function add()
    {
        /* $status = empty($this->input->post('status')) ? 0 : 1; */
        /* if (array_key_exists('status', $this->input->post())) {
            $status = 1;
        } else {
            $status =  0;
        } */
        $data = array(
            'app_name' => $this->input->post('app_name'),
            'app_package_name' => $this->input->post('app_package_name'),
            'status' => $this->input->post('status'),
            'adclick' => $this->input->post('adclick'),
            'mode' => $this->input->post('mode'),
            'created_date' => CURRENT_DATE,
            'updated_date' => CURRENT_DATE
        );

        $dailogData = array(
            'd_title' => $this->input->post('d_title'),
            'd_description' => $this->input->post('d_description'),
            'd_button1' => $this->input->post('d_button1'),
            'd_button2' => $this->input->post('d_button2'),
            'd_link' => $this->input->post('d_link'),
            'd_appversion' => $this->input->post('d_appversion'),
            'd_forcefully' => $this->input->post('d_forcefully'),
            'd_other_forcefully' => $this->input->post('d_other_forcefully'),
            'd_isDisplay' => $this->input->post('d_isDisplay'),
            'd_other_isDisplay' => $this->input->post('d_other_isDisplay'),
            'o_type' => $this->input->post('o_type'),
            'o_link' => $this->input->post('o_link'),
        );
        if (!empty($_FILES['image']['name'])) {
            $this->load->helper('imgupload_helper');
            $image = imageUpload($_FILES['image']['name'], 'image', '', 'media/dailog');
            if (!empty($image)) {
                $dailogData['image'] = $image;
                /*  $img_icone = base_url("media/notification/") . $image; */
            }
        } 
        
        $msg = [];
        if (empty($this->input->post('id'))) {
            $check_exist = count($this->mdl_application->Applicationchk($this->input->post('app_package_name')));
            if ($check_exist) {
                $msg['status'] = 'error';
                $msg['message'] = $this->input->post('app_package_name') . ' already Exist...!!';
            } else {
                $ret = $this->mdl_application->addApplication($data);
                $dailogData['app_id'] = $ret;
                $this->mdl_application->addApplicationDailog($dailogData);

                if ($ret) {
                    $msg['status'] = 'success';
                    $msg['message'] = 'Application Sucessfully Added.';
                } else {
                    $msg['status'] = 'error';
                    $msg['message'] = 'Application does not Add.';
                }
            }
        } else {
            $ret = $this->mdl_application->editApplicationById($data, $this->input->post('id'));
            $this->mdl_application->editApplicationByIdDailog($dailogData, $this->input->post('id'));
            if ($ret == 1) {
                $msg['status'] = 'success';
                $msg['message'] = 'Application Sucessfully Updated.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Application does not Edit.';
            }
        }
        clear_cache();
        echo json_encode($msg);
    }
    public function edit($id)
    {
        $data['data'] = array('list' => $this->mdl_application->ApplicationList());
        $data['data']['edit'] = $this->mdl_application->getApplicationById($id);
        $data['middle'] = 'admin/application/applicationlist';
        $this->load->view('admin/template', $data);
    }
    public function view($id)
    {
        $app_detials = $this->mdl_application->applicationDataById($id);
        $data['data'] = array(
            'list' => $this->mdl_application->advertiseListById($id),
            'details' => $app_detials,
            'dailog' => $this->mdl_application->dailogSDataGetList($id),
            'analytics' => $this->mdl_application->analyticsByPackageName($app_detials['app_package_name']),
            'liveanalytics' => $this->mdl_application->liveAnalyticsByPackageName($app_detials['app_package_name'])
        );
        $data['middle'] = 'admin/application/app_view';
        $this->load->view('admin/template', $data);
    }
    public function statuschk()
    {
        $this->mdl_application->updatestatus($this->input->post('id'), array('status' => $this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "Application Status Changed Success..!";
        echo json_encode($data);
    }
    public function deleteApplication()
    {
        $check_exits = $this->mdl_application->checkApplicationbyid($this->input->post('id'));
        if ($check_exits == 0) {
            $ret = $this->mdl_application->deleteApplicationById($this->input->post('id'));
            $msg = [];
            if ($ret == 1) {
                $msg['status'] = 'success';
                $msg['message'] = 'Application Sucessfully Deleted.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Application does not Delete.';
            }
        } else {
            $msg['status'] = 'error';
            $msg['message'] = "Application does not delete. please first remove sub data.";
        }
        echo json_encode($msg);
        exit();
    }
    public function deleteDailogImage()
    {
        $this->mdl_application->remoceDailogImage($this->input->post('id'));
        $msg = [];
        $msg['status'] = 'success';
        $msg['message'] = 'Image Sucessfully Deleted.';
        clear_cache();
        echo json_encode($msg);
        exit();
    }
}
