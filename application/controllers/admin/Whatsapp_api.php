<?php
class Whatsapp_api
{
	function __construct()
	{
		$this->obj = &get_instance();
		//$this->obj->load("sms_helper");
	}

	/* not use anywere */
	/* media whatsapp tamplate */
	function send_media_whatsapp_temp($mobile,$tamp_name,$paramiter){
		$query = $this->obj->db->where('template', $tamp_name)->get('whatsapp_template');
		if ($query->num_rows() > 0) {
			$tampData = $query->row_array();
			
			$mobileCode = "91".$mobile;
			$language = $tampData['lang'];
			$img_url = $tampData['media'];
			/* switch ($tamp_name) {
				case "payment_failed_link":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235587payment-error1png.png";
					break;
				case "review_thank_you":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235554feedback1png.png";
					break;
				case "branding_app_p1":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/168923552180-Off-Banner3png.png";
					break;
				case "register_after_welcome":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235676welcome1png.png";
					break;
				case "trial_expire_soon_notification":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235618promo-code-expirepng.png";
					break;
				case "plan_expire_soon_notification":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235642subscription-exp1png.png";
					break;
				case "subscription_buy_done_notification":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/1689235655Thank-you-for-subscriptionpng.png";
					break;
				case "trial_expired_renew":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/168923550680-Off-Banner2png.png";
					break;  
				case "plan_expired_renew":
					$img_url = "https://freefestivalpost.in/media/whatsappmedia/168923552180-Off-Banner3png.png";
					break;  
				default:
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
								{
									"type": "image",
									"image": {
										"link": "'.$img_url.'"
									}
								}
							]
						},
						'.$paramiter.'
					]
				}
			}';
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				/* echo "cURL Error #:" . $err; */
			} else {
				$this->log_whatsApp_send_API($mobile,$tampData['wtemp_id'],$tampData['type']);
				/* echo $response; */
			}
		}
	}
	
	/* media whatsapp direct message (not template) */
	function send_media_whatsapp_direct($mobile,$message){

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
		/* print_r($headers);exit; */
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
	}

	function log_whatsApp_send_API($mobile,$temp_id,$temp_type){
		$data = array(
			'mobile' => $mobile,
			'tamp_name' => $temp_id,
			'status' => 1,
			'tamp_type' => $temp_type,
			'created_at' => CURRENT_DATE,
		);
		$this->obj->db->insert('whatsapp_logs', $data);
	}
}