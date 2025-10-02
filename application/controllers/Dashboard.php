<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		/* var_dump($this->session->userdata());exit; */
		if ($this->session->userdata('is_admin_login') != true) {
			redirect(ADMIN_URL . 'login');
		}
		$this->user_id = $this->session->userdata('admin_user_id');
		$this->load->model('admin/mdl_dashboard');
		$this->load->model('admin/mdl_application');
		$this->load->model('admin/mdl_teleusersales');
		$this->packageName = "com.freefestivalpost.freefestivalpost";
		$this->load->helper('common');
		$this->load->helper('array_group_by');
		/* clear_cache(); */
	}

	public function index() {
		/* $this->mdl_teleusersales->getTelesalesAllCounter($this->user_id); */
		/* daily make post remove after 4 days */
		/* $this->deleteDaysAfterRemoveUserPost(); */
		/* daily user check paid or not and status update isPaid */
		/* $this->userCheckPaidOrStatusChange(); */
		if (in_array($this->session->userdata('role_code'),array(ROLE_ADMIN_CODE,ROLE_SUB_ADMIN_CODE))) {
			/* $this->mdl_dashboard->getSMSOtpCount();exit; */
			$data['data'] = array(
				'totalUser'=>$this->mdl_dashboard->totalUser(),
				'videoanalytics'=>$this->mdl_dashboard->videoanalytics(),
				'videoanalyticsToday'=>$this->mdl_dashboard->videoanalyticsToday(),
				'totalDeactiveUser'=>$this->mdl_dashboard->totalDeactiveUser(),
				'totalTodayNewUser'=>$this->mdl_dashboard->totalTodayNewUser(),
				'totalUserPost'=>$this->mdl_dashboard->totalUserPost(),
				'totalUserPostToday'=>$this->mdl_dashboard->totalUserPostToday(),
				'totalTamplate'=>$this->mdl_dashboard->totalTamplate(),
				'totalPositione'=>$this->mdl_dashboard->totalPositione(),
				'totalCategory'=>$this->mdl_dashboard->totalCategory(),
				'totalTamplateCategoryWise'=>$this->mdl_dashboard->totalTamplateCategoryWise(),
				'totalPhotoCategoryWise'=>$this->mdl_dashboard->totalPhotoCategoryWise(),
				'todayFestivalPostList'=>$this->mdl_dashboard->todayFestivalPostList(),
				'upComingFestivalPostList'=>$this->mdl_dashboard->upComingFestivalPostList(),
				'upcominglist'=>$this->mdl_dashboard->getUpComingEventtList(),
				'videoanalyticsLast7Days'=>$this->mdl_dashboard->getVideoAnalyticsLastDays(),
				'versionwiseUserCount'=>$this->mdl_dashboard->getVersionWiseAppUserCount(),
				/* 'analytics' => $this->mdl_application->analyticsByPackageName($this->packageName), */
				'totalPremiumUser'=>$this->mdl_dashboard->totalPremiumUser(),
				'totalTrialUser'=>$this->mdl_dashboard->totalTrialUser(),
				/* 'totalExpirePckduser'=>$this->mdl_dashboard->totalExpirePckduser(), */
				'todayPaidSubscriptionUser'=>$this->mdl_dashboard->getTodayPaidSubscriptionUser(),
				'todayTrialSubscriptionUser'=>$this->mdl_dashboard->getTodayTrialSubscriptionUser(),
				'customReport'=>$this->mdl_dashboard->getCustomReport(),
				'smsOtpCountDateWise'=>$this->mdl_dashboard->getSMSOtpCount(),
				'croneReportFetch'=>$this->mdl_dashboard->getCroneReportFetch(),
				/* 'totalRevenueTillDate' => $this->mdl_dashboard->totalRevenuTillDate() */
			);
			
			$data['middle'] = 'admin/dashboard';
			$this->load->view('admin/template', $data);
		}else if($this->session->userdata('role_code') == ROLE_TELESALES_CODE){
			$promoData = $this->mdl_teleusersales->getPromoCodeData();
			$PromoCodeData = array_group_by($promoData, 'expdate');
			/* print_r($PromoCodeData);exit; */
			$queryData = $this->mdl_teleusersales->getPlanExpiredData();
			$planExpiredData = array_group_by($queryData, 'expdate');
			$data['data'] = array(
				'allTeleSalesOverView' => $this->mdl_teleusersales->getTeleSalesOverView($this->user_id),
				'todayRegisterUser' => $this->mdl_teleusersales->getTodayRegisterUser(),
				'telesalesAllCounter' => $this->mdl_teleusersales->getTelesalesAllCounter($this->user_id),
				'planExpiredData' => $planExpiredData,
				'promoCodeData' => $PromoCodeData,
			);
			$data['middle'] = 'admin/teleusersales/dashboard';
			$this->load->view('admin/template', $data);
		}
	}
	/* public function deleteDaysAfterRemoveUserPost()
    {
		$days_ago = date('Y-m-d', strtotime('-' . 7 . ' days', strtotime(ONLY_DATE)));
		$this->db->select('post_id,post');
		$this->db->where('created_at <=', $days_ago);
		$data = $this->db->get('makepost');
		$result = $data->result_array();
		$totalDeleteRecord = 0 ;
		foreach ($result as $key => $value) {
			$filestring = PUBPATH . "media/upload/" . $value['post'];
			if (file_exists($filestring)) {
				unlink($filestring);
			}
			$this->db->where('post_id', $value['post_id']);
			$this->db->delete('makepost');
			$deleterecord = $this->db->affected_rows(); 
			$totalDeleteRecord = $totalDeleteRecord + $deleterecord;
		}
		$totalPost = getOptionValue('totalpost');
		$totalPost = $totalPost + $totalDeleteRecord;
		$update = ["value"=>$totalPost];
		$this->db->where('option_name','totalpost');
		$this->db->update('setting', $update);
    }
	public function userCheckPaidOrStatusChange()
    {
		$useris = $this->db->select('id,ispaid,expdate')->where('ispaid', 1)->get("admin");
		$tampDatas = $useris->result_array();
		foreach($tampDatas as $tampData){
			$expdate = $tampData['expdate'];
			if($expdate!="" && $expdate!="0000-00-00"){
				if ($expdate < ONLY_DATE){
					$ispaidUpdate = array(
						'ispaid' => '0',
						
					);
					$this->db->where('id', $tampData['id']);
					$this->db->update('admin', $ispaidUpdate);
				}
			}
		}

    } */

}
