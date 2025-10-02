<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('imageUpload')) {
	function imageUpload($filename, $fileinput, $redirectUrl, $foldername)
	{
		$ci = get_instance();
		$config['upload_path'] = './' . $foldername;
		$config['allowed_types'] = '*';
		/*$config['max_size'] = '5120KB';*/

		$new_name = time() . '-' . $filename;
		$config['file_name'] = $new_name;

		$ci->load->library('upload', $config);
		/* $ci->upload->initialize($config); */
		if (!$ci->upload->do_upload($fileinput)) {
			$error = $ci->upload->display_errors();
			/* print_r($error);exit; */

			$ci->session->set_flashdata('error', $error);
			redirect(ADMIN_URL . $redirectUrl);
		} else {
			$data = $ci->upload->data();
			return $data['file_name'];
		}
	}
}
