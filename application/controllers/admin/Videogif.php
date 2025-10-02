<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Videogif extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_videogif');
        $this->load->model('admin/mdl_category');
    }

    public function index()
    {
        $data['data'] = array('list' => array());
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/videogif/videogifList';
        $this->load->view('admin/template', $data);
    }
    function getLists(){
        $data = $row = array();
        $memData = $this->mdl_videogif->getRows($_POST);
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $path = base_url('media/videogif/');
            $url = ADMIN_URL . 'videogif/editvideogif/';
            $click = "deleterecord($member->v_id,'/videogif/deletevideogif')";
            $thumb = base_url('media/videogif/thumb/').$member->thumb;
            $data[] = array(
                'DT_RowId' =>$member->v_id,
                '<input type="checkbox" class="sub_chk" data-idd="'.$member->path.'" data-id="'.$member->v_id.'" width="12px">', 
                $member->v_id, 
                $member->mtitle, 
                ($member->type=='0')?'GIF':'Video', 
                /* ($member->free_paid=='0')?'Free':'Paid', */
                ($member->free_paid=='1')?'<img src="'.base_url('assets/paid.svg').'">':'',
                ($member->type=='0')? 
                '<a class="image-popup-no-margins" href="'.$path.$member->path.'"><img class="img-responsive" src="'.$path.$member->path.'"width="100px"></a>'
                :'<video width="130" controls><source src="'.$path.$member->path.'" type="video/mp4"></video>',
                '<a class="image-popup-no-margins abc" target="_blank" href="'.$thumb.'"><img src="'.$thumb.'" width="100%"/></a>',
                '<div style="background-color:'.$member->lablebg.';padding: 10px;border-radius: 5px;color: white;">'.$member->lable.'</div>',
                ($member->status=='0')?'off':'on',
                $member->created_at, 
                '<a href="'.$url.$member->v_id.'"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a><a href="javascript:void(0)" id="'.$member->v_id.'" onclick="'.$click.'"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>', 
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_videogif->countAll(),
            "recordsFiltered" => $this->mdl_videogif->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

     public function addvideogif()
    {
        $data['data'] = array(
            'cats' => $this->mdl_category->CategoryList(null,null),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/videogif/videogifAdd';
        $this->load->view('admin/template', $data);
    }

    public function editvideogif($id)
    {
        $edit_data = $this->mdl_videogif->getvideogifById($id);
        if ($edit_data) {
            $data['data'] = array(
                'cats' => $this->mdl_category->CategoryList(null,null),
                'edit' => $edit_data,
            );
            $data['middle'] = 'admin/videogif/videogifAdd';
            $this->load->view('admin/template', $data);
        } else {
            redirect(ADMIN_URL . 'videogif');
        }
    }
    public function isertVideogif()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data1=array();
        $cpt = 0;
        $data_insert = array(
            'mid' => $this->input->post('mid'),
            'type' => $this->input->post('type'),
            'free_paid' => $this->input->post('free_paid'),
            'lable' => $this->input->post('lable'),
            'lablebg' => $this->input->post('lablebg'),
            'status' => $this->input->post('status'),
        );
        $this->load->library('upload');
        $files = $_FILES;
        $config['upload_path'] = './media/videogif/';
        $config['allowed_types'] = '*';
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
                sleep(5);
                $data_insert['path'] = $data1['file_name'];

                if (empty($this->input->post('id'))) {
                    $data_insert['created_at'] = CURRENT_DATE;
                    $data_insert['updated_at'] = CURRENT_DATE;
                    $ret = $this->mdl_videogif->addvideogif($data_insert);

                    /* update_thumb_image_name */
                    $update_thumb_image_name = array(
                        'thumb' => $ret.".jpg",
                    );
                    $this->db->where('v_id', $ret);
                    $this->db->update('videogif', $update_thumb_image_name);
                    /* end update_thumb_image_name */

                     /* video thumbnail genrate  start*/
                    ob_start();
                    
                    $input = base_url('media/videogif/') . $data1['file_name'];
                    $output = "media/videogif/thumb/" . $ret . ".jpg";
                    //$output = "/home/freefestivalpost.in/public_html/media/videogif/thumb/" . $ret . ".jpg";

                    //$command = "ffmpeg -v 0 -y -i \"$input\" -vframes 1 -ss 7 -vcodec mjpeg -f rawvideo -s 336x336 -aspect 16:9 \"$output\" 2>&1";

                    $command = "/usr/bin/ffmpeg -v 0 -y -i \"$input\" -vframes 1 -ss 6 -vcodec mjpeg -f rawvideo -s 336x336 -aspect 16:9 \"$output\" 2>&1";
                    $outputLog = shell_exec($command);
                    //print_r($outputLog);
                    //error_log("FFmpeg command output: " . $outputLog);


                    /* local system working */
                    //$command = "C:\\ffmpeg\\bin\\ffmpeg.exe -i \"$input\" -ss 7 -vframes 1 \"$output\" 2>&1";
                    //$outputLog = shell_exec($command);
                    /* local system working end */


                    //print_r($outputLog);
                    //error_log("FFmpeg command output: " . $outputLog);exit;
                    //error_log("FFmpeg log contents: " . $logContents);exit;
                    ob_end_clean();

                  /*   $input = base_url('media/videogif/').$data1['file_name'];
                    $output = base_url("media/videogif/thumb/").$ret.".jpg";

                    $command = "ffmpeg -v 0 -y -i \"$input\" -vframes 1 -ss 7 -vcodec mjpeg -f rawvideo -s 336x336 -aspect 16:9 \"$output\" 2>&1";
                    $outputLog = shell_exec( $command );
                    ob_end_clean(); */

                } else {
                    $data_insert['updated_at'] = CURRENT_DATE;
                    $ret = $this->mdl_videogif->Updatevideogif($data_insert, $this->input->post('id'));
                }
            }
            $data1['status'] = 'success';
            $data1['message'] = 'videogif Successfully Added...!!';
            /* $this->session->set_flashdata('msg-success', 'Sucessfully.'); */
        } else {
            if (empty($this->input->post('id'))) {
                $data_insert['created_at'] = CURRENT_DATE;
                $data_insert['updated_at'] = CURRENT_DATE;
                $ret = $this->mdl_videogif->addvideogif($data_insert);
                
                if ($ret) {
                    $data1['status'] = 'success';
                    $data1['message'] = 'videogif Successfully Added...!!';
                   /*  $this->session->set_flashdata('msg-success', 'videogif Sucessfully Added.'); */
                } else {
                    $data1['status'] = 'error';
                    $data1['message'] = 'Failed To Add...!!';
                    /* $this->session->set_flashdata('msg-error', 'videogif does not Add.'); */
                }
            } else {
                $data_insert['updated_at'] = CURRENT_DATE;
                $ret = $this->mdl_videogif->Updatevideogif($data_insert, $this->input->post('id'));
                if ($ret == 1) {
                    $data1['status'] = 'success';
                    $data1['message'] = 'videogif Successfully Updated...!!';
                    /* $this->session->set_flashdata('msg-success', 'videogif Sucessfully Updated.'); */
                } else {
                    $data1['status'] = 'error';
                    $data1['message'] = 'Failed To Update...!!';
                    /* $this->session->set_flashdata('msg-error', 'videogif does not Edit.'); */
                }
            }
        }
        
    echo json_encode($data1);
    }

    private function set_upload_options()
    {
        $config = array();
        $config['upload_path'] = './resources/images/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
    public function deletevideogif()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_videogif->getvideogifById($id);
        if ($chek['path']) {
            $filestring = PUBPATH . "media/videogif/" . $chek['path'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_videogif->videogifDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }
    public function subCategory()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $c_type_id = $this->input->post('c_type_id');
        $row_arry = $this->mdl_videogif->getPositionByCategoryName($c_type_id);
        $dropDown = '<option value="">-- Select Position --</option>';
        foreach ($row_arry as $key => $value) {
            $img = 'data-img_src="'.base_url('media/position/').$value['p_image'].'"';
            $dropDown .= "<option ".$img." value=" . $value['pid'] . ">" . $value['p_name'] . "</option>";
        }

        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';
        $data['data'] = $dropDown;

        echo json_encode($data);
    }

    public function deleteAllvideogif()
    {
        $ids = $this->input->post('ids');
        $image = $this->input->post('image');
        for ($i = 0; $i < count($image); $i++) {
            $filestring = PUBPATH . "media/videogif/" . $image[$i];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->db->where_in('v_id', explode(",", $ids));
        $this->db->delete('videogif');

        echo json_encode(['success' => "Item Deleted successfully."]);
    }
    public function allEditUpdate()
    {
        $edit_id = $this->input->post('edit_id');
        if ($edit_id != "") {
            $data_insert = array(
                'p_id' => $this->input->post('position_name'),
                'cat_id' => $this->input->post('category_name'),
                't_event_date' => $this->input->post('t_event_date'),
                'font_size' => $this->input->post('font_size'),
                'font_type' => $this->input->post('font_name'),
                'font_color' => $this->input->post('font_color'),
            );
            $this->db->where_in('tid', explode(",", $edit_id));
            $this->db->update('tamplet', $data_insert);
        }
        redirect(base_url("admin/videogif/"));
    }

    public function getCatPosForModel()
    {
        $data['data'] = array(
            'fonts' => $this->mdl_fonts->getFontList(),
            'cats' => $this->mdl_category->CategoryList(null,null),
            'position' => $this->mdl_position->getPositionList(),
        );

        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';
        $data['data'] = $data['data'];

        echo json_encode($data);
    }

}
