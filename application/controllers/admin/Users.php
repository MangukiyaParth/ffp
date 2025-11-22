<?php
class Users extends CI_Controller
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
        $this->load->model('admin/mdl_users');
        $this->load->model('admin/mdl_transaction');
        $this->load->model('admin/mdl_role');
        $this->load->model('admin/mdl_admin_role');
    }

    public function index()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/user/userlist';
        $this->load->view('admin/template', $data);
    }

    function getUserListServer()
    {
        $data = $row = array();
        $memData = $this->mdl_users->getRows($_POST);
        $i = $_POST['start'];
        foreach ($memData as $member) {
            $i++;
            $expdate = ($member->expdate != "0000-00-00" && $member->expdate != "") ? date('d/m/Y', strtotime($member->expdate)) : '-';
            $updated_date = ($member->updated_date != "0000-00-00 00:00:00") ? date('d/m/Y', strtotime($member->updated_date)) : '';
            $created_date = ($member->created_date != "0000-00-00 00:00:00") ? date('d/m/Y h:i A', strtotime($member->created_date)) : '';
            /* $status = ($member->status == 1)?'Active':'Inactive'; */
            $path = base_url('media/logo/');
            $editUrl = ADMIN_URL . 'users/editusers/' . $member->id;
            $viewUrl = ADMIN_URL . 'users/viewusers/' . $member->id;

            $onClickDelete = "deleterecord($member->id,'/users/deleteuser')";

            $statusChangedd = "statusChangedd('id/'.$member->id'/admin/0')";
            $statusChangedd1 = "statusChangedd('id/'.$member->id'/admin/1')";
            $ispaidTitle = userPaidStatus($member->ispaid,$member->planStatus);
            $ispaid = ($member->ispaid == 0) ? '<i class="fa fa-times-circle iconfsize icolred" data-toggle="tooltip" title="Free"></i>' : '<i class="fa fa-check-circle iconfsize icolgreen" data-toggle="tooltip" title="Paid"></i>';

            $status = ($member->status == 1) ?
                '<a value="1" class="statusche' . $member->id . '" name="status" ><i class="pointer fa fa-toggle-on faicon" data-toggle="tooltip" title="Active"></i></a>' : '<a value="0" class="statusche' . $member->id . '" name="status" onclick="' . $statusChangedd1 . '"><i class="pointer fa fa-toggle-off faicona" data-toggle="tooltip" title="Deactive"></i></a>';
            /* onclick="'.$statusChangedd.'" */
            /* <a class="mb-xs mt-xs " href="javascript:void(0)" onclick="'.$onClickDelete.'"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a> */
            if ($this->session->userdata('role_code') == ROLE_ADMIN_CODE) {
                $deleteButton = '<a class="mb-xs mt-xs " href="javascript:void(0)" onclick="' . $onClickDelete . '"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>';
            }else{
                $deleteButton ='';
            }
            $button = '<div class="btn-group">
            <a class="mb-xs mt-xs  modal-sizes modal-with-zoom-anim user_profile" id="' . $member->id . '" ><button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" title="View Profile"><i class="fa fa-user"></i></button></a>
            <a class="mb-xs mt-xs  modal-sizes modal-with-zoom-anim changepass_view" id="' . $member->id . '" ><button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="Change Password"><i class="fa fa-key"></i></button></a>
            <a class="mb-xs mt-xs " href="' . $editUrl . '"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>
            '.$deleteButton.'
            <a class="mb-xs mt-xs " href="' . $viewUrl . '"><button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></button></a></div>';
            $data[] = array(
                'DT_RowId' => $member->id,
                $member->id,
                $member->totalUserPost,
                $created_date,
                ($member->app_version != "") ? 'V-' . $member->app_version : "",
                ($member->photo != "") ? '<a class="image-popup-no-margins abc" target="_blank" href="' . $path . $member->photo . '"><img class="img-responsive" src="' . $path . $member->photo . '"width="100px"></a>' : 'No Logo',
                $member->business_name,
                /* $member->email, */
                '<a target="_blank" href="https://web.whatsapp.com/send/?phone=%2B91' . $member->mobile . '&text=&app_absent=0">' . $member->mobile . '</a>',
                /* '<a target="_blank" href="https://api.whatsapp.com/send/?phone=%2B91'.$member->mobile.'&text=Hello Sir, We are from Free Festive Post App Team&app_absent=0">'.$member->mobile.'</a>', */
                $ispaid.' '.$ispaidTitle,
                $status,
                $expdate,
                $member->otp,
                $button,
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_users->countAll(),
            "recordsFiltered" => $this->mdl_users->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function usertransaction()
    {
        if ($_POST) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            if ($start_date != "" && $end_date != "") {
                $data['data'] = array(
                    'list' => $this->mdl_transaction->getTransactionUserListDataByFilter($start_date, $end_date),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
            } else {
                $data['data'] = array(
                    'list' => $this->mdl_transaction->getTransactionUserListData(),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
            }
        } else {
            $data['data'] = array(
                'list' => $this->mdl_transaction->getTransactionUserListData(),
                'start_date' => '',
                'end_date' => '',
            );
        }

        $data['middle'] = 'admin/user/usertransation';
        $this->load->view('admin/template', $data);
    }
    function getUserTransaction()
    {
        $data = $row = array();
        $memData = $this->mdl_transaction->getRows($_POST);
        $i = $_POST['start'];
        foreach ($memData as $member) {
            $i++;
            $created_at = ($member->created_at != "0000-00-00 00:00:00") ? date('d/m/Y H:i', strtotime($member->created_at)) : '';
            $pdate = ($member->pdate != "0000-00-00") ? date('d/m/Y', strtotime($member->pdate)) : '';

            $ispaid = ($member->ispaid == 0) ? '<i class="fa fa-times-circle iconfsize icolred" data-toggle="tooltip" title="Free"></i>' : '<i class="fa fa-check-circle iconfsize icolgreen" data-toggle="tooltip" title="Paid"></i>';
            $data[] = array(
                'DT_RowId' => $member->id,
                $member->id,
                $member->business_name,
                $member->mobile,
                $pdate,
                $member->pamount,
                $member->plan_name,
                $member->ptransactionid,
                $member->status,
                $ispaid,
                $created_at,

            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_transaction->countAll(),
            "recordsFiltered" => $this->mdl_transaction->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function addusers()
    {
        $data['data'] = array('role' => $this->mdl_users->getrolelist());
        $data['middle'] = 'admin/user/adduser';
        $this->load->view('admin/template', $data);
    }

    public function insertuser()
    {
        if (array_key_exists('active', $this->input->post())) {
            $status = 1;
        } else {
            $status =  0;
        }
        /* if (array_key_exists('paidunpaid', $this->input->post())) {
            $paidunpaid = 1;
        } else {
            $paidunpaid =  0;
        } */
        /* ucwords(strtolower($this->input->post('name'))), */
        $data = array(
            'name' => $this->input->post('name'),
            'business_name' => $this->input->post('business_name'),
            'mobile' => $this->input->post('mobile1'),
            'b_mobile2' => $this->input->post('mobile2'),
            'email' => strtolower($this->input->post('email')),
            'b_email' => strtolower($this->input->post('b_email')),
            'b_website' => strtolower($this->input->post('b_website')),
            'password' => md5($this->input->post('password') . SALT),
            'gender' => $this->input->post('gender'),
            'role' => 1,
            'address' => $this->input->post('address'),
            'status' => $status,
            'ispaid' => '0',
            'created_date' => CURRENT_DATE,
            'updated_date' => CURRENT_DATE,
        );

        $check_email_exist = $this->mdl_users->usersdchk($this->input->post('email'));
        $check_mobile_exist = $this->mdl_users->usersdchkMobile($this->input->post('mobile1'));
        if ($check_mobile_exist) {
            $data['status'] = 'error';
            $data['message'] = $this->input->post('mobile1') . ' already Exist...!!';
        } else {
            if (isset($_FILES['image']['name'])) {
                $this->load->helper('imgupload_helper');
                $image = imageUpload($_FILES['image']['name'], 'image', 'addusers', 'media/logo');
                $data['photo'] = $image;
            }
            $result = $this->mdl_users->addusers($data);
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'User Successfully Added...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To Add...!!';
            }
        }
        echo json_encode($data);
    }

    public function editusers()
    {
        $id = $this->uri->segment(4);
        $data['data'] = array(
            'edit' => $this->mdl_users->getusersbyid($id),
            'role' => $this->mdl_users->getrolelist()
        );
        $data['middle'] = 'admin/user/edituser';
        $this->load->view('admin/template', $data);
    }
    public function viewusers()
    {
        $id = $this->uri->segment(4);
        $editId = $this->uri->segment(5);
        if ($id != "") {
            /* $data['data'] = array(
                'edit' => $this->mdl_users->getusersbyid($id),
                'viewCustomFrame' => $this->mdl_users->getViewCustomFrame($id),
            ); */
            if ($editId) {
                $data['data']['edit'] = $this->mdl_users->getCustomFrameUserById($editId);
            } else {
                $data['data']['edit'] = "";
            }
            $data['data']['viewCustomFrame'] = $this->mdl_users->getViewCustomFrame($id);
            $data['middle'] = 'admin/user/userwisecustomframe';
            $this->load->view('admin/template', $data);
        } else {
            redirect(ADMIN_URL . 'users');
        }
    }
    /* public function editusercustomfram()
    {
        $id = $this->uri->segment(4);
        $data['data'] = array(
            'edit' => $this->mdl_users->getusersbyid($id),
            'role' => $this->mdl_users->getrolelist()
        );
        $data['middle'] = 'admin/user/edituser';
        $this->load->view('admin/template', $data);
    } */
    public function deleteUserCustomFrame()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_users->getCustomFramByID($id);
        if ($chek['image']) {
            $filestring = PUBPATH . "media/frames/custom/" . $chek['image'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_users->userCustomFrameDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }
    public function insertUserCustomFerame()
    {
        $data_insert = array();
        $data_insert['user_id'] = $this->input->post('user_id');
        $data_insert['frame_name'] = $this->input->post('frame_name');
        $data_insert['free_paid'] = 1;
        $data_insert['data'] = "";
        $data_insert['logosection'] = "";
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;
        
        
        if ($this->input->post('id') != "") {
            $data_insert['updated_at'] = CURRENT_DATE;
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/frames/custom/';
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
            $result = $this->mdl_users->updateCustomFrame($data_insert, $this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Frame Successfully update...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To update...!!';
            }
        } else {
            $data_insert['created_at'] = CURRENT_DATE;
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/frames/custom/';
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
                    $result = $this->mdl_users->addUserCustomFrame($data_insert);
                    if ($result) {
                        $data['status'] = 'success';
                        $data['message'] = 'Frame Successfully Added...!!';
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
        echo json_encode($data);
    }
    public function updateuser()
    {

        if (array_key_exists('active', $this->input->post())) {
            $status = 1;
        } else {
            $status =  0;
        }
        /*  if (array_key_exists('paidunpaid', $this->input->post())) {
            $paidunpaid = 1;
        } else {
            $paidunpaid =  0;
        } */
        $data = array(
            'name' => $this->input->post('name'),
            'business_name' => $this->input->post('business_name'),
            'mobile' => $this->input->post('mobile1'),
            'b_mobile2' => $this->input->post('mobile2'),
            'b_email' => strtolower($this->input->post('b_email')),
            'b_website' => strtolower($this->input->post('b_website')),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'status' => $status,
            /* 'ispaid' => $paidunpaid, */
            'updated_date' => CURRENT_DATE,
        );

        /*$n = $this->edituserchk($this->input->post('id'),$this->input->post('email'));*/
        $n = editchk(array('id' => $this->input->post('id')), $this->input->post('email'), array('email' => $this->input->post('email')), 'admin');

        $mob = editchk(array('id' => $this->input->post('id')), $this->input->post('mobile1'), array('mobile' => $this->input->post('mobile1')), 'admin');

        if ($n == 1) {
            $data['status'] = 'error';
            $data['message'] = $this->input->post('email') . ' already Exist...!!';
        } else if ($mob == 1) {
            $data['status'] = 'error';
            $data['message'] = $this->input->post('mobile1') . ' already Exist...!!';
        } else {
            if (isset($_FILES['image']['name'])) {
                $this->load->helper('imgupload_helper');
                $dat = $this->mdl_users->getusersbyid($this->input->post('id'));
                if ($dat['photo'] != "") {
                    $filestring = PUBPATH . "media/logo/" . $dat['photo'];
                    if (file_exists($filestring)) {
                        unlink($filestring);
                    }
                }
                $image = imageUpload($_FILES['image']['name'], 'image', 'addusers', 'media/logo');

                $data['photo'] = $image;
            }
            $result = $this->mdl_users->updateuser($this->input->post('id'), $data);
            $data['status'] = 'success';
            $data['message'] = 'User Successfully Updated...!!';
        }
        echo json_encode($data);
    }

    public function statuschk()
    {
        $this->mdl_users->updateuser($this->input->post('id'), array('status' => $this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "User Status Changed Success..!";
        echo json_encode($data);
    }

    public function deleteuser()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $chek = $this->mdl_users->getusersbyid($id);
        if ($chek['photo']) {
            $filestring = PUBPATH . "media/logo/" . $chek['photo'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_users->usersdelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

    public function deletuserimg()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $chek = $this->mdl_users->getusersbyid($id);
        $filestring = PUBPATH . "media/users/" . $chek['photo'];
        if (file_exists($filestring)) {
            unlink($filestring);
        }
        $data['photo'] = '';
        $this->mdl_users->updateuser($id, $data);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';


        echo json_encode($data);
    }

    public function changepass()
    {

        /*  $this->form_validation->set_rules('currentpass', 'Current password', 'trim|required', array(
            'required' => 'Enter current password.'
        ));

        $this->form_validation->set_rules('newpass', 'New password', 'trim|required|min_length[6]|max_length[25]', array(
            'required' => 'Enter new password.',
            'min_length' => 'Minimum 6 character required.',
            'max_length' => 'Maximum 8 character allowed.'
        ));

        $this->form_validation->set_rules('conpass', 'Confirm password', 'trim|matches[newpass]', array(
            'matches' => 'Password not match .'
        )); */

        $id = $this->input->post('userid');
        $newPassword = $this->input->post('newpassword');
        $update = array(
            'password' => md5($newPassword . SALT),
            'updated_date' => date('Y-m-d h:i:s')
        );

        $this->mdl_users->updateuser($id, $update);
        $data['status'] = 'success';
        $data['message'] = 'Password Successfully Updated..!!';

        echo json_encode($data);
    }


    public function getUserProfileData()
    {
        $id = $this->input->post('id');
        $result = $this->mdl_users->getUserProfileDataResult($id);
        $data['data'] = $result;
        $data['status'] = 'success';
        $data['message'] = "User data get Success..!";
        echo json_encode($data);
    }
    public function feedback()
    {
        $data['data'] = array(
            'list' => $this->mdl_users->getUserFeedBack(),
        );
        $data['middle'] = 'admin/user/userfeedback';
        $this->load->view('admin/template', $data);
    }
    public function otpList()
    {
        $data['data'] = array(
            'list' => $this->mdl_users->getOtpList(),
        );
        $data['middle'] = 'admin/user/otplist';
        $this->load->view('admin/template', $data);
    }

    public function feedbackDelete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
 
        $data = array();
        $id = $this->input->post('id');
        $this->mdl_users->deleteUserFeedBack($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
      
    }

    public function deleteDeviceID()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $this->mdl_users->usersDeviceIDdelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }


    public function adminList()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/adminUser/userList';
        $this->load->view('admin/template', $data);
    }

    public function addAdminUser($id = null)
    {

        $edit = '';
        if ($id) {
            $edit = $this->mdl_users->getusersbyidWithRole($id);
        }

        $data['data'] = array(
            'edit' => $edit,
            'roleList' => $this->mdl_role->getActiveList()
        );
        $data['middle'] = 'admin/adminUser/addUser';
        $this->load->view('admin/template', $data);
    }

    public function getAdminUserList()
    {
        $data = array();
        $memData = $this->mdl_users->getAdminList($_POST);
        $i = $_POST['start'];

        foreach ($memData as $member) {
            $i++;

            $statusChangedd1 = "statusChangedd('id/'.$member->id'/admin/1')";

            $status = ($member->status == 1) ?
                '<a value="1" class="statusche' . $member->id . '" name="status" ><i class="pointer fa fa-toggle-on faicon" data-toggle="tooltip" title="Active"></i></a>' : 
                '<a value="0" class="statusche' . $member->id . '" name="status" onclick="' . $statusChangedd1 . '"><i class="pointer fa fa-toggle-off faicona" data-toggle="tooltip" title="Deactive"></i></a>';
            

            $deleteBtn = '';
            if ($member->r_code != ROLE_ADMIN_CODE) {
                $onClickDelete = "deleterecord($member->id,'/users/deleteuser')";
                //$deleteBtn = '<a class="mb-xs mt-xs " href="javascript:void(0)" onclick="' . $onClickDelete . '"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>';
            }
            $editUrl = ADMIN_URL . "users/addAdminUser/$member->id";
            $data[] = array(
                'DT_RowId' => $member->id,
                'id' => $i,
                'userid' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'mobile' => $member->mobile,
                'role' => $member->r_title,
                'regsiter_date' => date('d-m-Y', strtotime($member->created_date)),
                'status_btn' => "$status",
                'otp' => $member->otp,
                'note' => $member->note,
                'action' => "<a class='mb-xs mt-xs' href='$editUrl'><button type='button' class='btn btn-sm btn-success' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></button></a>
            <a class='mb-xs mt-xs  modal-sizes modal-with-zoom-anim changepass_view' type='admin' id='$member->id' ><button type='button' class='btn btn-sm btn-success' data-toggle='tooltip' title='Change Password'><i class='fa fa-key'></i></button></a>
            $deleteBtn",
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_users->adminTotalCount(),
            "recordsFiltered" => $this->mdl_users->countFilteredAdmin($_POST),
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function upsertAdminUser()
    {
        $data = array();
        if (array_key_exists('status', $this->input->post())) {
            $status = 1;
        } else {
            $status =  0;
        }
        $id = $this->input->post('id');
        $dataInsert = array(
            'name' => $this->input->post('name'),
            'mobile' => $this->input->post('mobile'),
            'email' => strtolower($this->input->post('email')),
            'status' => $status,
            'note' => $this->input->post('note'),
            'updated_date' => CURRENT_DATE,
        );


        if ($id) {
            $this->mdl_users->updateuser($id, $dataInsert);
            $data['status'] = 'success';
            $data['message'] = 'User Successfully Updated...!!';
        } else {

            $check_email_exist = $this->mdl_users->usersdchk(strtolower($this->input->post('email')));
            if ($check_email_exist) {
                $data['status'] = 'error';
                $data['message'] = $this->input->post('mobile1') . ' already Exist...!!';
            }

            $dataInsert['password'] = md5($this->input->post('password') . SALT);
            $dataInsert['created_date'] = CURRENT_DATE;
            $id = $this->mdl_users->addusers($dataInsert);
            if ($id) {
                $data['status'] = 'success';
                $data['message'] = 'User Successfully Added...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To Add...!!';
            }
        }


        $roleId = $this->input->post('roleId');
        if ($id) {

            $roleExistsCheck =  $this->mdl_admin_role->roleExistsCheck($id);
            if ($roleExistsCheck) {
                $this->mdl_admin_role->update(array(
                    'role_id' => $roleId
                ), $roleExistsCheck['id']);
            } else {
                $this->mdl_admin_role->add(array(
                    'role_id' => $roleId,
                    'user_id' => $id
                ));
            }
        }

        echo json_encode($data);
    }
}
