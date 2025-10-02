<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->library('image_lib');
    }

    /*   public function index()
    {
        $data['data'] = array();
        $data['middle'] = 'admin/test/test';
        $this->load->view('admin/template', $data);
    } */
    public function index($name, $fontName, $fontSize, $fontColor, $abc1, $abc2, $abc3, $abc4)
    {
        echo "font-name/fontSize/fontColor/top-middle-bottom/left-center-right/left/top/";
        echo "<br>";
        $logo_path = realpath("media/test/logo.png");
        $font = realpath('assets/fonts') . '/' . $fontName . '.ttf';
        $tamplate_path = realpath("media/test/test.jpg");

        $config['source_image'] = $tamplate_path;
        $config['wm_text'] = $name;
        $config['wm_type'] = 'text';
        $config['create_thumb'] = TRUE;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = $logo_path;
        $config['wm_font_path'] = $font;
        $config['wm_font_size'] = $fontSize;
        $config['wm_font_color'] = '#' . $fontColor;
        $config['wm_vrt_alignment'] = $abc1;/* top, middle, bottom */
        $config['wm_hor_alignment'] = $abc2;/* left, center, right */
        $config['wm_hor_offset'] = $abc3; /* addu - left*/
        $config['wm_vrt_offset'] = $abc4; /* ubbhu - top */

        $abc = $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo "<br />";
            echo "error";
            echo "<br />";
            print_r($this->image_lib->display_errors());exit;
        }
       /*  $result = $this->userLogo(); */
        //print_r($result);
        $this->load->view('admin/test/test');
    }
    public function userLogo($abc1, $abc2, $abc3, $abc4)
    {
        $tamplate_path = realpath("media/test/test.jpg");
        $logo_path = realpath("media/test/logo.png");

        $config['source_image'] = $tamplate_path; /* none */
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = TRUE;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['wm_type'] = 'overlay';  /* text, overlay */
        $config['quality'] = 40;
        $config['padding'] = 10;
        $config['wm_opacity'] = 50;
        $config['wm_overlay_path'] = $logo_path;    /* the overlay image */
        $config['wm_vrt_alignment'] = $abc1; /* top, middle, bottom */
        $config['wm_hor_alignment'] = $abc2; /* left, center, right */
        $config['wm_hor_offset'] = $abc3; /* addu - left*/
        $config['wm_vrt_offset'] = $abc4;/* ubbhu - top */

        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            return $this->image_lib->display_errors();
        }
        $this->load->view('admin/test/test');
    }


    public function testWhatsAppMsg()
    {
        echo "hello";
        $result = set_whatsapp_api_tamplate("8141631370","app_catalogue_pdf_short","Moradiya Sandip","31/02/2024","2 Year",0,"auto");
        echo "success!";
        print_r($result);exit;
    }
    
}
