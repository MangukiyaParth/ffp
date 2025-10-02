<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userpost extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_userpost');
    }

    public function index()
    {
        $data['data'] = array('list' => array());/* $this->mdl_userpost->getUserPostlist() */
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/userpost/userpostList';
        $this->load->view('admin/template', $data);
    }
    function getUserPostList(){
        $data = $row = array();
        $memData = $this->mdl_userpost->getRows($_POST);
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $created_at = ($member->created_at!="0000-00-00")?date( 'd/m/Y', strtotime($member->created_at)):'';
            $updated_at = ($member->updated_at!="0000-00-00")?date( 'd/m/Y', strtotime($member->updated_at)):'';
            /* $status = ($member->status == 1)?'Active':'Inactive'; */
            $path = base_url('media/upload/');
            $click = "deleterecord($member->post_id,'/userpost/deleteuserpost')";

            $data[] = array(
                'DT_RowId' =>$member->post_id,
                $member->post_id, 
                $member->name, 
                $member->mobile,
                '<a class="image-popup-no-margins" target="_blank" href="'.base_url('admin/tamplate/edittamplate/').$member->tamp_id.'">'.$member->tamp_id.'</a>',
                '<a class="image-popup-no-margins abc" target="_blank" href="'.$path.$member->post.'"><img class="img-responsive" src="'.$path.$member->post.'"width="100px"></a>', 
                $created_at, 
                $updated_at, 
                '<a href="javascript:void(0)" id="'.$member->post_id.'" onclick="'.$click.'"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>', 
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_userpost->countAll(),
            "recordsFiltered" => $this->mdl_userpost->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function deleteuserpost()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_userpost->getUserPostById($id);
        if ($chek['post']) {
            $filestring = PUBPATH . "media/upload/" . $chek['post'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_userpost->UserPostDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }
    public function allUserPostDelete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $getDataResult = $this->mdl_userpost->getGetUserPostDataForRemove();
        foreach ($getDataResult as $value) {
            $filestring = PUBPATH . "media/upload/" . $value['post'];;
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }

        $this->mdl_userpost->totalUserPostDelete();
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }
}
