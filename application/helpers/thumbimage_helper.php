<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
if (!function_exists('createThumbResize')) {
	function createThumbResize($filename,$newPath) {
		$CI = get_instance();
		
		/* $newPath = "media/photo/";
		$exitsImagePath = realpath($newPath); */

		if($filename !="" && $newPath !=""){

			$exitsImagePath = PUBPATH.$newPath.$filename;
			$newPath = $newPath."thumb/";

			if(!is_dir($newPath)){
				mkdir($newPath);
			}

			if (file_exists($exitsImagePath)) {
				$finalDestinationPath = $newPath.$filename;
				$copied = copy($exitsImagePath, $finalDestinationPath);
				if ((!$copied)) {
					return false;
				} else {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $finalDestinationPath; 
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 250;
					$config['height'] = 250;
					$config['wm_type'] = 'overlay'; 
					$config['quality'] = 100;
					$CI->image_lib->initialize($config);
					if (!$CI->image_lib->resize()) {
						return $CI->image_lib->display_errors();
					}
				}
			}
		}

	}
}

if (!function_exists('createThumbResizeOnlyPlan')) {
	function createThumbResizeOnlyPlan($filename,$newPath) {
		$CI = get_instance();
		
		/* $newPath = "media/photo/";
		$exitsImagePath = realpath($newPath); */

		if($filename !="" && $newPath !=""){

			$exitsImagePath = PUBPATH.$newPath.$filename;
			$newPath = "media/template/plan/thumb/";

			/* if(!is_dir($newPath)){
				mkdir($newPath);
			} */

			if (file_exists($exitsImagePath)) {
				$finalDestinationPath = $newPath.$filename;
				$copied = copy($exitsImagePath, $finalDestinationPath);
				if ((!$copied)) {
					return false;
				} else {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $finalDestinationPath; 
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 250;
					$config['height'] = 250;
					$config['wm_type'] = 'overlay'; 
					$config['quality'] = 100;
					$CI->image_lib->initialize($config);
					if (!$CI->image_lib->resize()) {
						return $CI->image_lib->display_errors();
					}
				}
			}
		}

	}
}