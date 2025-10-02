<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('admin/mdl_auth');
		$this->load->model('admin/mdl_dbexport');
		/*sitename session start---------------*/
		$sitename = getOptionValue("sitename");
		if (empty($sitename)) {
			$sitename = "Not Found SiteName";
		}
		$this->session->set_userdata('sitename', $sitename);
		/* if ($this->session->userdata('is_admin_login') == true) {
            redirect(ADMIN_URL . 'dashboard');
            exit;
        } */
        $this->load->helper('sms_helper');
		/*sitename session stop---------------*/
	}

	/**
	 * Index Page for this controller.
	 */

	public function login()
	{
		/* echo "hello";exit; */
		/* $sessio_data = array(
			'is_admin_login' => true,
			'email' => "info@adminffp.com",
			'admin_user_id' => 1,
			'role' => 0,
			'role_code' => "ADMIN",
			'role_id' => 1
		);
		$this->session->set_userdata($sessio_data); */
		if ($this->session->userdata('is_admin_login') == true) {
            redirect(ADMIN_URL . 'dashboard');
            exit;
        } 
		if($this->uri->segment(3)=="pidnas"){
			$this->load->view('admin/login');
		}

		if($this->uri->segment(3)=="otp"){
			$this->load->view('admin/loginOtp');
		}
	}
	public function sentotp(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

		$email = $this->input->post('email');
		$password = md5($this->input->post('password') . SALT);
		$result = $this->mdl_auth->do_login($email, $password);
		if ($result == false) {
			$data['status'] = 'error';
			$data['message'] = "Invalid login details...";
		} else {

			$page = "admin_login_otp";
			$contryCode = "91";
			$mobile = $contryCode.$result[0]['mobile'];
			$otp = sprintf("%06d", mt_rand(1, 999999));
			$sshcode = "";
			if(send_sms1($mobile,$otp,$page,$contryCode,$sshcode)){
			/* if(true){ */
				$this->mdl_auth->updatePasswordByToken($email, array('otp' => $otp));
				$data['status'] = 'success';
				$data['message'] = 'OTP Send Successfully!';
				
			}else{

				$data['status'] = 'error';
				$data['message'] = 'OTP is not sent.';
			
			}
		}

		echo json_encode($data);
	}
	public function calllogin()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$result = $this->mdl_auth->do_login_otp($email, $otp);
		if ($result == false) {
			$data['status'] = 'error';
			$data['message'] = "Invalid OTP...";
		} else {
			if ($result[0]['role'] == 0) {
				$sessio_data = array(
					'is_admin_login' => true,
					'email' => $result[0]['email'],
					'admin_user_id' => $result[0]['id'],
					'role' => $result[0]['role'],
					'role_code' => $result[0]['code'],
					'role_id' => $result[0]['role_id']
				);
				$this->session->set_userdata($sessio_data);

				$this->mdl_auth->updatePasswordByToken($email, array('otp' => NULL));
			} 
			/* else {
				$this->session->set_userdata(array(
					'is_client_login' => true,
					'email' => $result[0]['email'],
					'client_user_id' => $result[0]['id'],
					'role' => $result[0]['role']
				));
			} */
			$data['status'] = 'success';
			$data['message'] = 'Successfully login !!';
			/* redirect(ADMIN_URL . 'dashboard'); */
		}
		echo json_encode($data);
	}

	/**
	 *  logout
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_userdata(array(
			'is_admin_login' => false,
			'email' => "",
			'admin_user_id' => "",
			'role' => "",
		));
		redirect(ADMIN_URL . 'login/pidnas');
	}

	public function profile()
	{
		$id = $this->session->userdata();
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|exact_length[10]', array(
			'exact_length' => 'exact 10 number.'
		));
		$this->form_validation->set_rules('name', 'name', 'trim|required', array(
			'required' => 'Name is required!....'
		));
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = array('profile' => $this->Mdl_user->getProfile($this->current_user));
			$data['middle'] = 'admin/myprofile';
			$this->load->view('admin/template', $data);
		} else {
			$update = array(
				'name' => $this->input->post('name'),
				'contact_no' => $this->input->post('mobile')
			);
			$this->Mdl_user->updateProfile($this->current_user, $update);
			$this->session->set_flashdata('success', 'Update Profile successfully.');
			echo json_encode($data);
		}
	}

	/*
	*---------------------------------------------------------------------------------------------------------
	*forgot password start
	*---------------------------------------------------------------------------------------------------------
	*/
	/* public function forgotpassword()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required', array("required" => "Enter Email", "valid_email" => "Enter Valid Email"));
		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');

			$return = $this->mdl_auth->checkEmail($email);
			if ($return == true) {
				$token = md5(time() . SALT);
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.mailtrap.io',
					'smtp_port' => 2525,
					'smtp_user' => '23029832af79e3',
					'smtp_pass' => 'b864a1c3c812bc',
					'mailtype' => 'html',
					'crlf' => "\r\n",
					'newline' => "\r\n"
				);

				$subject = "Password reset email for the admin";
				$message = "Message -> this is for the only for texting for admin password reset<br /> Password reset link is following!..<br/><a href='http://localhost/auth/reset/" . $token . "'></a>";


				$this->load->library('email', $config);

				$this->email->from('7af2434154-94832f@inbox.mailtrap.io', 'rk fashion admin dipartment');
				$this->email->to($email);

				$this->email->subject($subject);
				$this->email->message($message);

				if ($this->email->send() == true) {
					$send = "Email SuccessFully Send!...";
				} else {
					$send = $this->email->print_debugger();
				}
				$data = ["email" => $email, "token" => $token];
				$al_hav_token = $this->mdl_auth->already_have_token_by_email($email);
				if ($al_hav_token == true) {
					$this->mdl_auth->updateTokenByEmail($email, $data);
				} else {
					$this->mdl_auth->save_token_by_email($data);
				}
				$this->session->set_flashdata('success', 'SuccessFully Send Email Check The Email!...' . $email);
				redirect(ADMIN_URL . 'auth/forgotpassword');
			} else {
				$this->session->set_flashdata('error', 'Email is not Exists!....');
				redirect(ADMIN_URL . 'auth/forgotpassword');
			}
		} else {
			$this->load->view('admin/forgot_pwd');
		}
	} */

	public function checktoken($token)
	{
		if ($token == false) {
			echo "not found";
		} else {
			$check = $this->mdl_auth->token_available($token);
			if ($check == true) {
				redirect(ADMIN_URL . 'reset_password/' . $token);
			} else {
				echo "invald credinsial";
			}
		}
	}


/* 	public function reset_password($token)
	{
		$this->form_validation->set_rules('token', 'token', 'trim|required', array("required" => 'Invalid form!...'));
		$this->form_validation->set_rules('password', 'password', 'trim|required', array("required" => 'Password is required!...'));
		$this->form_validation->set_rules('conpassword', 'conpassword', 'trim|required|matches[password]', array("required" => 'Conform Password is required!...', "matches" => "password and conform pass does not matches!..."));

		if ($this->form_validation->run() == TRUE) {
			$update = ['password' => md5($this->input->post('password') . SALT)];
			$data = $this->mdl_auth->update_password_by_reset_token($token, $update);
			if ($data == true) {
				$this->session->set_flashdata('message', "Password Changes Successfully!...");
			} else {
				$this->session->set_flashdata('error', "Invalid Data!...");
				redirect(ADMIN_URL . 'reset_password/' . $token);
			}
			redirect(ADMIN_URL . 'reset_password/' . $token);
		} else {
			$this->load->view('admin/password_reset');
		}
	} */
	/*
	*--------------------------------------------------------------------------------------------------------
	*forgot password stop
	*---------------------------------------------------------------------------------------------------------
	*/
}
