<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pyments extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->userRolID = $this->session->userdata('admin_user_id');
        $this->load->model('admin/mdl_pyments');
        $this->load->model('admin/mdl_users');

        $this->load->helper('razorpay_data');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_pyments->getpaymentlist(),
            'paidButExpList' => $this->mdl_pyments->getPaidButExpList(),
            'packages' => $this->mdl_pyments->getPackageList(),
            'othernumberpayment' => $this->mdl_pyments->getListOfOtherNumPayment(),
            'paymentFaildList' => $this->mdl_pyments->getPaymentFaildList(),
        );
        /* print_r($data);exit; */
        $data['middle'] = 'admin/pyments/listpyments';
        $this->load->view('admin/template', $data);
    }


    public function trial()
    {
        $data['data'] = array(
            'trial' => $this->mdl_pyments->getTrialpaymentlist(),
            'packages' => $this->mdl_pyments->getPackageList(),
        );
        /* print_r($data);exit; */
        $data['middle'] = 'admin/pyments/trialPymentsList';
        $this->load->view('admin/template', $data);
    }


    public function getUsrData()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $dataUser = array();
        $mobile = str_replace(' ', '', $this->input->post('mobile'));
        if ($mobile != "") {

            $query = $this->db->select('*')
                ->where('mobile', $mobile)
                ->where('role', "1")
                ->get('admin');
            $dataUser = $query->row_array();

            if ($dataUser) {
                /* check lasy payment record */
                $query_payment = $this->db->select('*')
                    ->where('u_id', $dataUser['id'])
                    ->order_by('pid', 'desc')
                    ->limit(1)
                    ->get('payments');
                $dataUser1 = $query_payment->row_array();
                if ($dataUser1) {
                    $dataUser['pmonth'] = $dataUser1['pmonth'];
                    $dataUser['pstatus'] = $dataUser1['pstatus'];
                } else {
                    $dataUser['pmonth'] = "0";
                    $dataUser['pstatus'] = "";
                }
            }
            if ($dataUser) {
                $data['status'] = "success";
                $data['message'] = 'User get Successfully!....';
                $data['data'] = $dataUser;
            } else {
                $data['status'] = "error";
                $data['message'] = 'User data not found...';
                $data['data'] = array();
            }
        } else {
            $data['status'] = "error";
            $data['message'] = 'Some field are required!...';
            $data['data'] = array();
        }
        echo json_encode($data);
    }
    public function userSubPaymentHistory()
	{
        /* if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } */
		$data = array();
		$user_id = $this->input->post('userid');
		$ptransactionid = $this->input->post('transationid');
		$packageid = $this->input->post('select_plan');
		$buyDate = $this->input->post('buyDate');
		$freeDays = $this->input->post('freeDays');
        if ($user_id != "") {
            if ($packageid != "" && $ptransactionid != "") {

                /* user ne free krva mate by admin */
                $ref_status = 0;
                /* get package month and calculate expire date */
                $query = $this->db->select('*')
                    ->where('plan_id', $packageid)
                    ->get('subscriptionPlan');
                $res = $query->row_array();

                /* user e trile use kru ke ny te check krva */
                $query = $this->db->select('pid')
                    ->where('u_id', $user_id)
                    ->get('payments');
                $countPlann = $query->num_rows();

               /*  if($countPlann > 0 && $res['month']==0){
                    $data['status'] = "error";
                    $data['message'] = 'Sorry, You are not eligible for a trial plan. Thank you';
                    $data['data'] = array();
                } else { */
                    /* user no plan active che ke ny te check krva - jo  active hoy to e exp date ma atla day add krva */
					$isCheckPaidDateAdd = $this->db->select('*')
					->where('id', $user_id)
					->limit(1)
					->get('admin');
					$countPlan = $isCheckPaidDateAdd->row_array();
					
					if($res['month'] == 0){
                        if($freeDays !="" && $freeDays > 0){
                            $month = '+'.$freeDays.' days';
                        }else{
                            $month = '+3 days';
                        }
                        $ptransactionid = "";
					}else{
						$month = '+'.$res['month']." months";
					}

					if($countPlan['planStatus']==2 && $countPlan['ispaid'] ==1 && $countPlan['expdate'] > ONLY_DATE){
						/* user plan active che */
						$pexpdate = date("Y-m-d", strtotime($month, strtotime($countPlan['expdate'])));
					}else{
						$pexpdate = date("Y-m-d", strtotime($month, strtotime($buyDate)));
					}

                    /* user ispaid status update */
                    $cstomStatus ="";
					if($res['month']>0){
						/* paid */
						$cstomStatus = 2;
                        /* paymentlink remove if avalable */
					    $this->db->where("mobile",$countPlan['mobile'])->delete('payment_link');
					}else{
                        
						/* trial */
						$cstomStatus = 1;
					}
                    $ispaidUpdate = array(
                        'ispaid' => '1',
                        'expdate' => $pexpdate,
                        'planStatus' => $cstomStatus,
                        'status' => '1',
                    );
                    $this->db->where('id', $user_id);
                    $this->db->update('admin', $ispaidUpdate);

                    /* log - menually payment add customer */
                    /*  $menuallyPaymUser = array(
                        'userID' => $user_id,
                        'createdBY' => $this->session->userdata('email'),
                        'createdAt' => CURRENT_DATE,
                    );
                    $this->db->insert('payments', $menuallyPaymUser); */

                    $SubPayInsert = array(
                        'u_id' => $user_id,
                        'pamount' => $res['price'],
                        'pdate' => $buyDate,
                        'ptransactionid' => $ptransactionid,
                        'pstatus' => $res['plan_name'],
                        'packageid' => $packageid,
                        'pprice' => $res['price'],
                        'pmonth' => $res['month'],
                        'ref_status' => $ref_status,
                        'userRole' => $this->userRolID,
                        'created_at' => CURRENT_DATE,
                    );

                    /* couter add */
                    $this->db->set('paidUser', 'paidUser+1', FALSE);
                    $this->db->update('counter');
                    /* couter add */
                    $this->mdl_pyments->insertUserSubPayment($SubPayInsert);
                    $data['status'] = "success";
                    $data['message'] = 'User Transaction Successfully!....';
                    $data['data'] = "";

                    /* remove failed mpayment record */
                    $this->failedRepaymentRemove($countPlan['mobile']);
                    $mobile = "+91".$countPlan['mobile'];
                    

                    /* sms send */
                    /*  $query = $this->db->select('*')
                        ->where('id', $user_id)
                        ->limit(1)
                        ->get('admin');
                        $userResult = $query->row_array();
                        send_sms_other($userResult['mobile'],"buy",$res['month']); */
                /* } */
            } else {
                $data['status'] = "error";
                $data['message'] = 'Some field are required!...';
                $data['data'] = array();
            }
        } else {
            $data['status'] = "error";
            $data['message'] = 'This User is already paid';
            $data['data'] = array();
        }

        echo json_encode($data);
    }

    public function failedRepaymentRemove($mobile)
    {
        if ($mobile != "") {
            $this->db->where('w_mobile', $mobile);
            $this->db->delete('webhook_failed');
		}
	}

    public function deleteNumPaymentUser()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');

        $this->db->where('web_auth_id', $id)->delete('webhook_authorized');

        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }


    public function refundPayment()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $user_id = $this->input->post('user_id');
        $refund_id = $this->input->post('refund_id');

        /* 
        paid user hovo joye
        constants file ma variable check karavo
        */
        if($user_id !="" && $refund_id !=""){
            /* user paid or not */
            $useris = $this->db->select('ispaid,expdate,status')->where('id', $user_id)->get("admin");
            $tampData = $useris->row_array();
            $expdate = $tampData['expdate'];
            $ispaid = $tampData['ispaid'];

            if($expdate!="" && $expdate!="0000-00-00" && $ispaid != 0){
                if ($expdate >= ONLY_DATE){
                    /* user payment transation date get */
                    $userPaymentTra = $this->db->select('pid,pdate')->where('u_id', $user_id)->order_by('pid', "DESC")->limit(1)->get("payments");
                    $tranDate = $userPaymentTra->row_array();
                    $transationDate = $tranDate['pdate'];
                    $payDay = (strtotime(ONLY_DATE) - strtotime($transationDate))/60/60/24;
                    /* if($payDay <= refundDay){ */
                        $updateAdminRefund = array(
                            'ispaid' => 0,
                            'expdate' => ONLY_DATE,
                        );
                        $this->db->where('id', $user_id);
                        $this->db->update('admin', $updateAdminRefund);

                        $updateRefund = array(
                            'pstatus' => "Refund",
                            'ref_status' => 1,
                            'refund_id' => $refund_id,
                            'refundDate' => CURRENT_DATE,
                            'userRole' => $this->userRolID,
                        );
                        $this->db->where('pid', $tranDate['pid']);
                        $this->db->update('payments', $updateRefund);
                        $data['status'] = "success";
                        $data['message'] = 'User Payment Refund Successfully!....';
                    /* }else{
                        $data['status'] = "error";
                        $data['message'] = 'You are not eligible for refund - you have your plan 10 days old, you can refund before 7 days.';
                    } */
                }else{
                    $data['status'] = "error";
                    $data['message'] = 'This user is not paid...';
                }
            }else{
                $data['status'] = "error";
                $data['message'] = 'This user is not paid...'; 
            }
        }else{
            $data['status'] = "error";
            $data['message'] = 'Some field are required!...';
        }
        
        $data['data'] = array();
        echo json_encode($data);
    }

    public function sendPaymentLinkByUser(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $user_id = $this->input->post('user_id');
        $amount = $this->input->post('amount');
        /* print_r($this->input->post());exit; */
        /* $packageId = $this->input->post('packageid'); */
        if($user_id !="" && $amount!=""){
            /* user paid or not */
            $useris = $this->db->select('b_email,mobile')->where('id', $user_id)->get("admin");
            $tampData = $useris->row_array();
            $mobile = $tampData['mobile'];
            $email = $tampData['b_email'];

            /* $mobile = "8141631370";
            $email = "moradiyasandip99@gmail.com"; */
            $description = "Reference No. #".$user_id;

            $emailSend = false;
            if($email != "brandfotoss@gmail.com" && $email !=""){
                $emailSend = true;
            }

            $user_data = array(
                'token'=>tkncutm, 
                'amount'=>$amount * 100, 
                'expire_by' => strtotime("+2 days"),
                'reference_id' => "ref_".time() ."_".$user_id,
                'description' => $description,
                'name'=>"",
                'email' =>$email, 
                'contact'=>"+91".$mobile,
                'smsOn'=>true, 
                'emailOn'=>$emailSend,
                'user_id'=>$user_id,
                'type'=> "link",
                'callback_url' => "",
                'callback_method'=>"",
            );

            $this->db->select('*');
            $this->db->where('mobile',$mobile);
            $this->db->where('exp_date >',date('Y-m-d H:i:s'));
            $this->db->order_by('paylink_id',"desc")->limit(1);
            $query_link = $this->db->get('payment_link');

            $totalrows = $query_link->num_rows();
            /* print_r($totalrows);exit; */
            if($totalrows > 0){
                $totalrowsData = $query_link->row_array();
                $user_data_resend = array(
                    'token'=>tkncutm, 
                    'options'=>"sms", 
                    'paymentid'=>$totalrowsData['paymentLinkId'],
                    'link'=>$totalrowsData['link'],
					'mobile'=>$totalrowsData['mobile'],
                );
                $resultSend = paymentlinkResend($user_data_resend);
            }else{
                $resultSend = paymentLinkCreateForUser_post($user_data);
            }
            if($resultSend){
                $data['status'] = "success";
                $data['message'] = 'Payment link send successfully...'.$mobile." - ".$email;
            }else{
                $data['status'] = "error";
                $data['message'] = 'Error somethis else!...';
            }
        }else{
            $data['status'] = "error";
            $data['message'] = 'Some field are required!...';
        }
        
        echo json_encode($data);
    }
}
