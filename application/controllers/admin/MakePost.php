<?php
class MakePost extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_admin_login')) {
			echo "<h1>No Direct Script Allowed!......</h1>";
			exit();
		}

		$this->load->library('image_lib');
	}

	function index()
	{
		$this->load->view('demo', array('errors' => ' ', 'name' => 'demo1.png'));
	}
	function makePost()
	{
		$business_name = "";
		$business_logo = "logo.png";
		/* 
		left-top
		center-top
		right-top
		center
		left-bottom
		center-bottom
		right-bottom
		*/
		$business_email = "";
		/* 
		left-top
		center-top
		right-top
		left-bottom
		center-bottom
		right-bottom
		*/
		$business_mobile = "8141631370,8141639069";
		/* 
		left-top
		center-top
		right-top
		left-bottom
		center-bottom
		right-bottom
		*/
		$business_website = "";
		/* 
		left-top
		center-top
		right-top
		left-bottom
		center-bottom
		right-bottom
		*/
		$business_address = "";
		/* 
		left-bottom
		center-bottom
		right-bottom
		*/
		$tamplate_path = "E:/xampp/htdocs/business/media/template/sample.jpg";
		$logo_position = "left-top";
		$finalImageName = "02_001";

		$fontName = "arial.ttf";
		$fontSize = "50";
		$fontColor = "000000";

		/* tamplate path/mobile/fontName/fontSize/fontColor */
		$this->textMobile($tamplate_path, $business_mobile, $fontName, $fontSize, $fontColor);

		/* tamplet path/user logo/logo position/final image name-tampaletid_userid */
		$this->overlayLogo($tamplate_path, $business_logo, $logo_position, $finalImageName);
	}

	public function textMobile($tamplate_path, $text, $fontName, $fontSize, $fontColor)
	{
		$config['source_image'] = $tamplate_path;
		$config['wm_text'] = $text;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './assets/fonts/' . $fontName;
		$config['wm_font_size'] = $fontSize;
		/*$config['wm_shadow_color'] = '0';
        $config['wm_shadow_distance'] = '0';*/
		$config['wm_font_color'] = $fontColor;
		$config['wm_vrt_alignment'] = 'top';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_hor_offset'] = '35'; /* addu - left*/
		$config['wm_vrt_offset'] = '55'; /* ubbhu - top */
		/*  $config['wm_padding'] = '20'; */
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}
	/* for images with logo */
	public function overlayLogo($tamplate_path, $business_logo, $logo_position, $finalImageName)
	{
		/* https://codeigniter.com/userguide2/libraries/image_lib.html */
		/* 
		left-top
		center-top
		right-top
		center
		left-bottom
		center-bottom
		right-bottom
		*/

		/* switch case set krvu ahi */
		switch ($logo_position) {
			case 'left-top':
				$wm_hor_alignment = "left";
				$wm_vrt_alignment = "top";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "100";
				break;
			case 'center-top':
				$wm_hor_alignment = "center";
				$wm_vrt_alignment = "top";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
			case 'right-top':
				$wm_hor_alignment = "right";
				$wm_vrt_alignment = "top";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
			case 'center':
				$wm_hor_alignment = "center";
				$wm_vrt_alignment = "middle";
				$wm_hor_offset = "0";
				$wm_vrt_offset = "0";
				break;
			case 'left-bottom':
				$wm_hor_alignment = "left";
				$wm_vrt_alignment = "bottom";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
			case 'center-bottom':
				$wm_hor_alignment = "center";
				$wm_vrt_alignment = "bottom";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
			case 'right-bottom':
				$wm_hor_alignment = "right";
				$wm_vrt_alignment = "bottom";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
			default:
				$wm_hor_alignment = "left";
				$wm_vrt_alignment = "top";
				$wm_hor_offset = "15";
				$wm_vrt_offset = "45";
				break;
		}
		$config['image_library'] = 'gd2';
		$config['source_image'] = $tamplate_path; /* none */
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = $finalImageName;
		/*$config['width'] = 75;
		$config['height'] = 50; */
		$config['wm_type'] = 'overlay';  /* text, overlay */
		$config['dynamic_output'] = 'TRUE';  /*TRUE/FALSE  */
		$config['new_image'] = './media/makepost/';  /*TRUE/FALSE  */
		$config['wm_overlay_path'] = './media/logo/' . $business_logo;     /* the overlay image */
		$config['quality'] = 90;
		$config['padding'] = 10;
		$config['wm_opacity'] = 100;
		$config['wm_hor_alignment'] = $wm_hor_alignment; /* left, center, right */
		$config['wm_vrt_alignment'] = $wm_vrt_alignment; /* top, middle, bottom */
		$config['wm_hor_offset'] = $wm_hor_offset; /* addu - left*/
		$config['wm_vrt_offset'] = $wm_vrt_offset; /* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}
}
