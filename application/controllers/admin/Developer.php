<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developer extends CI_Controller
{
    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL.'login');
            exit;
        }
        
        $this->load->model('admin/mdl_developer');
    }

    public function index()
    {
        $data['data']=array('list'=>$this->mdl_developer->DeveloperList(),'skill_list'=>$this->mdl_developer->SkillList());
        $data['data']['edit']='';
        $data['middle']='admin/developer/list';        
        $this->load->view('admin/template',$data);
    }
        public function add()
        {
            
            $skill_array = $this->input->post('skill');

            /*$mul_val_string = serialize($skill_array);
            $un_mul_val_string = unserialize($mul_val_string);*/
           
            $status = empty($this->input->post('status'))?0:1;
            $data = array(
                'name' =>$this->input->post('name'),
                'email' =>$this->input->post('email'),
                'mobile' =>$this->input->post('mobile'),
                'address' =>$this->input->post('address'),
                's_id' =>json_encode($skill_array),
                'skype_id' =>$this->input->post('skype_id'),
                'reference_name' =>$this->input->post('reference_name'),
                'time' =>$this->input->post('time'),                
                'created_date' => CURRENT_DATE,
                'updated_date' => CURRENT_DATE,
                'status' => $status
            );
           // $skill= json_decode($skill_array);
           
            if(empty($this->input->post('id'))) {
                $check_exist =count($this->mdl_developer->developerchk($this->input->post('email'))); 
                    if($check_exist) {
                        $msg['status']='error';
                        $msg['message']=$this->input->post('email').' already Exist...!!';
                    }else{
                        $ret = $this->mdl_developer->addDeveloper($data);
                        $msg = [];
                        if($ret){
                            $msg['status'] = 'success';
                            $msg['message'] = 'Developer Sucessfully Added.'; 

                        } else{
                            $msg['status'] = 'error';
                            $msg['message'] = 'Developer does not Add.';
                        }
                    }
            }else {

                $ret = $this->mdl_developer->editDeveloperById($data, $this->input->post('id'));
                $msg = [];
                if($ret==1){
                    $msg['status'] = 'success';
                    $msg['message'] = 'Developer Sucessfully Updated.'; 

                } else{
                    $msg['status'] = 'error';
                    $msg['message'] = 'Developer does not Edit.';
                } 
            }

            echo json_encode($msg);

            exit();
        }
        public function edit($id)
        {
            $data['data'] = array('list'=>$this->mdl_developer->DeveloperList(),
                                'skill_list'=>$this->mdl_developer->SkillList());

            $data['data']['edit'] = $this->mdl_developer->getDeveloperById($id);
            

            $data['middle']='admin/developer/list';        
            $this->load->view('admin/template',$data);
        }
        public function statuschk() {  
            $this->mdl_developer->updatedeveloper($this->input->post('id'),array('status'=>$this->input->post('status')));
            $data['status'] = 'success';
            $data['message'] = "Developer Status Changed Success..!";
            echo json_encode($data);
        }
        public function deleteDeveloper()
        {       
                $ret = $this->mdl_developer->deleteDeveloperById($this->input->post('id'));
                $msg = [];
                if($ret==1){
                    $msg['status'] = 'success';
                    $msg['message'] = 'Developer Sucessfully Deleted.'; 

                } else{
                    $msg['status'] = 'error';
                    $msg['message'] = 'Developer does not Delete.';
                } 
           
            echo json_encode($msg);

            exit();
        }

}