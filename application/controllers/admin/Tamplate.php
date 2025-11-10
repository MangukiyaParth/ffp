<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamplate extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_tamplate');
        $this->load->model('admin/mdl_fonts');
        $this->load->model('admin/mdl_category');
        $this->load->model('admin/mdl_position');
        /* thumbnail */
        $this->load->helper('thumbimage_helper');
        $this->load->library('image_lib');
        /* thumbnail end */
    }

    public function index()
    {
        $data['data'] = array('list' => array());/* $this->mdl_tamplate->getTamplatelist() */
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/tamplate/tamplateList';
        $this->load->view('admin/template', $data);
    }
    function getLists(){
        $data = $row = array();
        $memData = $this->mdl_tamplate->getRows($_POST);
        $i = $_POST['start'];

        foreach($memData as $member){
            $i++;
            $t_event_date = ($member->t_event_date!="0000-00-00")?date( 'd/m/Y', strtotime($member->t_event_date)):'';
            /* $status = ($member->status == 1)?'Active':'Inactive'; */
            $path = base_url('media/template/');

            
            $url = ADMIN_URL . 'tamplate/edittamplate/';
            $click = "deleterecord($member->tid,'/tamplate/deletetamplate')";
            
            $planPath = base_url('media/template/plan/').$member->mslug."/".$member->tid.'.jpg';
            $planImgCheck = PUBPATH . "media/template/plan/".$member->mslug."/".$member->tid.'.jpg';

            

            if($member->planImgName != ""){
                $oldname = PUBPATH . "media/template/plan/thumb/".$member->tid.'.jpg';
                if (file_exists($oldname)) {
                    $thumbImgUrl = base_url('media/template/plan/thumb/').$member->tid.'.jpg';
                }else{
                    //$oldname1 = PUBPATH . "media/template/thumb/".$member->path;
                    /* if (file_exists($oldname1)) { */
                        $thumbImgUrl = base_url('media/template/thumb/').$member->path;
                    /* }else{
                        $thumbImgUrl = base_url('media/no-img-found.jpg');
                    } */
                }
            }else{
                /* $oldname2 = PUBPATH . "media/template/thumb/".$member->path;
                if (file_exists($oldname2)) { */
                    $thumbImgUrl = base_url('media/template/thumb/').$member->path;
                /* }else{
                    $thumbImgUrl = base_url('media/no-img-found.jpg');
                } */
            }
            
            /* switch ($member->language) {
                case 1:
                    $language = "English";
                    break;
                case 2:
                    $language = "Hindi";
                    break;
                case 3:
                    $language = "Gujarati";
                    break;
                case 4:
                    $language = "Marathi";
                    break;
                case 5:
                    $language = "Telugu";
                    break;
                case 6:
                    $language = "Tamil";
                    break;
                default:
                    $language = "English";
                    break;
            } */
            
            $data[] = array(
                'DT_RowId' =>$member->tid,
                '<input type="checkbox" class="sub_chk" data-idd="'.$member->path.'" data-id="'.$member->tid.'" width="12px">', 
                $member->tid, 
                ($member->free_paid=='1')?'<img src="'.base_url('assets/paid.svg').'">':'', 
                $member->type, 
                $member->p_name, 
                $t_event_date, 
                '<a class="image-popup-no-margins abc" target="_blank" href="'.$path.$member->path.'"><img class="img-responsive" src="'.$path.$member->path.'"width="100px"></a>', 
                (file_exists($planImgCheck))?'<a class="image-popup-no-margins abc" target="_blank" href="'.$planPath.'"><img class="img-responsive" src="'.$planPath.'"width="75px"></a>':"-", 
                '<a class="image-popup-no-margins abc" target="_blank" href="'.$thumbImgUrl.'"><img class="img-responsive" src="'.$thumbImgUrl.'"width="65px"></a>', 
                ($member->has_mask=='1')?'<a class="image-popup-no-margins abc" target="_blank" href="'.$path.$member->mask.'"><img class="img-responsive" src="'.$path.$member->mask.'"width="65px"></a>':'-', 
                $member->mtitle, 
                /* $member->font_size.'-'.$member->font_type,  
                '<input type="color" value="'.$member->font_color.'" style="margin-top: 5px;"><br>'.$member->font_color,*/
                $member->language,
                '<a href="'.$url.$member->tid.'"><button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a><a href="javascript:void(0)" id="'.$member->tid.'" onclick="'.$click.'"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>', 
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_tamplate->countAll(),
            "recordsFiltered" => $this->mdl_tamplate->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function addTamplate()
    {
        $data['data'] = array(
            'fonts' => $this->mdl_fonts->getFontList(),
            'language' => $this->mdl_tamplate->getLangList(),
            'cats' => $this->mdl_category->CategoryList(null,null),
            'position' => $this->mdl_position->getPositionList(),
            'c_type' => $this->mdl_position->getCTypeList()
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/tamplate/tamplateAdd';
        $this->load->view('admin/template', $data);
    }
    public function editTamplate($id)
    {
        $edit_data = $this->mdl_tamplate->getTamplateById($id);
        if ($edit_data) {
            $data['data'] = array(
                'fonts' => $this->mdl_fonts->getFontList(),
                'language' => $this->mdl_tamplate->getLangList(),
                'cats' => $this->mdl_category->CategoryList(null,null),
                'position' => $this->mdl_position->getPositionList(),
                'c_type' => $this->mdl_position->getCTypeList(),
                'edit' => $edit_data,
            );
            $data['middle'] = 'admin/tamplate/tamplateAdd';
            $this->load->view('admin/template', $data);
        } else {
            redirect(ADMIN_URL . 'tamplate');
        }
    }
    public function isertTamplate()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data1=array();
        $cpt = 0;
        $font_color = str_replace(' ', '', $this->input->post('font_color'));
        $cat_id = explode('_',$this->input->post('cat_id'));
         /* slug find for rename plan tamplate */
         $user = $this->db->select('mslug')->where('mid', $cat_id[0])->get("main_category");
         $slugName = $user->row_array()['mslug'];
        
        if (array_key_exists('free_paid', $this->input->post())) {
            $free_paid = 1;
        } else {
            $free_paid =  0;
        }

        if (array_key_exists('has_mask', $this->input->post())) {
            $has_mask = 1;
        } else {
            $has_mask =  0;
        }

        $data_insert = array(
            'p_id' => $this->input->post('p_id'),
            'free_paid' => $free_paid,
            'type' => $this->input->post('type'),
            't_event_date' => $this->input->post('t_event_date'),
            'cat_id' => $cat_id[0],
            'font_type' => $this->input->post('font_type'),
            'font_size' => $this->input->post('font_size'),
            'lable' => $this->input->post('lable'),
            'lablebg' => str_replace(' ', '', $this->input->post('lablebg')),
            'language' => $this->input->post('ln_post'),
            'has_mask' => $has_mask,
        );
        $this->load->library('upload');
        $files = $_FILES;
        $config['upload_path'] = './media/template/';
        $config['allowed_types'] = '*';
        $countRenameImg = 0;
        $countImgNotFound = 0;
        $imgNotFound = "";
        $totalImg = 0;
        if (!empty($_FILES['image']['name'][0])) {
            $cpt = count((array)$_FILES['image']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $totalImg++;
                $filennm = $files['image']['name'][$i];

                $info = pathinfo($filennm); 
                $main_filename = $info['filename'];
                $main_extension = $info['extension'];

                $color1 = explode('.',$filennm );
                if($font_color == ""){
                    $color = explode('-color-',$color1[0] );
                    if(array_key_exists('1',$color)){
                        if($color[1]!=""){
                            $font_color='#'.str_replace(' ', '', $color[1]);
                        }else{
                            $font_color = '#000000';
                        }
                    }else{
                        $font_color = '#000000';
                    }
                }
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
                
                $data_insert['path'] = $data1['file_name'];


                /* Add Mask  */
                if ($has_mask && !empty($files['mask']['name'][$i])) {
                    // Use the MASK file input here, not "image"
                    $_FILES['mask']['name']     = $files['mask']['name'][$i];
                    $_FILES['mask']['type']     = $files['mask']['type'][$i];
                    $_FILES['mask']['tmp_name'] = $files['mask']['tmp_name'][$i];
                    $_FILES['mask']['error']    = $files['mask']['error'][$i];
                    $_FILES['mask']['size']     = $files['mask']['size'][$i];

                    $maininfo               = pathinfo($files['image']['name'][$i]); // original image name
                    $maskNameBase           = $maininfo['filename'] . '-mask.' . $maininfo['extension']; // photo-mask.jpg
                    $new_mask_name          = $i . time() . slug_string($maskNameBase);
                    $config2['upload_path'] = './media/template/';
                    $config2['allowed_types'] = '*';
                    $config2['file_name']    = $new_mask_name;
                    $this->load->library('upload', $config2);
                    $this->upload->initialize($config2);

                    if ($this->upload->do_upload('mask')) {
                        $data2 = $this->upload->data();
                        $data_insert['mask'] = $data2['file_name'];
                    } else {
                        // handle error if needed
                        $data_insert['mask'] = "";
                    }
                } else {
                    $data_insert['mask'] = "";
                }

                /* thumbnail */
                $newPath = "media/template/";
                $filename = $data1['file_name'];
                createThumbResize($filename,$newPath);
                /* thumbnail end */
                $data_insert['font_color'] = $font_color;


                if (empty($this->input->post('id'))) {
                    $data_insert['created_at'] = CURRENT_DATE;
                    $data_insert['updated_at'] = CURRENT_DATE;
                    $lastId = $this->mdl_tamplate->addTamplate($data_insert);

                    /* plan photo ne rename krine upload krva ne vadharana pic ne delete krva mate */
                    $planTempRename = explode('+',$color1[0]);
                    if(array_key_exists('0',$planTempRename)){
                        if ($planTempRename[0]) {
                            $oldname = PUBPATH . "media/template/plan/".$slugName.'/'.$planTempRename[0].".".$main_extension;
                            $newname = PUBPATH . "media/template/plan/".$slugName.'/'.$lastId.".".$main_extension;
                            if (file_exists($oldname)) {
                                rename($oldname,$newname);
                                $countRenameImg++;
                                $error[$i]['success'] = "Rename successfully";
                            }else{
                                $countImgNotFound++;
                                $error[$i]['error'] = "Old File not found";
                            }
                        }
                    }else{
                        $error[$i]['error'] = "+ key Not exit";
                    }
                } else {
                    $data_insert['updated_at'] = CURRENT_DATE;
                    $ret = $this->mdl_tamplate->UpdateTamplate($data_insert, $this->input->post('id'));
                }
                $font_color = '';
                $color1 = '';
                $color = '';
            }
            $data1['status'] = 'success';
            $data1['message'] = 'Tamplate Successfully Added...!!';
            /* $this->session->set_flashdata('msg-success', 'Sucessfully.'); */
        } else {
            if (empty($this->input->post('id'))) {
                $data_insert['font_color'] = $font_color!=""?$font_color:'#000000';
                $data_insert['created_at'] = CURRENT_DATE;
                $data_insert['updated_at'] = CURRENT_DATE;
                $ret = $this->mdl_tamplate->addTamplate($data_insert);
                if ($ret) {
                    $data1['status'] = 'success';
                    $data1['message'] = 'Tamplate Successfully Added...!!';
                   /*  $this->session->set_flashdata('msg-success', 'Tamplate Sucessfully Added.'); */
                } else {
                    $data1['status'] = 'error';
                    $data1['message'] = 'Failed To Add...!!';
                    /* $this->session->set_flashdata('msg-error', 'Tamplate does not Add.'); */
                }
            } else {
                $data_insert['font_color'] = $font_color!=""?$font_color:'#000000';
                $data_insert['updated_at'] = CURRENT_DATE;
                $ret = $this->mdl_tamplate->UpdateTamplate($data_insert, $this->input->post('id'));
                if ($ret == 1) {
                    $data1['status'] = 'success';
                    $data1['message'] = 'Tamplate Successfully Updated...!!';
                    /* $this->session->set_flashdata('msg-success', 'Tamplate Sucessfully Updated.'); */
                } else {
                    $data1['status'] = 'error';
                    $data1['message'] = 'Failed To Update...!!';
                    /* $this->session->set_flashdata('msg-error', 'Tamplate does not Edit.'); */
                }
            }
        }
        
        $data1['totalImg'] = $totalImg;
        $data1['countImgNotFound'] = $countImgNotFound;
        $data1['imgNotFound'] = $imgNotFound;
        $data1['countRenameImg'] = $countRenameImg;
        echo json_encode($data1);
        /* redirect(base_url("admin/tamplate/")); */
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './resources/images/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
    public function deletetamplate()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_tamplate->getTamplateById($id);
        if ($chek['path']) {
            $filestring = PUBPATH . "media/template/" . $chek['path'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_tamplate->TamplateDelete($id);
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
        $row_arry = $this->mdl_tamplate->getPositionByCategoryName($c_type_id);
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

    public function deleteAllTamplate()
    {
        $ids = $this->input->post('ids');
        $image = $this->input->post('image');
        for ($i = 0; $i < count($image); $i++) {
            $filestring = PUBPATH . "media/template/" . $image[$i];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->db->where_in('tid', explode(",", $ids));
        $this->db->delete('tamplet');

        echo json_encode(['success' => "Item Deleted successfully."]);
    }
    public function allEditUpdate()
    {
        
        $edit_id = $this->input->post('edit_id');
        if ($edit_id != "") {
            

            if (array_key_exists('free_paid', $this->input->post())) {
                $free_paid = 1;
            } else {
                $free_paid =  0;
            }


            if ($this->input->post('position_name')!="") {
                $data_insert['p_id'] = $this->input->post('position_name');
            }
            if ($this->input->post('category_name')!="") {
                $data_insert['cat_id'] = $this->input->post('category_name');
            }
            if ($this->input->post('t_event_date')!="") {
                $data_insert['t_event_date'] = $this->input->post('t_event_date');
            }
            if ($this->input->post('font_size')!="") {
                $data_insert['font_size'] = $this->input->post('font_size');
            }
            if ($this->input->post('font_name')!="") {
                $data_insert['font_type'] = $this->input->post('font_name');
            }
            if ($this->input->post('font_color')!="") {
                $data_insert['font_color'] = str_replace(' ', '', $this->input->post('font_color'));
            }
            if ($this->input->post('fpchanges')=="1") {
                $data_insert['free_paid'] = $free_paid;
            }
            if ($this->input->post('lang_name')!="") {
                $data_insert['language'] = $this->input->post('lang_name');
            }
           /*  $data_insert = array(
                'p_id' => $this->input->post('position_name'),
                'free_paid' => $free_paid,
                'cat_id' => $this->input->post('category_name'),
                't_event_date' => $this->input->post('t_event_date'),
                'font_size' => $this->input->post('font_size'),
                'font_type' => $this->input->post('font_name'),
                'font_color' => $this->input->post('font_color'),
            ); */
            $this->db->where_in('tid', explode(",", $edit_id));
            $this->db->update('tamplet', $data_insert);
        }
        redirect(base_url("admin/tamplate/"));
    }

    public function getCatPosForModel()
    {
        $data1['data'] = array(
            'fonts' => $this->mdl_fonts->getFontList(),
            'language' => $this->mdl_tamplate->getLangList(),
            'cats' => $this->mdl_category->CategoryList(null,null),
            'position' => $this->mdl_position->getPositionList(),
        );
       
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';
        $data['data'] = $data1['data'];

        echo json_encode($data);
    }
}
