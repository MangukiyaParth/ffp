<?php
class Role extends CI_Controller
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
        $this->load->model('admin/mdl_role');
    }

    public function index()
    {
        $data['data'] = array('list' =>array());
        $data['middle'] = 'admin/adminUser/roleList';
        $this->load->view('admin/template', $data);
    }


    public function getRoleList()
    {
        $data = array();
        
        $queryData = $this->mdl_role->getList($_POST);
        $i = $_POST['start'];
       
        foreach ($queryData as $value) {
            $i++;

            $colorClass = $value->is_active ? 'text-success' : 'text-danger';
            $data[] = array(
                'DT_RowId' => $value->r_id,
                'id' => $i,
                'name' => $value->title,
                'code' => $value->code,
                'status' => "<i class='fa fa-circle $colorClass'></i>",
                'action' => "<a class='mb-xs mt-xs roleEditBtn' dataIsActive='$value->is_active' dataId='$value->r_id' dataName='$value->title' dataCode='$value->code' ><button type='button' class='btn btn-sm btn-success' data-toggle='tooltip' data-original-title='Edit'>
                <i class='fa fa-edit'></i></button></a>"
            );
            
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_role->totalCount(),
            "recordsFiltered" => $this->mdl_role->countFiltered($_POST),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function roleUpsert(){

        $data_insert = array();
        $id = $this->input->post('id');
        $data_insert['title'] = $this->input->post('name');
        $data_insert['is_active'] = $this->input->post('status');

        if($id){
            $this->mdl_role->update($data_insert, $id);
            $data['status'] = 'success';
            $data['message'] = 'Role Successfully updated...!!';

        }else{
            $data_insert['code'] = str_replace(strtoupper(' ', '_', trim($this->input->post('code'))));

            $checkCode = $this->mdl_role->codeExistsCheck($data_insert['code']);
            if($checkCode){
                $data['status'] = 'error';
                $data['message'] = 'Code already exist...!!';
            } else {
                $this->mdl_role->add($data_insert);
                $data['status'] = 'success';
                $data['message'] = 'Role Successfully added...!!';
            }
        }

        echo json_encode($data);
    }
    
}
