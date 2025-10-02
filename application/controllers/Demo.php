<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Demo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('image_lib');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('sms_helper');
    }

    public function index()
    {
        $this->load->view('demo', array('errors' => ' ', 'name' => 'demo1.png'));
    }

    function doupload()
    {
        $name_array = array();
        /* $count = count($_FILES['userfile']['size']);
        foreach ($_FILES as $key => $value) {
            for ($s = 0; $s <= $count - 1; $s++) {
                $_FILES['userfile']['name'] = $value['name'][$s];
                $_FILES['userfile']['type'] = $value['type'][$s];
                $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                $_FILES['userfile']['error'] = $value['error'][$s];
                $_FILES['userfile']['size'] = $value['size'][$s];
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5000';
                $config['max_width'] = '1085';
                $config['max_height'] = '1085';
                $this->load->library('upload', $config);
                $this->upload->do_upload();
                $data = $this->upload->data();
                $name_array[] = $data['file_name'];
               
            }
        } */
        $this->textWatermark("/home/techbpku/public_html/techbitinfo.in/gitdemo/uploads/world-water-day1.jpg");
        $this->textWatermark2("/home/techbpku/public_html/techbitinfo.in/gitdemo/uploads/world-water-day1.jpg");
        $this->overlayWatermark("/home/techbpku/public_html/techbitinfo.in/gitdemo/uploads/world-water-day1.jpg");
        $names = implode(',', $name_array);
        $this->session->set_userdata(array(
            'name' => "world-water-day1.jpg",
        ));
        redirect(base_url() . "demo");
    }
    public function textWatermark($source_image)
    {
        $config['source_image'] = $source_image;
        $font = base_url("assets/fonts/fontawesome-webfont3e6e.ttf");
        $config['wm_text'] = 'Hello Frineds';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './assets/fonts/arial.ttf';
        $config['wm_font_size'] = 60;
        /*$config['wm_shadow_color'] = '0';
        $config['wm_shadow_distance'] = '0';*/
        $config['wm_font_color'] = '000000';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        /*  $config['wm_padding'] = '20'; */
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            return $this->image_lib->display_errors();
        }
    }
    public function textWatermark2($source_image)
    {
        $config['source_image'] = $source_image;
        $font = base_url("assets/fonts/fontawesome-webfont3e6e.ttf");
        $config['wm_text'] = 'admin@gmail.com';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './assets/fonts/arial.ttf';
        $config['wm_font_size'] = 50;        /*$config['wm_shadow_color'] = '0';        $config['wm_shadow_distance'] = '0';*/
        $config['wm_font_color'] = '000000';
        $config['wm_vrt_alignment'] = 'top';
        $config['wm_hor_alignment'] = 'left';
        $config['wm_hor_offset'] = '35'; /* addu - left*/
        $config['wm_vrt_offset'] = '55'; /* ubbhu - top */        /*  $config['wm_padding'] = '20'; */
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            return $this->image_lib->display_errors();
        }
    }
    public function overlayWatermark($source_image)
    {
        /* https://codeigniter.com/userguide2/libraries/image_lib.html */
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image; /* none */
        $config['create_thumb'] = TRUE;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 750;
        $config['height'] = 50;
        $config['wm_type'] = 'overlay';  /* text, overlay */
        /*$config['dynamic_output'] = 'TRUE';*/   /*TRUE/FALSE  */
        $config['wm_overlay_path'] = './uploads/logo.png';     /* the overlay image */
        $config['quality'] = 90;
        $config['padding'] = 10;
        $config['wm_opacity'] = 50;
        $config['wm_hor_alignment'] = 'left'; /* left, center, right */
        $config['wm_vrt_alignment'] = 'top'; /* top, middle, bottom */
        $config['wm_hor_offset'] = '15'; /* addu - left*/
        $config['wm_vrt_offset'] = '45'; /* ubbhu - top */
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            return $this->image_lib->display_errors();
        }
    }


    /* dublicate entry with folder name update */
    public function update_appSlider()
    {
        $this->db->select('*');
        $data = $this->db->get('appSlider');

        $result = $data->result_array();
        $update = array();
        $i=1;
        foreach ($result as $key => $res) {
            $update['imageB'] = "media/slider/" . $res['image'];

            $this->db->where('sid', $res['sid']);
            $this->db->update('appSlider', $update);
            $i++;
        }
        echo "Total update record => ".$i;
    }
    /* main category */
    public function update_mainCategory()
    {
        $this->db->select('*');
        $data = $this->db->get('main_category');
        
        $result = $data->result_array();
        $update = array();
        $i=0;
        foreach ($result as $key => $res) {
            $update['imageB'] = "media/category/" . $res['image'];
            
            $this->db->where('mid', $res['mid']);
            $this->db->update('main_category', $update);
            $i++;
        }
        echo "Total update record => ".$i;
    }    
    
    public function test(){
        /* video thumbnail genrate  start*/
        ob_start();
        $input = base_url('media/1.mp4');
        $output = "media/videogif/thumb/output.jpg";

        $command = "ffmpeg -v 0 -y -i $input -vframes 1 -ss 5 -vcodec mjpeg -f rawvideo -s 336x336 -aspect 16:9 $output 2>&1";
        shell_exec( $command );
        ob_end_clean();
         /* video thumbnail genrate  end*/

    } 
    public function testSms()
     {
            $mobile ="8141639069";
			//send_sms_other($mobile,"welcome","");

			//send_sms_other($userResult['mobile'],"thanks","");

			//send_sms_other($mobile,"buy","1");
     }
     public function updateUser_PlanStatus()
    {
        $this->db->select('*');
        $data = $this->db->get('payments');
        $result = $data->result_array();
        $update = array();
        $i=0;
        foreach ($result as $key => $res) {
            if($res['packageid']==4 || $res['packageid']==2){
                /* trial */
                $update['planStatus'] = 2;
            }else{
                $update['planStatus'] = 1;
            }
            $this->db->where('id', $res['u_id']);
            $this->db->update('admin', $update);
            $i++;
        }
        echo "Total update record => ".$i;
    }    
    
}
