<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends CI_Controller
{

    protected $current_user;

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_category');
        //$this->load->library('excel');
        $this->load->helper('imgupload_helper');
        /* thumbnail */
        $this->load->helper('thumbimage_helper');
        $this->load->library('image_lib');
        /* thumbnail end */
    }

    public function index()
    {
        $start_date = "";
        $end_date = "";
        if($this->input->post()){
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $data['data'] = array(
                'list' => $this->mdl_category->CategoryList($start_date,$end_date),
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            );
            $data['data']['edit'] = '';
            $data['middle'] = 'admin/category/categorylist';
            $this->load->view('admin/template', $data);
        }else{
            $data['data'] = array(
                'list' => $this->mdl_category->CategoryList($start_date,$end_date),
                'start_date'=>$start_date,
                'end_date'=>$end_date,
            );
            $data['data']['edit'] = '';
            $data['middle'] = 'admin/category/categorylist';
            $this->load->view('admin/template', $data);
        }
    }

    public function CatAdd()
    {
        $data['data'] = array(
            /* 'list' => $this->mdl_category->CategoryList(), */
            'mainCat' => $this->mdl_category->MainCategoryList(),
        );
        $data['data']['edit'] = '';
        $data['middle'] = 'admin/category/categoryadd';
        $this->load->view('admin/template', $data);
    }

    public function add()
    {
        $status = empty($this->input->post('status')) ? 0 : 1;
        $msg = [];
        $data = array(
            'c_id' => $this->input->post('maincat'),
            'event_date' => $this->input->post('event_date'),
            'mtitle' => $this->input->post('name'),
            'lable' => $this->input->post('lable'),
            'lablebg' => "",
            'noti_quote' => $this->input->post('noti_quote'),
            'status' => $status,
        );
        $data['plan_auto'] = ($this->input->post('plan_auto')!="")?1:null;
        /* $this->input->post('lablebg') */

        if (empty($this->input->post('id'))) {

            $data['created_at'] = CURRENT_DATE;
            $data['updated_at'] = CURRENT_DATE;
            $data['mslug'] = slug_string($this->input->post('name'));
            $check_exist = count($this->mdl_category->categorychk($this->input->post('name')));
            if ($check_exist) {
                $msg['status'] = 'error';
                $msg['message'] = $this->input->post('name') . ' already Exist...!!';
            } else {
                if (isset($_FILES['image']['name'])) {
                    $image = imageUpload($_FILES['image']['name'], 'image', 'category', 'media/category');
                    /* thumbnail */
                    $newPath = "media/category/";
                    $filename = $image;
                    createThumbResize($filename,$newPath);
                    /* thumbnail end */

                    $data['image'] = $image;
                }

                /* notification banner upload */
                if (isset($_FILES['noti_banner']['name'])) {
                    $image1 = imageUpload($_FILES['noti_banner']['name'], 'noti_banner', 'category', 'media/category/banner/');
                    $data['noti_banner'] = $image1;
                }
                
                $ret = $this->mdl_category->addCategory($data);
                if ($ret) {
                    $msg['status'] = 'success';
                    $msg['message'] = 'Category Sucessfully Added.';
                } else {
                    $msg['status'] = 'error';
                    $msg['message'] = 'Category does not Add.';
                }
            }
        } else {
            $data['updated_at'] = CURRENT_DATE;

            $resu = $this->mdl_category->getCategoryById($this->input->post('id'));
            if (isset($_FILES['image']['name'])) {
                
                if ($resu['image']) {
                    $filestring = PUBPATH . "media/category/" . $resu['image'];
                    if (file_exists($filestring)) {
                        unlink($filestring);
                    }
                }

                $image = imageUpload($_FILES['image']['name'], 'image', 'category', 'media/category');
                /* thumbnail */
                $newPath = "media/category/";
                $filename = $image;
                createThumbResize($filename,$newPath);
                /* thumbnail end */
                $data['image'] = $image;
            }
             /* notification banner upload */
            if (isset($_FILES['noti_banner']['name'])) {
                
                if ($resu['noti_banner']) {
                    $filestring1 = PUBPATH . "media/category/banner/" . $resu['noti_banner'];
                    if (file_exists($filestring1)) {
                        unlink($filestring1);
                    }
                }

                $image1 = imageUpload($_FILES['noti_banner']['name'], 'noti_banner', 'category', 'media/category/banner/');
                $data['noti_banner'] = $image1;
            }

            $ret = $this->mdl_category->editCategoryById($data, $this->input->post('id'));
            if ($ret == 1) {
                $msg['status'] = 'success';
                $msg['message'] = 'Category Sucessfully Updated.';
            } else {
                $msg['status'] = 'error';
                $msg['message'] = 'Category does not Edit.';
            }
        }
        clear_cache();
        echo json_encode($msg);exit();
    }

    public function edit($id)
    {
        $data['data'] = array(
            /* 'list' => $this->mdl_category->CategoryList(), */
            'mainCat' => $this->mdl_category->MainCategoryList(),
        );
        $data['data']['edit'] = $this->mdl_category->getCategoryById($id);
        $data['middle'] = 'admin/category/categoryadd';
        $this->load->view('admin/template', $data);
    }

    public function makedi()
    {
        $dir = $this->input->post('id');
        $destPath = 'media/template/plan/'.$dir; 
        $data = array(); 
        if(!is_dir($destPath)){
            mkdir($destPath);
            $data['status'] = 'success';
            $data['message'] = $dir.' Create Sucessfully.';
        }else{
            $data['status'] = 'error';
            $data['message'] = 'Folder Exist';
        }
        clear_cache();
        echo json_encode($data);exit();
    }

    public function statuschk()
    {
        $this->mdl_category->updatecategory($this->input->post('id'), array('status' => $this->input->post('status')));
        $data['status'] = 'success';
        $data['message'] = "Category Status Changed Success..!";
        clear_cache();
        echo json_encode($data);
    }
    
    public function deleteCategory()
    {

        $ret = $this->mdl_category->deleteCategoryById($this->input->post('id'));
        $msg = [];
        if ($ret == 1) {
            $msg['status'] = 'success';
            $msg['message'] = 'Category Sucessfully Deleted.';
        } else {
            $msg['status'] = 'error';
            $msg['message'] = 'Category does not Delete.';
        }

        clear_cache();
        echo json_encode($msg);exit();
    }

    function import()
    {
        if (isset($_FILES["file"]["name"])) {
            if ($_FILES["file"]["name"] != "sample.xlsx") {
                $data['status'] = 'error';
                $data['message'] = 'This file is not sample...';
                echo json_encode($data);
                exit;
            }

            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $c_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $image = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $event_date = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $mtitle = $worksheet->getCellByColumnAndRow(3, $row)->getValue();


                    if ($c_id != "" || $mtitle != null) {
                        $count_rows = $this->mdl_category->checkCategoryData($c_id, $mtitle);

                        $event_date = ($event_date != "") ? date("Y-m-d", ($event_date * 24 * 60 * 60) - ((70 * 365.25 * 24 * 60 * 60) + (25 * 60 * 60))) : "";
                        if ($count_rows > 0) {
                            $data = array(
                                'c_id' => $c_id,
                                'image' => ($image != null) ? $image : '',
                                'event_date' => $event_date,
                                'mtitle' => $mtitle,
                                'status' => '1',
                                'updated_at' => CURRENT_DATE,
                            );
                            $this->mdl_category->updateCategoryByExcell($data, $c_id, $mtitle);
                        } else {
                            $data[] = array(
                                'c_id' => $c_id,
                                'image' => ($image != null) ? $image : '',
                                'event_date' => $event_date,
                                'mtitle' => $mtitle,
                                'mslug' => slug_string($mtitle),
                                'status' => '1',
                                'created_at' => CURRENT_DATE,
                                'updated_at' => CURRENT_DATE,
                            );
                            $this->mdl_category->insertExcellCategory($data);
                        }
                        $data = array();
                    }
                }
            }

            /* $this->excel_import_model->insert($data); */
            $data['status'] = 'success';
            $data['message'] = 'Category Data Imported successfully';
            clear_cache();
            echo json_encode($data);
        }
    }
}
