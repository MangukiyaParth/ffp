<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_user');
        $this->load->model('admin/mdl_users');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_user->getAllUser()
        );
        $data['middle'] = 'admin/user/user_list';
        $this->load->view('admin/template', $data);
    }

    /**
     *  Email Check
     */
    public function emailCheck()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $email = $this->input->post('email');
        echo $this->mdl_user->checkEmailExist($email);
    }


    public function edit($id)
    {

        $this->form_validation->set_rules('userType', 'User role', 'required', array(
            'required' => 'Select user role.'
        ));

        $this->form_validation->set_rules('name', 'User name', 'trim|required', array(
            'required' => 'Enter user name.'
        ));
        $this->form_validation->set_rules('contact_no', 'Contact number', 'trim|required|numeric|max_length[10]', array(
            'required' => 'Enter contact number.',
            'numeric' => 'Enter only digits allowed.',
            'max_length' => 'Maximum 10 digit allowed.',
        ));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
            'required' => 'Enter email address.',
            'valid_email' => 'Enter valid email.',
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['data'] = array(
                'userType' => $this->mdl_user->getAllRole(),
                'edit' => $this->mdl_user->getUserById($id)
            );
            $data['middle'] = 'admin/user/edit';
            $this->load->view('admin/template', $data);
        } else {

            $insert = array(
                'role_id' => $this->input->post('userType'),
                'name' => $this->input->post('name'),
                'contact_no' => $this->input->post('contact_no'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'updated_at' => CURRENT_DATE,
                'update_by' => $this->current_user
            );

            $this->mdl_user->editUser($id, $insert);

            $this->session->set_flashdata('msg-success', 'User successfully edited!!');
            redirect(ADMIN_URL . 'user');
        }
    }

    public function adminchangepass()
    {
        $aid = $this->session->userdata('admin_user_id');
        $data['data'] = array(
            'profile' => $this->mdl_user->getProfile($aid)
        );
        $data['middle'] = 'admin/changepassword';
        $this->load->view('admin/template', $data);
    }


    public function changepass()
    {

        $aid = $this->session->userdata('admin_user_id');

        $oldPassword = $this->input->post('currentpass');
        $newPassword = $this->input->post('newpass');

        $encryptOldPassword = md5($oldPassword . SALT);

        $checkPassword = $this->mdl_user->checkOldPassword($aid, $encryptOldPassword);
        if ($checkPassword == 1) {
            $update = [
                'password' => md5($newPassword . SALT),
                'updated_date' => date('Y-m-d h:i:s')
            ];

            $this->mdl_user->updatePassword($aid, $update);
            $data['status'] = 'success';
            $data['message'] = 'Password Successfully Updated !!';
        } else {
            $data['status'] = 'failed';
            $data['message'] = 'Password Not Match !!';
        }

        echo json_encode($data);
    }
    public function profile()
    {
        $aid = $this->session->userdata('admin_user_id');
        $data['data'] = array('profile' => $this->mdl_user->getProfile($aid));
        $data['middle'] = 'admin/profile';
        $this->load->view('admin/template', $data);
    }

    public function adminprofile()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required', array(
            'required' => 'Name is required!....'
        ));
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|exact_length[10]', array(
            'exact_length' => 'exact 10 number.'
        ));

        $aid = $this->session->userdata('admin_user_id');
        if ($this->form_validation->run() == FALSE) {

            $data['data'] = array('profile' => $this->mdl_user->getProfile($aid));
            $data['middle'] = 'admin/profile';
            $this->load->view('admin/template', $data);
        } else {
            $update = array(
                'name' => $this->input->post('name'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'note' => $this->input->post('note'),
                'updated_date' => date('Y-m-d h:i:s')
            );

            $this->mdl_user->updateProfile($aid, $update);
            $data['status'] = 'success';
            $data['message'] = 'Profile Successfully Updated !!';

            echo json_encode($data);
        }
    }

    public function profileupload()
    {
        if (array_key_exists('is_admin_login', $this->session->userdata())) {
            $id = $this->session->userdata('admin_user_id');
        } else {
            $id = $this->session->userdata('client_user_id');
        }
        $this->load->helper('imgupload_helper');
        if (isset($_FILES['image']['name'])) {
            $this->load->helper('imgupload_helper');
            $data['photo'] = imageUpload($_FILES['image']['name'], 'image', 'users', 'media/users');
        }
        $result = $this->mdl_users->updateuser($id, $data);
        $data['status'] = 'success';
        $data['message'] = 'Profile Picture Updated Successfully';

        echo json_encode($data);
    }
}
