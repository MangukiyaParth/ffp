<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL.'login');
            exit;
        }
        
        $this->load->model('admin/mdl_notification');
    }

    public function index()
    {
        $data['data']=array('application_list'=>$this->mdl_notification->getApplicationList(),'list'=>$this->mdl_notification->NotificationList());
        $data['data']['edit']='';
        $data['middle']='admin/notification/notificationlist';        
        $this->load->view('admin/template',$data);
    }
    public function add()
    {
        $status = empty($this->input->post('status'))?0:1;
        $data = array(
            'app_id' =>$this->input->post('app_id'),
            'title' => $this->input->post('title'),
            'message'=> $this->input->post('message'),
            'schedule_time'=>$this->input->post('schedule_time'),
            'status'=>$status,
            'created_date'=> CURRENT_DATE,
            'updated_date'=> CURRENT_DATE
        );
        if(empty($this->input->post('id'))) {
           
            
                    if(isset($_FILES['image']['name'])) {
                    $this->load->helper('imgupload_helper');
                   /* $data['photo']=imageUpload($_FILES['image']['name'],'image','users','media/users');*/
                    $image=imageUpload($_FILES['image']['name'],'image','addNotification','media/notification');
                            if($image==0){
                                print_r($image);
                            } else {
                                 $data['image'] = $image;
                            }
                    }
                
                    
                    $ret = $this->mdl_notification->addNotification($data);
                   
                    $msg = [];
                    if($ret){
                        $msg['status'] = 'success';
                        $msg['message'] = 'Notification Sucessfully Added.'; 

                    } else{
                        $msg['status'] = 'error';
                        $msg['message'] = 'Notification does not Add.';
                    }
                
            
                
        }  
        else {
             $n=editchk(array('n_id'=>$this->input->post('id')),$this->input->post('title'),array('message'=>$this->input->post('message')),'notification');
                if($n == 1) {
                    $msg['status']='error';
                    $msg['message']=$this->input->post('title').' already Exist...!!';
                }
                else{
                     if(isset($_FILES['image']['name'])) {
                        $this->load->helper('imgupload_helper');
                         $dat=$this->mdl_notification->getNotificationById($this->input->post('id'));
                             $filestring = PUBPATH . "media/notification/" . $dat['image'];
                                if (file_exists($filestring)) {
                                    if($dat['image'] != ""){ 
                                    unlink($filestring); }
                                }
                         $image=imageUpload($_FILES['image']['name'],'image','addNotification','media/notification');
                            if($image==0){
                                print_r($image);die();
                            } else {
                                 $data['image'] = $image;
                                  if (file_exists($filestring)) {
                                   if($dat['image']){  unlink($filestring);}
                                }
                            }
                    }
            $ret = $this->mdl_notification->editNotificationById($data, $this->input->post('id'));
            $msg = [];
            if($ret==1){
                $msg['status'] = 'success';
                $msg['message'] = 'Notification Sucessfully Updated.'; 

            } else{
                $msg['status'] = 'error';
                $msg['message'] = 'Notification does not Edit.';
            }
            } 
        }

        echo json_encode($msg);
        exit();
    }
    public function edit($id)
    {
        $data['data'] = array('application_list'=>$this->mdl_notification->getApplicationList(),
            'list'=>$this->mdl_notification->NotificationList());

        $data['data']['edit'] = $this->mdl_notification->getNotificationById($id);
        

        $data['middle']='admin/notification/notificationlist';        
        $this->load->view('admin/template',$data);
    }
     public function statuschk() {  
        $this->mdl_notification->updatestatus($this->input->post('id'),array('status'=>$this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "Notification Status Changed Success..!";
        echo json_encode($data);
    }
    public function deleteNotification()
    {       
            $check_exits = $this->mdl_notification->checkapplicationbyid($this->input->post('id'));
            if($check_exits==0){
            $ret = $this->mdl_notification->deleteNotificationById($this->input->post('id'));
            $msg = [];
            if($ret==1){
                $msg['status'] = 'success';
                $msg['message'] = 'Notification Sucessfully Deleted.'; 

            } else{
                $msg['status'] = 'error';
                $msg['message'] = 'Notification does not Delete.';
            } 
        }
        else {
            $msg['status'] = 'error';
            $msg['message'] = "Notification belong this Application. ";
        }
        echo json_encode($msg);

        exit();
    }

    

}
