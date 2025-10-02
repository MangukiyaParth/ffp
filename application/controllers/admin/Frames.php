<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frames extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_frames');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_frames->getFrameslist(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/frames/listframes';
        $this->load->view('admin/template', $data);
    }
    
    public function insertFrames()
    {
        $data_insert = array();
        $data_insert['frame_name'] = $this->input->post('frame_name');
        $data_insert['data'] = $this->input->post('data');
        $data_insert['logosection'] = $this->input->post('logosection');
        $data_insert['free_paid'] = empty($this->input->post('free_paid')) ? 0 : 1;
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;

        if($this->input->post('id')!=""){
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/frames/';
                $config['allowed_types'] = '*';
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                } else {
                     /* frame remove */
                    $chek = $this->mdl_frames->getFramesDataByID($this->input->post('id'));
                    if ($chek['image']) {
                        $filestring = PUBPATH . "media/frames/" . $chek['image'];
                        if (file_exists($filestring)) {
                            unlink($filestring);
                        }
                    }
                    $data1 = $this->upload->data();
                    $data_insert['image'] = $data1['file_name'];
                }
            } 
            $result = $this->mdl_frames->updateFrames($data_insert,$this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Frames Successfully update...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To update...!!';
            }
        }else{
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/frames/';
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
                    $result = $this->mdl_frames->addFrames($data_insert);
                    if ($result) {
                        $data['status'] = 'success';
                        $data['message'] = 'Frames Successfully Added...!!';
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
    public function framesEdit($id)
    {
        $data['data'] = array(
            'list' => $this->mdl_frames->getFrameslist(),
            'edit' => $this->mdl_frames->getFramesDataByID($id),
        );
        $data['middle'] = 'admin/frames/listframes';
        $this->load->view('admin/template', $data);
    }


    public function deleteFrames()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $checkSubFrame = $this->mdl_frames->checkSubFrame($id);
        if($checkSubFrame <= 0){
            $chek = $this->mdl_frames->getFramesDataByID($id);
            if ($chek['image']) {
                $filestring = PUBPATH . "media/frames/" . $chek['image'];
                if (file_exists($filestring)) {
                    unlink($filestring);
                }
            }
            $this->mdl_frames->FramesDelete($id);
            $data['status'] = 'success';
            $data['message'] = 'Successfully Deleted !!';
            
        }else{
            $data['status'] = 'faild';
            $data['message'] = 'Please first Delete Sub Frames !!';
        }
        

        echo json_encode($data);
    }

    public function subframeindex()
    {
        $data['data'] = array(
            'list' => $this->mdl_frames->getSubFrameslist(),
            'dropDownlist' => $this->mdl_frames->getFrameslist(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/frames/subframelist';
        $this->load->view('admin/template', $data);
    }

    public function subDeleteFrames()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_frames->getSubFramesDataByID($id);
        if ($chek['image']) {
            $filestring = PUBPATH . "media/frames/subframes/" . $chek['image'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_frames->SubFramesDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

    public function subInsertFrames()
    {
        $data_insert = array();
        $data_insert['fid'] = $this->input->post('fid');
        $data_insert['status'] = empty($this->input->post('status')) ? 0 : 1;
        $files = $_FILES;
        $config['upload_path'] = './media/frames/subframes/';
        $config['allowed_types'] = '*';

        $cpt = 0;
        if (!empty($_FILES['image']['name'][0])) {
            $cpt = count((array)$_FILES['image']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['image']['name'] = $files['image']['name'][$i];
                $_FILES['image']['type'] = $files['image']['type'][$i];
                $_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
                $_FILES['image']['error'] = $files['image']['error'][$i];
                $_FILES['image']['size'] = $files['image']['size'][$i];

                $new_name = $i . time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload("image");
                $data1 = $this->upload->data();
                $data_insert['image'] = $data1['file_name'];

                $ret = $this->mdl_frames->addSubFrames($data_insert);
            }
            $data['status'] = 'success';
            $data['message'] = 'Frames Successfully Added...!!';
            
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Please Select Images!!';
        }
        echo json_encode($data);
    }
    /* frame status change */
    public function statusChange()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
		$this->db->where("fid", $this->input->post('id'));
		$this->db->update("frames", array($this->input->post('filedName') => $this->input->post('status')));
        
        $data['status'] = 'success';
        $data['message'] = "Status Changed Success..!";
        echo json_encode($data);
    }

}
