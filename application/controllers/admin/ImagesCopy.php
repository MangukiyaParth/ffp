<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ImagesCopy extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }

        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
            exit;
        }

        $this->load->model('admin/mdl_imagescopy');
        $this->load->library('zip');
        $this->load->helper('download');
        /* thumbnail */
        $this->load->helper('thumbimage_helper');
        $this->load->library('image_lib');
        /* thumbnail end */
    }
    public function index(){
        $data['data']=array(
            'categoryList'=>$this->mdl_imagescopy->getCategoryName(),
        );
        $data['middle']='admin/imagescopy/imagescopy';        
        $this->load->view('admin/template',$data);
    }
    
    public function copyToPlanFolderWithIdName(){

        if($this->input->post()){
            $cat =  explode('-_-',$this->input->post('cat_id'));
            $zipCategoryName = $cat[1].".zip";
            $categoryName = $cat[1]."/";
            
            $data_result = $this->mdl_imagescopy->getTampList($cat[0]);
            
            $srcPath = 'media/template/';
            $destPath = 'media/template/plan/'.$categoryName;  

            if(!is_dir($destPath)){
                mkdir($destPath);
            }else{
                echo "folder exist<br>";
            }
            $i = 0;
            foreach($data_result as $res)
            {
                $imageName = $res['path'];
                $tid = $res['tid'];

                $printName = $tid."--".$imageName;
                if($imageName != ""){
                    if (file_exists($srcPath.$imageName)){
                        $ext = explode(".",$imageName);
                        $rename = $tid.".".$ext[1];

                        if (!file_exists($destPath.$rename)) {
                            if(copy($srcPath . $imageName, $destPath . $rename)){
                                echo $printName." ----> Copy";
                                $i = $i+1;

                                /* thumbnail */
                            $newPath = "media/template/plan/".$categoryName;
                            $filename = $rename;
                            createThumbResize($filename,$newPath);
                            /* thumbnail end */
                            
                                /* query thi tamplet table ma ek sathe planImaName update krva mate start */
                            $updatePlanImgName = array(
                                'planImgName' => $rename,
                            );

                            $this->db->where('tid', $tid);
                            $this->db->update('tamplet', $updatePlanImgName);    

                            /* end */



                            }else{
                                echo $printName." ----> Canot Copy";
                            } 
                            /* echo "copy not file exist<br>"; */
                        }else{
                            echo $printName." ----> copy image exist<br>";
                        }
                    
                        /* echo "main file exists;<br>"; */
                    }else{
                        echo $printName." ----> main image not exists;<br>";
                    }
                }else{
                    echo $printName." ----> file name empty<br>;";
                }
            }
            
            $this->zip->read_dir($destPath); 
            $this->zip->archive(FCPATH.$srcPath.'plan/'.$zipCategoryName);
            $this->zip->download($zipCategoryName);
            echo "<br><br><b> Total Copy Image ".$i."</b>";
        }
    }

    public function planImagesBulkUpload(){

        if($this->input->post()){
            $cat_slug =  $this->input->post('cat_slug');
            $zipCategoryName = $cat_slug.".zip";
            $categoryName = $cat_slug."/";
            
            $destPath = 'media/template/plan/'.$categoryName;  

            if(!is_dir($destPath)){
                mkdir($destPath);
            }

            $this->load->library('upload');
            $files = $_FILES;
            $config['upload_path'] = './media/template/plan/'.$categoryName;
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $num = 0 ;
            if (!empty($_FILES['image']['name'][0])) {
                $cpt = count((array)$_FILES['image']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                
                    $_FILES['image']['name'] = $files['image']['name'][$i];
                    $_FILES['image']['type'] = $files['image']['type'][$i];
                    $_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
                    $_FILES['image']['error'] = $files['image']['error'][$i];
                    $_FILES['image']['size'] = $files['image']['size'][$i];

                    $config['file_name'] = $_FILES['image']['name'];
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload("image");
                    $data1 = $this->upload->data();
                    /* thumbnail */
                    $newPath = "media/template/plan/".$categoryName;
                    $filename = $_FILES['image']['name'];
                    createThumbResizeOnlyPlan($filename,$newPath);
                    /* thumbnail end */
                    $num++;
                }
            }
            $this->session->set_flashdata('totalUploadImg', 'Total upload images: '.$num);
        }
        redirect(ADMIN_URL . 'ImagesCopy');
    }
}
?>
