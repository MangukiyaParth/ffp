<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL.'login');
            exit;
        }
        
        $this->load->model('admin/mdl_skill');
    }

    public function index()
    {
        $data['data']=array('list'=>$this->mdl_skill->SkillList());
        $data['data']['edit']='';
        $data['middle']='admin/skill/list';        
        $this->load->view('admin/template',$data);
    }
        public function add()
        {
            $status = empty($this->input->post('status'))?0:1;
            $data = array(
                'skill_name' =>$this->input->post('skill'),
                'status' => $status
            );

            if(empty($this->input->post('id'))) {
                $check_exist =count($this->mdl_skill->skillchk($this->input->post('skill'))); 
                    if($check_exist) {
                        $msg['status']='error';
                        $msg['message']=$this->input->post('skill').' already Exist...!!';
                    }
                    else
                    {
                        $ret = $this->mdl_skill->addSkill($data);
                        $msg = [];
                        if($ret){
                            $msg['status'] = 'success';
                            $msg['message'] = 'Skill Sucessfully Added.'; 

                        } else{
                            $msg['status'] = 'error';
                            $msg['message'] = 'Skill does not Add.';
                        }
                    }
            }  
            else {

                $ret = $this->mdl_skill->editSkillById($data, $this->input->post('id'));
                $msg = [];
                if($ret==1){
                    $msg['status'] = 'success';
                    $msg['message'] = 'Skill Sucessfully Updated.'; 

                } else{
                    $msg['status'] = 'error';
                    $msg['message'] = 'Skill does not Edit.';
                } 
            }

            echo json_encode($msg);

            exit();
        }
        public function edit($id)
        {
            $data['data'] = array('list'=>$this->mdl_skill->SkillList());

            $data['data']['edit'] = $this->mdl_skill->getSKillById($id);
            

            $data['middle']='admin/skill/list';        
            $this->load->view('admin/template',$data);
        }
        public function statuschk() {  
            $this->mdl_skill->updateskill($this->input->post('id'),array('status'=>$this->input->post('status')));
            $data['status'] = 'success';
            $data['message'] = "Skill Status Changed Success..!";
            echo json_encode($data);
        }
        public function deleteSkill()
        {       
           /* $check_exits = $this->mdl_skill->checkskillbyid($this->input->post('id'));
            if($check_exits==0){*/
                $ret = $this->mdl_skill->deleteSkillById($this->input->post('id'));
                $msg = [];
                if($ret==1){
                    $msg['status'] = 'success';
                    $msg['message'] = 'Skill Sucessfully Deleted.'; 

                } else{
                    $msg['status'] = 'error';
                    $msg['message'] = 'Skill does not Delete.';
                } 
           
        /*else {
            $msg['status'] = 'error';
            $msg['message'] = "Developer belong this Skill.";
        }*/
            echo json_encode($msg);

            exit();
        }

}