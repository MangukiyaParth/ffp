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
		$this->load->model('admin/mdl_makepost');
		$this->load->model('admin/mdl_tamplate');
		$this->load->model('admin/mdl_userpost');
	}
	function index()
	{
		$this->load->view('demo', array('errors' => ' ', 'name' => ''));
	}

	function makePost($tamplateId, $userId)
	{
		echo 'helllo';
		exit;
		if ($tamplateId != "" && $userId != "") {
			$business_name = "";
			$business_logo = "";
			/* 
			top-left
			top-center
			top-right
			middle-center
			bottom-left
			bottom-center
			bottom-right
			*/
			$business_email = "";
			/* 
			top-left
			top-center
			top-right
			bottom-left
			bottom-center
			bottom-right
			*/
			$business_mobile = "";
			/* 
			top-left
			top-center
			top-right
			bottom-left
			bottom-center
			bottom-right
			*/
			$business_website = "";
			/* 
			top-left
			top-center
			top-right
			bottom-left
			bottom-center
			bottom-right
			*/
			$business_address = "";
			/* 
			bottom-left
			bottom-center
			bottom-right
			*/
			/* $tamplateId = "1"; */
			/* $UserId = "4"; */
			$tamplateName = "";
			$logo_position = "";
			$logo_top = "";
			$logo_left = "";
			$fontName = "";
			$fontSize = "";
			$fontColor = "";
			$mobile_p = "";
			$website_p = "";
			$email_p = "";
			$address_p = "";
			$tamplate_result = $this->mdl_tamplate->getTamplateById($tamplateId);
			/* print_r($tamplate_result);
			exit; */

			if ($tamplate_result) {
				$tamplateName = $tamplate_result['path'];
				$logo_position = $tamplate_result['logo_position'];
				$logo_top = $tamplate_result['logo_top'];
				$logo_left = $tamplate_result['logo_left'];
				$fontName = $tamplate_result['font_type'];
				$fontSize = $tamplate_result['font_size'];
				$fontColor = $tamplate_result['font_color'];
				$mobile_p = $tamplate_result['mobile_p'];
				$website_p = $tamplate_result['website_p'];
				$email_p = $tamplate_result['email_p'];
				$address_p = $tamplate_result['address_p'];
			} else {
				echo "tamplate not found";
				exit;
				redirect(base_url() . "admin/dashboard");
			}

			$result = $this->mdl_makepost->getUserData($userId);
			/* print_r($result);
			exit; */
			if ($result) {
				$business_name = $result['name'];
				$business_logo = $result['photo'];
				$business_email = $result['b_email'];
				if ($result['b_mobile2'] != "") {
					$business_mobile = "+91 " . $result['mobile'] . ' / ' . "+91 " . $result['b_mobile2'];
				} else {
					$business_mobile = "+91 " . $result['mobile'];
				}
				$business_website = $result['b_website'];
				$business_address = $result['address'];


				/* print_r($result['id']);
				exit; */
				$userNewFileName = $this->MyCopy($tamplateName, $tamplateId, $userId);
				if ($userNewFileName != false) {
					$tamplate_path = realpath("media/upload/" . $userNewFileName);
					if ($business_email != "") {
						/* email */
						$this->textEmail($tamplate_path, $business_email, $fontName, $fontSize, $fontColor, $email_p);
					}

					if ($business_mobile != "") {
						/* mobile */
						$this->textMobile($tamplate_path, $business_mobile, $fontName, $fontSize, $fontColor, $mobile_p);
					}

					if ($business_address != "") {

						/* address */
						$this->textAddress($tamplate_path, $business_address, $fontName, $fontSize, $fontColor, $address_p);
					}

					if ($business_website != "") {
						/* website */
						$this->textWebsite($tamplate_path, $business_website, $fontName, $fontSize, $fontColor, $website_p);
					}

					if ($business_logo != "") {
						/* logo */
						$this->userLogo($tamplate_path, $business_logo, $logo_position, $logo_top, $logo_left);
					}
					/* dataase insert data in makePost table */

					$this->mdl_userpost->addUserPost($userNewFileName, $userId, $tamplateId);
				}

				$this->session->set_userdata(array(
					'name' => $userNewFileName,
				));

				redirect(base_url() . "makePost");
			} else {
				echo "user not found";
				exit;
				redirect(base_url() . "makePost");
			}
		} else {
			redirect(base_url() . "makePost");
		}
	}


	public function textEmail($tamplate_path, $business_email, $fontName, $fontSize, $fontColor, $email_p)
	{
		$email_p1 = explode('_', $email_p);
		$email_position = explode('-', $email_p1[0]);

		$config['source_image'] = $tamplate_path;
		$config['wm_text'] = $business_email;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './assets/fonts/' . $fontName;
		$config['wm_font_size'] = $fontSize;
		$config['wm_font_color'] = $fontColor;
		$config['wm_vrt_alignment'] = $email_position[0];/* top, middle, bottom */
		$config['wm_hor_alignment'] = $email_position[1];/* left, center, right */
		$config['wm_hor_offset'] = $email_p1[1]; /* addu - left*/
		$config['wm_vrt_offset'] = $email_p1[2]; /* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}

	public function textMobile($tamplate_path, $business_mobile, $fontName, $fontSize, $fontColor, $mobile_p)
	{
		$mobile_p1 = explode('_', $mobile_p);
		$mobile_position = explode('-', $mobile_p1[0]);

		$config['source_image'] = $tamplate_path;
		$config['wm_text'] = $business_mobile;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './assets/fonts/' . $fontName;
		$config['wm_font_size'] = $fontSize;
		$config['wm_font_color'] = $fontColor;
		$config['wm_vrt_alignment'] = $mobile_position[0];/* top, middle, bottom */
		$config['wm_hor_alignment'] = $mobile_position[1];/* left, center, right */
		$config['wm_hor_offset'] = $mobile_p1[1]; /* addu - left*/
		$config['wm_vrt_offset'] = $mobile_p1[2]; /* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}

	public function textAddress($tamplate_path, $business_address, $fontName, $fontSize, $fontColor, $address_p)
	{
		$address_p1 = explode('_', $address_p);
		$address_position = explode('-', $address_p1[0]);

		$config['source_image'] = $tamplate_path;
		$config['wm_text'] = $business_address;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './assets/fonts/' . $fontName;
		$config['wm_font_size'] = $fontSize;
		$config['wm_font_color'] = $fontColor;
		$config['wm_vrt_alignment'] = $address_position[0];/* top, middle, bottom */
		$config['wm_hor_alignment'] = $address_position[1];/* left, center, right */
		$config['wm_hor_offset'] = $address_p1[1]; /* addu - left*/
		$config['wm_vrt_offset'] = $address_p1[2]; /* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}

	public function textWebsite($tamplate_path, $business_website, $fontName, $fontSize, $fontColor, $website_p)
	{
		$website_p1 = explode('_', $website_p);
		$website_position = explode('-', $website_p1[0]);

		$config['source_image'] = $tamplate_path;
		$config['wm_text'] = $business_website;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './assets/fonts/' . $fontName;
		$config['wm_font_size'] = $fontSize;
		$config['wm_font_color'] = $fontColor;
		$config['wm_vrt_alignment'] = $website_position[0];/* top, middle, bottom */
		$config['wm_hor_alignment'] = $website_position[1];/* left, center, right */
		$config['wm_hor_offset'] = $website_p1[1]; /* addu - left*/
		$config['wm_vrt_offset'] = $website_p1[2]; /* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}

	public function userLogo($tamplate_path, $business_logo, $logo_position, $logo_top, $logo_left)
	{
		$logo_position1 = explode('-', $logo_position);
		/* https://codeigniter.com/userguide2/libraries/image_lib.html */
		$config['image_library'] = 'gd2';
		$config['source_image'] = $tamplate_path; /* none */
		$config['create_thumb'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		/* $config['width'] = 750;
		$config['height'] = 50; */
		$config['wm_type'] = 'overlay';  /* text, overlay */
		/*$config['dynamic_output'] = 'TRUE';*/   /*TRUE/FALSE  */
		$config['wm_overlay_path'] = './media/logo/' . $business_logo;    /* the overlay image */
		$config['quality'] = 40;
		$config['padding'] = 10;
		$config['wm_opacity'] = 50;
		$config['wm_vrt_alignment'] = $logo_position1[0]; /* top, middle, bottom */
		$config['wm_hor_alignment'] = $logo_position1[1]; /* left, center, right */
		$config['wm_hor_offset'] = $logo_left; /* addu - left*/
		$config['wm_vrt_offset'] = $logo_top;/* ubbhu - top */

		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			return $this->image_lib->display_errors();
		}
	}

	public function MyCopy($filename, $tamplate, $userid)
	{
		$imagePath = realpath("media/template/" . $filename);
		$newPath = "media/upload/";
		$ext = '.jpg';
		$newFileName = time() . '_' . $tamplate . '_' . $userid . $ext;
		$newName  = $newPath . $newFileName;
		$copied = copy($imagePath, $newName);
		if ((!$copied)) {
			return false;
		} else {
			return $newFileName;
		}
	}

	public function RemoveImages($filename)
	{
		if (file_exists($filename)) {
			unlink($filename);
			return true;
		} else {
			return false;
		}
	}
}
