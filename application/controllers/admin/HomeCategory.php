<?php
defined('BASEPATH') or exit('No direct script access allowed');
class HomeCategory extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }

        $this->load->model('admin/mdl_imagescopy');
        $this->load->model('admin/mdl_home_category');
        $this->load->library('session');
    }
    public function index($id = null){
        
        
        
        $data['data']=array(
            'categoryList'=>$this->mdl_imagescopy->getCategoryName(),
            'list' => $this->mdl_home_category->getList(),
            'edit' => null
        );

        if($id){
            $data['data']['edit'] = $this->mdl_home_category->getDataByID($id);
        }

        $data['middle']='admin/category/homePageList';        
        $this->load->view('admin/template',$data);
    }

    public function addCategory($id = null)
    {

        if($this->input->post('category_id')){
            if($id) {
                $updateData = $this->input->post();
                $updateData['is_new'] = $updateData['is_new'] ? $updateData['is_new'] : 0;
                $updateData['status'] = $updateData['status'] ? $updateData['status'] : 0;

                $this->mdl_home_category->update($updateData, $id);
                $this->session->set_flashdata('success', 'Sucessful updated!!!');

            } else {
                $this->mdl_home_category->addCategory($this->input->post());
                $this->session->set_flashdata('success', 'Sucessful added!!!');
            }
           
        } else {
            $this->session->set_flashdata('error', 'Erro in add');
        }

        redirect(ADMIN_URL . 'HomeCategory');
        
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $this->mdl_home_category->delete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

    public function keyUpdate()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        $key = $this->input->post('key');
        $val = $this->input->post('val');

        $data = array(
            $key => $val
        );

        $this->mdl_home_category->update($data, $id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully updated !!';

        echo json_encode($data);

    }  
}
?>
