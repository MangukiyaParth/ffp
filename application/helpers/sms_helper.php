<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function getSmsGatewayType() {
	$CI = get_instance();
	return $CI->mdl_setting->getValueByOption('sms_gateway_type');
}

function bulkSmsGateWay($number, $message, $template_id) {
	$username = "ffpsms@panel";
	$password = "fDgGx5@0x316A.,";
	$sender = "BRFOTO";
	if(strlen($number) == 12){
		$number = substr($number, 2);
	}
	$url = "http://api.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".$message."&type=".urlencode('3')."&template_id=".urlencode($template_id);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch); 
	return true;
}

function msg91sms($mobile, $template_id, $var1, $var2, $var3) {
	$curl = curl_init();
	$senderID = "BRFOTO";
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://control.msg91.com/api/v5/flow/",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\"template_id\":\"$template_id\",\"sender\":\"$senderID\",\"short_url\":\"0\",\"mobiles\":\"$mobile\",\"var1\":\"$var1\",\"var2\":\"$var2\",\"var3\":\"$var3\"}",
		CURLOPT_HTTPHEADER => [
			"accept: application/json",
			"authkey: 394115Am2eyNc3i642e5bdcP1",
			"content-type: application/json"
		],
	]);
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	
	/* if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	} */
	return true;
}

function msg91otp($mobile, $template_id, $otp, $sshcode) {
	$curl = curl_init();
	$url = "https://control.msg91.com/api/v5/otp?template_id=".$template_id."&mobile=".$mobile;
	$par1 = "{\"OTP\":\"$otp\",\"var\":\"$sshcode\"}";
	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $par1,
		CURLOPT_HTTPHEADER => [
			"accept: application/json",
			"authkey: 394115Am2eyNc3i642e5bdcP1",
			"content-type: application/json"
		],
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	/* if ($err) {
		$ret = "cURL Error #:" . $err;
	} else {
		$ret = $response;
	} */
	return true;
}

function windexotp($mobile, $message, $template_id) {
	$authKey = "3532704031323335373672";
	$senderId = "BRFOTO";
	$route = "2";
	$contryCode = "91";
	$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobile,
		'message' => $message,
		'sender' => $senderId,
		'route' => $route,
		'country' => $contryCode,
		'DLT_TE_ID' => $template_id,
	);

	/* API URL */
	$url="http://mylogin.windexsms.com/api/sendhttp.php";

	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		/*,CURLOPT_FOLLOWLOCATION => true */
	));

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$output = curl_exec($ch);

	if(curl_errno($ch)){
		echo 'error:' . curl_error($ch);
	}
	curl_close($ch);
	return $output;
}

function windexsms($mobile, $message, $template_id) {
	$authKey = "3532704031323335373672";
	$senderId = "BRFOTO";
	$route = "2";
	$contryCode = "91";

	$postData = array(
		'authkey' => $authKey,
		'mobiles' => $mobile,
		'message' => $message,
		'sender' => $senderId,
		'route' => $route,
		'country' => $contryCode,
		'DLT_TE_ID' => $template_id,
	);

	$url = "http://mylogin.windexsms.com/api/sendhttp.php";
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData
		/*,CURLOPT_FOLLOWLOCATION => true */
	));

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$output = curl_exec($ch);
	if(curl_errno($ch)){
		echo 'error:' . curl_error($ch);
	}
	curl_close($ch);
	return $output;
}

if (!function_exists('send_sms_other')) {
	function send_sms_other($mobile,$tamplate,$term) {
		if($mobile != "" && $tamplate != ""){
			$ci = get_instance();
			$query = $ci->db->select('*')
				->where('role', 1)
				->where('mobile', $mobile)
				->limit(1)
				->get('admin');
			$userResult = $query->row_array();
			$userName = $userResult['business_name'];	
			$activated = date('d/m/Y', strtotime(ONLY_DATE));
			$expired = ($userResult['expdate']!="" && $userResult['expdate']!="0000-00-00")?date('d/m/Y', strtotime($userResult['expdate'])):"";
			$term = $term." Month";
			$youtubelink = "http://m.9m.io/ktcri0i";
			$email_tamp_name = "";
			$email_var1 = "";
			$email_var2 = "";
			$email_var3 = "";

			$DLT_TE_ID = '';
			$message = '';
			$msg91_tamp_id = "";
			$var1 = "";
			$var2 = "";
			$var3 = "";

			$whatsAppTempName = "";
			switch ($tamplate) {
				case "thanks":
					/* Thank you feedback SMS */
					$message = "Thank you so much for sharing your experience with us. We hope to see you again soon. - BRANDFOTOS TEAM";
					$DLT_TE_ID = "1207167772869621156";
					$msg91_tamp_id = "6433ab65d6fc0504996d7064";

					$email_tamp_name = "";
					$email_var2 = "";
					$whatsAppTempName = "review_thank_you";
					break;
				case "planexpired":
					/* FFP Plan Expired */
					$message = "Hello, ".$userName."! Your BRANDFOTOS plan has expired, please renew now. Thank you - BRANDFOTOS TEAM";
					$DLT_TE_ID = "1207167772881254683";
					$msg91_tamp_id = "6433abe2d6fc0552c92d1dc2";
					$var1 = $userName;

					$email_tamp_name = "";
					$email_var2 = "";
					$email_var3 = "";
					$whatsAppTempName = "plan_expired_renew";
					break;
				case "welcome":
					/* Welcome Message - Register Tim */
					$message = "Welcome to BRAND FOTOS! We're thrilled to have you on board. Click here to know how to use Brand Fotos. ".$youtubelink;
					$DLT_TE_ID = "1207168239890783241";
					
					$msg91_tamp_id = "6464a401d6fc0532ae5038e2";
					$var1 = $youtubelink;
					
					$email_tamp_name = "AfterRegister";
					$email_var2 = "";
					$email_var3 = "";
					
					$whatsAppTempName = "welcome_message_with_catalogue";
					break;
				case "buy":
					/* Subscription Plan Buy Time */
					$message = "Thank you for your subscription on BRANDFOTOS, now your plan is activated. \n Plan term:".$term.", \n Activated: ".$activated.", \n Expired: ".$expired."";
					$DLT_TE_ID = "1207167772877783794";
					$msg91_tamp_id = "6433abc7d6fc0519a7397a52";
					$var1 = $term;
					$var2 = $activated;
					$var3 = $expired;

					$email_tamp_name = "";
					$email_var2 = "";
					$email_var3 = "";
					$whatsAppTempName = "subscription_buy_done_notification";
					break;
				case "expiredafter":
					/* FFP Plan Expired - Some Days */
					$message = "Hello, ".$userName.", your BRANDFOTOS plan will be due for renewal on ".$expired.". You may renew your plan by visiting the app.";
					$DLT_TE_ID = "1207167772886315871";
					$msg91_tamp_id = "6433ac11d6fc051b79721202";
					$var1 = $userName;
					$var2 = $expired;

					$email_tamp_name = "";
					$email_var2 = "";
					$email_var3 = "";
					$whatsAppTempName = "plan_expire_soon_notification";
					break;
				case "trial":
					/* Trial Plan Expired - Time */
					$message = "Hello, ".$userName.", your BRANDFOTOS Trial has expired. You may renew your plan by visiting the app. - BRANDFOTOS TEAM";
					$DLT_TE_ID = "1207167772890622796";
					$msg91_tamp_id = "6433ac30d6fc053a7c3b3a93";
					$var1 = $userName;

					$email_tamp_name = "";
					$email_var2 = "";
					$email_var3 = "";
					break;
					$whatsAppTempName = "trial_expired_renew";
				default:
					$DLT_TE_ID = '';
					$message = '';
					$msg91_tamp_id = "";
					$var1 = "";
					$var2 = "";
					$var3 = "";
			}
			if(getSmsGatewayType() == 'bulksms') {
				$msg = urlencode($message);
				bulkSmsGateWay($mobile, $msg, $DLT_TE_ID);
				return true;
			} elseif(getSmsGatewayType() == 'msg91') {
				/* only sms send */
				msg91sms("91".$mobile,$msg91_tamp_id,$var1, $var2, $var3);
				return true;
			}elseif(getSmsGatewayType() == 'windex') {
				windexsms($mobile,$message,$DLT_TE_ID);
				return true;
			}
			if($userResult['b_email'] !="" && $email_tamp_name !=""){
				$email_var1 = $userResult['business_name'];
				send_email($userResult['b_email'],$email_tamp_name,$email_var1,$email_var2,$email_var3);
			}
			/* sms_helper */
			set_whatsapp_api_tamplate($mobile,$whatsAppTempName,$userName,$expired,$term,1,"auto");
			if($whatsAppTempName=="welcome_message_with_catalogue"){
				set_whatsapp_api_tamplate($mobile,"social_media_follow_like_share_subscribe_1",$userName,$expired,$term,1,"auto");
			}
		}
	}
}

if (!function_exists('send_sms1')) {
	function send_sms1($mobile,$otp,$tamplate,$contryCode,$sshcode) {
		if($mobile != "" && $tamplate != "" && $otp != "" ){
			$DLT_TE_ID = '';
			$message = '';
			$msg91_tamp_id = '643a93fdd6fc05019a28d362';
			if($tamplate == 'signup'){
				$message = "# ".$otp." is OTP for your BRANDFOTOS for Register OTP valid for 2 minutes. - BRANDFOTOS \n ".$sshcode;
				$DLT_TE_ID = '1207168147888232182';
				$msg91_tamp_id = "643a93fdd6fc05019a28d362";
			}else if($tamplate == 'forgotpassword'){
				$message = "# ".$otp." is OTP for your BRANDFOTOS for Forgot Password OTP valid for 2 minutes. - BRANDFOTOS \n ".$sshcode;
				$DLT_TE_ID = '1207167772862010277';
				$msg91_tamp_id = "642fa6d3d6fc05492c38c074";
			} else if($tamplate == 'admin_login_otp') {
				$message = "# ".$otp." is OTP for your BRANDFOTOS for Register OTP valid for 2 minutes. - BRANDFOTOS \n ".$sshcode;
				$DLT_TE_ID = '1207168147888232182';
				$msg91_tamp_id = "643a93fdd6fc05019a28d362";
			}
			
			if(getSmsGatewayType() == 'bulksms') {
				$msg = urlencode($message);
				bulkSmsGateWay($mobile, $msg, $DLT_TE_ID);
				return true;
			}elseif(getSmsGatewayType() == 'msg91') {
				/* only otp send */
				msg91otp($mobile,$msg91_tamp_id, $otp, $sshcode);
				return true;
			}elseif(getSmsGatewayType() == 'windex') {
				windexotp($mobile,$message,$DLT_TE_ID);
				return true;
			}
		}
	}
}

/* msg91 email */
function send_email($email,$tamp_name,$var1,$var2,$var3) {

	/* $curl = curl_init();
	
	$url = "https://control.msg91.com/api/v5/email/send";
	$par1 = "{\"to\":[{\"name\":\"$var1\",\"email\":\"$email\"}],\"from\":{\"name\":\"BrandFotos Support\",\"email\":\"support@brandfotos.com\"},\"domain\":\"mail.brandfotos.com\",\"in_reply_to\":\"support@brandfotos.com\",\"reply_to\":[{\"email\":\"support@brandfotos.com\"}],\"template_id\":\"$tamp_name\",\"variables\":{\"VAR1\":\"$var1\",\"VAR2\":\"$var2\",\"VAR3\":\"$var3\"}}";

	curl_setopt_array($curl, [
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $par1,
		CURLOPT_HTTPHEADER => [
			"accept: application/json",
			"authkey: 394115Am2eyNc3i642e5bdcP1",
			"content-type: application/json"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl); */
	/* if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	} */
}


/* whatsapp msg send using whatsapp business api */
if (!function_exists('set_whatsapp_api_tamplate')) {
	function set_whatsapp_api_tamplate($mobile,$tamp_name,$userName,$expired,$team,$cam_id,$auto) {
		if($mobile != "" && $tamp_name != ""){
			$ci = get_instance();
			$activated = date('d/m/Y', strtotime(ONLY_DATE));
			$sub = '{
				"type": "text",
				"text": ""
			}';

			$FESTIVALNAME = getOptionValue('festival_name');
			$FESTIVALNAME = ($FESTIVALNAME!="")?$FESTIVALNAME:"ये फेस्टिवल";

			$parm1 = "";
			$parm2 = "";
			$parm3 = "";
			$parm4 = "";
			$parm5 = "";
			$parm6 = "";
			switch ($tamp_name) {
				case "review_thank_you":
					$parm1 = SUPPORT_MOBILE;
					$parm2 = SUPPORT_EMAIL;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "welcome_message_with_catalogue":
				case "mar_temp_1_eng":
				case "mar_temp_2_eng":
					$parm1 = ($userName!="")?$userName:"User";
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					}';
					break;	
				case "register_after_welcome":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = YOUTUBEURL;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "trial_expire_soon_notification":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $expired;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "trial_expired_renew":
				case "plan_expired_renew":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $expired;
					$parm3 = OFFER;
					$parm4 = APP_SHORT_URL;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					},
					{
						"type": "text",
						"text": "'.$parm4.'"
					}';
					break;
				case "plan_expire_soon_notification":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $expired;
					$parm3 = OFFER;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					}';
					break;	
				case "subscription_buy_done_notification":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $team;
					$parm3 = $activated;
					$parm4 = $expired;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					},
					{
						"type": "text",
						"text": "'.$parm4.'"
					}';
					break;
				case "app_catalogue_pdf_short":
					break;
				case "app_catalogue_pdf":
				case "mar_temp_1_hindi":
				case "info_common_temp_1":
				case "info_common_temp_2":
				case "first_pemission_yes_no_posts_videos":
					$parm1 = ($userName!="")?$userName:"User";
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					}';
					break;
				case "mar_festi_1_hi":
					$parm1 = $FESTIVALNAME;
					$parm2 = $parm1;
					$parm3 = OFFER2;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					}';
					break;
				case "mar_festi_2_eng":
					$parm1 = $FESTIVALNAME;
					$parm2 = ($userName!="")?$userName:"aapke business";
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "mar_temp_3_eng":
				case "payment_page_visit_but_not_payment_done_2":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $parm1;
					$parm3 = OFFER1;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					}';
					break;
				case "mar_temp_4_eng":
					$parm1 = OFFER1;
					$parm2 = $parm1;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "payment_page_visit_but_not_payment_done_1":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $FESTIVALNAME;
					$parm3 = $parm1;
					$parm4 = OFFER1;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					},
					{
						"type": "text",
						"text": "'.$parm4.'"
					}';
					break;
				case "social_media_follow_like_share_subscribe_1":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = "https://www.facebook.com/brandfotos.official";
					$parm3 = "https://www.instagram.com/brandfotos.official/";
					$parm4 = "https://www.youtube.com/playlist?list=PLuulWFm02xp73hWXbTXKnuPRLAOlSX9e0";
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					},
					{
						"type": "text",
						"text": "'.$parm4.'"
					}';
					break;
				case "branding_app_p1":
					$parm1 = YOUTUBEURL;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					}';
					break;
				case "festival_common_temp_1":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = $FESTIVALNAME;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "festival_common_temp_2":
					$parm1 = ($userName!="")?$userName:"User";
					$parm2 = "Annual Premium Plan 999/-";
					$parm3 = "799/- / Year";
					$parm4 = $FESTIVALNAME;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					},
					{
						"type": "text",
						"text": "'.$parm4.'"
					}';
					break;
				case "festival_common_temp_3":
					$parm1 = $FESTIVALNAME;
					$parm2 = $FESTIVALNAME;
					$parm3 = OFFER2;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					},
					{
						"type": "text",
						"text": "'.$parm3.'"
					}';
					break;
				case "festival_common_temp_4":
					$parm1 = $FESTIVALNAME;
					$parm2 = OFFER2;
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					},
					{
						"type": "text",
						"text": "'.$parm2.'"
					}';
					break;
				case "info_common_temp_3":
					$parm1 = ($userName!="")?$userName:"Your Business";
					$sub = '{
						"type": "text",
						"text": "'.$parm1.'"
					}';
					break;
				default:
			}
			$paramiter = '{
				"type": "body",
				"parameters": [
					'.$sub.'
				]
			}';
			/* print_r($paramiter);exit; */
			/* Whatsapp_api libraries */
			$ci->whatsapp_api->send_media_whatsapp_temp($mobile,$tamp_name,$paramiter,$cam_id,$auto);
		}
	}
}
