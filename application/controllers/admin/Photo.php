<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Photo extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_photo');
         /* thumbnail */
         $this->load->helper('thumbimage_helper');
         $this->load->library('image_lib');
         /* thumbnail end */
    }

    public function index()
    {
        $data['data'] = array('list' => array());/* $this->mdl_photo->getPhotolist() */
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/photo/photoList';
        $this->load->view('admin/template', $data);
    }

    function getPhotoListServer(){
        $data = $row = array();
        $memData = $this->mdl_photo->getRows($_POST);
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $created_at = ($member->created_at!="0000-00-00")?date( 'd/m/Y', strtotime($member->created_at)):'';

            $path = base_url('media/photo/');
            $onClickDelete = "deleterecord($member->photoId,'/photo/deletephoto')";
            $data[] = array(
                'DT_RowId' =>$member->photoId,
                '<input type="checkbox" class="sub_chk" data-idd="'.$member->photo.'" data-id="'.$member->photoId.'" width="12px">',
                $member->photoId, 
                $created_at,
                $member->pcat_title, 
                $member->title, 
                ($member->photo!="")?'<a class="image-popup-no-margins abc" target="_blank" href="'.$path.$member->photo.'"><img class="img-responsive" src="'.$path.$member->photo.'"width="60px"></a>':'No Logo', 
                '<a href="javascript:void(0)" id="'.$member->photoId.'" onclick="'.$onClickDelete.'"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button></a>',
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_photo->countAll(),
            "recordsFiltered" => $this->mdl_photo->countFiltered($_POST),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function addPhoto()
    {
        $data['data'] = array(
            'list'=>$this->mdl_photo->getCategoryList(),
            'edit'=>''
        );
        $data['middle'] = 'admin/photo/photoAdd';
        $this->load->view('admin/template', $data);
    }
    
    public function isertPhoto()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data1 = array();
        $cpt = 0;
        $data_insert = array(
            'title' => '',
            'pcat_id' => $this->input->post('pcat_id'),
        );
        $this->load->library('upload');
        $files = $_FILES;
        $config['upload_path'] = './media/photo/';
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
                
                $data_insert['photo'] = $data1['file_name'];
                $data_insert['created_at'] = CURRENT_DATE;

                /* thumbnail */
                $newPath = "media/photo/";
                $filename = $data1['file_name'];
                createThumbResize($filename,$newPath);
                /* thumbnail end */

                $this->mdl_photo->addPhoto($data_insert);
            }
            $data1['status'] = 'success';
            $data1['message'] = 'Photo Successfully Added...!!';
        }
        
    echo json_encode($data1);
    }

    public function deletephoto()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $chek = $this->mdl_photo->getPhotoById($id);
        if ($chek['photo']) {
            $filestring = PUBPATH . "media/photo/" . $chek['photo'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->mdl_photo->photoDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }
    

    public function deleteAllphoto()
    {
        $ids = $this->input->post('ids');
        $image = $this->input->post('image');
        for ($i = 0; $i < count($image); $i++) {
            $filestring = PUBPATH . "media/photo/" . $image[$i];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
        }
        $this->db->where_in('photoId', explode(",", $ids));
        $this->db->delete('photos');

        echo json_encode(['success' => "Item Deleted successfully."]);
    }

    public function category()
    {
        $data['data'] = array(
            'list' => $this->mdl_photo->getCategoryList(),
            'edit' => ""
    );
        $data['middle'] = 'admin/photo/listcategory';
        $this->load->view('admin/template', $data);
    }
    public function editcategory($id)
    {
        $data['data'] = array(
            'list' => $this->mdl_photo->getCategoryList(),
            'edit' => $this->mdl_photo->getCategoryById($id)
        );
        $data['middle'] = 'admin/photo/listcategory';
        $this->load->view('admin/template', $data);
    }
    public function insertCategory()
    {
        $data_insert = array();
        $data_insert['lable'] = $this->input->post('lable');
        $data_insert['lablebg'] = $this->input->post('lablebg');
        $data_insert['pcat_title'] = $this->input->post('pcat_title');

        if (empty($this->input->post('id'))) {
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/photocategory/';
                $config['allowed_types'] = '*';
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();;
                } else {
                    $data1 = $this->upload->data();
                    $data_insert['pcat_image'] = $data1['file_name'];

                     /* thumbnail */
                    $newPath = "media/photocategory/";
                    $filename = $data1['file_name'];
                    createThumbResize($filename,$newPath);
                    /* thumbnail end */

                    $result = $this->mdl_photo->addCategory($data_insert);
                    if ($result) {
                        $data['status'] = 'success';
                        $data['message'] = 'Category Successfully Added...!!';
                    } else {
                        $data['status'] = 'error';
                        $data['message'] = 'Failed To Add...!!';
                    }
                }
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Please Select Thumbnail!!';
            }
        }else{
            
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/photocategory/';
                $config['allowed_types'] = '*';
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();;
                } else {
                    $data1 = $this->upload->data();
                    $data_insert['pcat_image'] = $data1['file_name'];
                    
                    /* thumbnail */
                     $newPath = "media/photocategory/";
                     $filename = $data1['file_name'];
                     createThumbResize($filename,$newPath);
                     /* thumbnail end */
                }
            }
            $result = $this->mdl_photo->editCategoryById($data_insert,$this->input->post('id'));
            if ($result) {
                $data['status'] = 'success';
                $data['message'] = 'Category Successfully Added...!!';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed To Add...!!';
            }
        }

        echo json_encode($data);
    }

}
