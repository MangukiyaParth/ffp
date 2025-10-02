<?php
class Whatsapp_api
{
	function __construct()
	{
		$this->obj = &get_instance();
		//$this->obj->load("sms_helper");
	}

	/* media whatsapp tamplate */
	function send_media_whatsapp_temp($mobile,$tamp_name,$paramiter,$cam_id,$auto){
		
			$query = $this->obj->db->where('template', $tamp_name)->get('whatsapp_template');
			if ($query->num_rows() > 0) {
				$tampData = $query->row_array();
				$mobileCode = "91".$mobile;
				$language = $tampData['lang'];
				$img_url = $tampData['media'];
				
				$allowedTemp = array("app_catalogue_pdf","app_catalogue_pdf_short","welcome_message_with_catalogue");
				if (in_array($tamp_name, $allowedTemp)) {

					/* if($tamp_name == "welcome_message_with_catalogue"){
						$response = $this->aisensy_welcome_catelogue_pdf($mobileCode);
					} */
					$parameters_type = '{
						"type": "document",
						"document": {
							"filename": "BrandFotos_Catalogue.pdf",
							"link": "'.$img_url.'"
						}
					}';
					$allowedBlankTemp = array("app_catalogue_pdf_short");
					if (in_array($tamp_name, $allowedBlankTemp)) {
						$paramiter ="";
					}
				}else{
					$allowedBlankTemp = array("info_common_quiz_1","info_common_quiz_2","info_common_quiz_3","info_common_quiz_4");
					if (in_array($tamp_name, $allowedBlankTemp)) {
						$paramiter ="";
					}else{
						$parameters_type = '{
							"type": "image",
							"image": {
								"link": "'.$img_url.'"
							}
						}';
					}
				}

				/* print_r($parameters_type);exit; */
				/*  8141631381 bulk*/
				/* if(getOptionValue('mobile81')==$auto){
					$url = "https://graph.facebook.com/v17.0/122097023072009348/messages";
				} */
				/* 8141631375 auto*/
				/* if(getOptionValue('mobile75')==$auto){
					$url = "https://graph.facebook.com/v17.0/108289462325948/messages";
				} */
				$url = "https://graph.facebook.com/v17.0/108289462325948/messages";

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_ENCODING, "");
				curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
				curl_setopt($curl, CURLOPT_TIMEOUT, 0);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($curl, CURLOPT_POST, true);

				$headers = array(
					"Authorization: Bearer ".AUTH_TOKEN,
					"Content-Type: application/json",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				$data = '{
					"messaging_product": "whatsapp",
					"recipient_type": "individual",
					"to": "'.$mobileCode.'",
					"type": "template",
					"template": {
						"name": "'.$tamp_name.'",
						"language": {
							"policy": "deterministic",
							"code": "'.$language.'"
						},
						"components": [
							{
								"type": "header",
								"parameters": [
									'.$parameters_type.'
								],
							},
							'.$paramiter.'
						]
					}
				}';
				/* curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				$response = curl_exec($curl);
				$err = curl_error($curl);
				if ($err) {
					echo "cURL Error #:" . $err;exit;
				} else {
					$this->log_whatsApp_send_API($mobile,$tampData['wtemp_id'],$cam_id,$auto,$response);
					echo "doneeee";exit;
				} */
				curl_close($curl);
			}
		/* } */
	}

	/* aisensy welcome pdf catalogue api call  */
	/* function aisensy_welcome_catelogue_pdf($mobile){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://backend.aisensy.com/campaign/t1/api',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"apiKey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY1MjAwOTdkNDg0OTA0MTUwNTFlZDNkMyIsIm5hbWUiOiJCcmFuZEZvdG9zIC0gTmV3IiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY0NmI2NTVmMmY3MzkzN2ZlZWQ2NDQ3ZCIsImFjdGl2ZVBsYW4iOiJOT05FIiwiaWF0IjoxNjk2NTk4Mzk3fQ.Ylxej4k__PIwwbbTUVer-YnCznDkBiOz96UCxWgW75w",
			"campaignName": "Welcome-Pdf-Send-Register-new",
			"destination": "'.$mobile.'",
			"userName": "Hello User",
			"templateParams": [],
			"media": {
				"url": "https://freefestivalpost.in/media/whatsappmedia/1690358483BrandFotos-catalogue-1pdf.pdf",
				"filename": "BrandFotos-Catalogue"
			}
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;
	} */

	function log_whatsApp_send_API($mobile,$temp_id,$cam_id,$auto,$response){
		$data = array(
			'cam_id' => $cam_id,
			'mobile' => $mobile,
			'tamp_name' => $temp_id,
			'status' => 1,
			'msg_type' => $auto,
			'response' => $response,
			'created_at' => date('Y-m-d H:i:s'),
		);
		/* $not_insert_mobile = array("8141631370");
		if (in_array($mobile, $not_insert_mobile)) {
		}else{
		} */
		$this->obj->db->insert('whatsapp_logs', $data);
	}

	/* media whatsapp direct message (not template) */
	/* function send_media_whatsapp_direct($mobile,$message){

		$mobileCode = "91".$mobile;

		$url = "https://graph.facebook.com/v17.0/108289462325948/messages";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_ENCODING, "");
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, 0);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POST, true);

		$headers = array(
			"Authorization: Bearer ".AUTH_TOKEN,
			"Content-Type: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$data = '{
			"messaging_product": "whatsapp",
			"recipient_type": "individual",
			"to": "'.$mobileCode.'",
			"type": "text",
			"text": {
				"preview_url": false,
				"body": "'.$message.'",
			}
		}';
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
	} */
}