<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL.'login');
            exit;
        }
       
        /*$this->load->model('admin/mdl_user');*/
    }

    public function index()
    {
        $data['data']=array();
        $data['middle']='admin/profile';
        $this->load->view('admin/template',$data);
    }

    public function setting()
    {
        $data['data']=array();
        $data['middle']='admin/setting/setting';
        $this->load->view('admin/template',$data);
    }

    public function changepass()
    {
        $data['data']=array();
        $data['middle']='admin/setting/changepassword';
        $this->load->view('admin/template',$data);
    }
    

}