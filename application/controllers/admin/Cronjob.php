<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cronjob extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->uri->segment(4) == null || $this->uri->segment(4) != 'mycustomapi321') {
            redirect(base_url());
            exit;
        }
        $this->load->model('admin/mdl_notificationsend');
        $this->load->helper('notification_helper');
        $this->load->helper('sms_helper');
    }

    /* 
    call function list on crone with time
    morningeighitclock
    https://freefestivalpost.in/admin/Cronjob/morningeighitclock/mycustomapi321/Smaonr313ffp

    callMyFun
    https://freefestivalpost.in/admin/Cronjob/callMyFun/mycustomapi321/Smaonr313ffp

    */
    /* midd night 1 o'clock call */
    public function callMyFun($mykey,$key){
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            /* daily make post remove after 4 days */
            $this->deleteDaysAfterRemoveUserPost($mykey,$key);
            /* daily user check paid or not and status update isPaid */
            sleep(1);
            $this->userCheckPaidOrStatusChange($mykey,$key);
            sleep(1);
            /* 90 days before and paid user remove from whatsapp log*/
            $this->paidUserRemoveFromWhatsAppLog($mykey,$key);
            sleep(1);
            /* crone report remove before 30 days*/
            $this->cronReportRemove($mykey,$key);
        }
    }

    public function deleteDaysAfterRemoveUserPost($mykey,$key)
    {
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){

            /* daily user created post count and insert data */
            $this->countDailyUserPost();
            $days_ago = date('Y-m-d', strtotime('-' . 15 . ' days', strtotime(ONLY_DATE)));
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

            $data_test = array(
                'crone_funcation' =>"callMyFun",
                'crone_title' =>"before 15 days post remove",
                'crone_type' =>"delete-post",
                'crone_count' =>$totalDeleteRecord,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }

    public function userCheckPaidOrStatusChange($mykey,$key)
    {
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $useris = $this->db->select('id,ispaid,expdate')->where('ispaid', 1)->get("admin");
            $tampDatas = $useris->result_array();
            $i = 0;
            foreach($tampDatas as $tampData){
                $expdate = $tampData['expdate'];
                if($expdate!="" && $expdate!="0000-00-00"){
                    if ($expdate < ONLY_DATE){
                        /* user date expire then update ispaid status */
                        $ispaidUpdate = array(
                            'ispaid' => '0',
                            /* 'expdate' => null,
                            'planStatus' => null, */
                        );
                        $this->db->where('id', $tampData['id']);
                        $this->db->update('admin', $ispaidUpdate);
                        $i++;
                    }
                }
            }
            $data_test = array(
                'crone_funcation' =>"callMyFun",
                'crone_title' =>"expire user - update ispaid status",
                'crone_type' =>"update-paid-user",
                'crone_count' =>$i,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }

    /* 90 days before and paid user remove from whatsapp log*/
    public function paidUserRemoveFromWhatsAppLog($mykey,$key)
    {
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $days_ago = date('Y-m-d', strtotime('-' . 90 . ' days', strtotime(ONLY_DATE)));
            $this->db->select('wlog_id');
            $this->db->where("DATE(created_at) <= STR_TO_DATE('$days_ago', '%Y-%m-%d')");
            $data = $this->db->get('whatsapp_logs');

            $result = $data->result_array();
            $totalDeleteRecord = 0 ;
            /* 90 days before data remove */
            foreach ($result as $key => $value) {
                $this->db->where('wlog_id', $value['wlog_id']);
                $this->db->delete('whatsapp_logs');
                $deleterecord = $this->db->affected_rows(); 
                $totalDeleteRecord = $totalDeleteRecord + $deleterecord;
            }
            $data_test = array(
                'crone_funcation' =>"callMyFun",
                'crone_title' =>"90 days before whatsapp log remove",
                'crone_type' =>"whatsapp_log_90day_before_remove",
                'crone_count' =>$totalDeleteRecord,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);

            /* paid user remove from whatsapp log */
            $this->db->select('l.wlog_id');
            $this->db->from('whatsapp_logs as l');
            $this->db->join('admin as a','l.mobile=a.mobile','LEFT');
            $this->db->where('a.ispaid',1);
            $this->db->where('a.planStatus',2);
            $this->db->where('a.expdate !=',null);
            $this->db->where('a.role',1);
            $query = $this->db->get();
            $paidUser = $query->result_array();
            $totalPaidDelete = 0 ;
            foreach ($paidUser as $key => $value) {
                $this->db->where('wlog_id', $value['wlog_id']);
                $this->db->delete('whatsapp_logs');
                $del = $this->db->affected_rows(); 
                $totalPaidDelete = $totalPaidDelete + $del;
            }
            $data_test_paid = array(
                'crone_funcation' =>"callMyFun",
                'crone_title' =>"paid user remove from whatsapp log",
                'crone_type' =>"whatsapp_log_paid_remove",
                'crone_count' =>$totalPaidDelete,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test_paid);

        }
    }

    /* crone report remove before 30 days*/
    public function cronReportRemove($mykey,$key)
    {
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $days_ago = date('Y-m-d', strtotime('-' . 30 . ' days', strtotime(ONLY_DATE)));
            $this->db->select('crone_id');
            $this->db->where("DATE(created_at) <= STR_TO_DATE('$days_ago', '%Y-%m-%d')");
            $data = $this->db->get('crone_report');

            $result = $data->result_array();
            $totalDeleteRecord = 0 ;
            foreach ($result as $key => $value) {
                $this->db->where('crone_id', $value['crone_id']);
                $this->db->delete('crone_report');
                $deleterecord = $this->db->affected_rows(); 
                $totalDeleteRecord = $totalDeleteRecord + $deleterecord;
            }
            $data_test = array(
                'crone_funcation' =>"callMyFun",
                'crone_title' =>"crone report remove before 30",
                'crone_type' =>"crone_report_30day_before_remove",
                'crone_count' =>$totalDeleteRecord,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }

    /* 
    Daily Morning Call 10:00 Clock

    https://freefestivalpost.in/admin/Cronjob/morningeighitclock/mycustomapi321/Smaonr313ffp
    */
    public function morningeighitclock($mykey,$key){
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            /* before 1 days expire user sms and email */
            $this->beforeExpire($mykey,$key);
            sleep(2);
            $this->todayExpire($mykey,$key);
            sleep(2);
            $this->afterExpire($mykey,$key);
            sleep(2);
            $this->afterTrialExpire($mykey,$key);
        }
    }

    /* after 1 days expired user email and sms */
    public function afterExpire($mykey,$key)
    {
        /* before 1 days */
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $before_day = date('Y-m-d', strtotime('+' . 1 . ' days', strtotime(ONLY_DATE)));
            $this->db->select('business_name,mobile,b_email,expdate,ispaid,planStatus');
            $this->db->where('expdate', $before_day);
            $this->db->where('ispaid', 1);
            $this->db->where('planStatus', 2);
            /* $this->db->where('expdate >=', ONLY_DATE); */
            $data = $this->db->get('admin');
            $result = $data->result_array();
            $i = 0;
            $e = 0;
            foreach ($result as $key => $value) {
                $mobile = $value["mobile"];
                $tamplate = "expiredafter";
                //send_sms_other($mobile,$tamplate,"");
                $email = $value["b_email"];
                $tamp_name = "Before2DaysofSubscripExpired";
                $var1 = $value["business_name"];
                $var2 = "";
                $var3 = "";
                if($email !=""){
                    send_email($email,$tamp_name,$var1,$var2,$var3);
                    $e++;
                }
                $i++;
            }
            $data_test = array(
                'crone_funcation' =>"morningeighitclock",
                'crone_title' =>"after 1 days expire user SMS-Email-Whatsapp",
                'crone_type' =>"After-Email-SMS-Send",
                'crone_count' =>"SMS-".$i." Email-".$e,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }
    /* today expired user */
    public function todayExpire($mykey,$key)
    {
        /* today 1 days */
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $this->db->select('business_name,mobile,b_email,expdate,ispaid,planStatus');
            $this->db->where('expdate', ONLY_DATE);
            $this->db->where('ispaid', 1);
            $this->db->where('planStatus',2);
            $data = $this->db->get('admin');
            $result = $data->result_array();
            $i = 0;
            $e = 0;
            foreach ($result as $key => $value) {
                $mobile = $value["mobile"];
                $tamplate = "expiredafter";
                //send_sms_other($mobile,$tamplate,"");
                $email = $value["b_email"];
                $tamp_name = "Before2DaysofSubscripExpired";
                $var1 = $value["business_name"];
                $var2 = "";
                $var3 = "";
                if($email !=""){
                    send_email($email,$tamp_name,$var1,$var2,$var3);
                    $e++;
                }
                $i++;
            }
            $data_test = array(
                'crone_funcation' =>"morningeighitclock",
                'crone_title' =>"today expire user SMS-Email-Whatsapp",
                'crone_type' =>"Today-Email-SMS-Send",
                'crone_count' =>"SMS-".$i." Email-".$e,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }
     /* before 1 days expire user email and sms */
    public function beforeExpire($mykey,$key)
    {
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            /* before 1 days */
            $before_day = date('Y-m-d', strtotime('-' . 1 . ' days', strtotime(ONLY_DATE)));
            $this->db->select('business_name,mobile,b_email,expdate,ispaid,planStatus');
            $this->db->where('expdate', $before_day);
            $this->db->where('ispaid', 0);
            $this->db->where('planStatus', 2);
            /* $this->db->where('expdate <=', ONLY_DATE); */
            $data = $this->db->get('admin');
            $result = $data->result_array();
            $i = 0;
            $e = 0;
            foreach ($result as $key => $value) {
                $mobile = $value["mobile"];
                $tamplate = "planexpired";
                //send_sms_other($mobile,$tamplate,"");
                $email = $value["b_email"];
                $tamp_name = "Subscriptionexpiredemail";
                $var1 = $value["business_name"];
                $var2 = "";
                $var3 = "";
                if($email !=""){
                    send_email($email,$tamp_name,$var1,$var2,$var3);
                    $e++;
                }
                $i++;
            }
            $data_test = array(
                'crone_funcation' =>"morningeighitclock",
                'crone_title' =>"before 1 days will expired user SMS-Email-Whatsapp",
                'crone_type' =>"Before-Email-SMS-Send",
                'crone_count' =>"SMS-".$i." Email-".$e,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }

    /* after and today trial expired user email and sms */
    public function afterTrialExpire($mykey,$key)
    {
        /* after and today days */
        if($mykey=='mycustomapi321' && $key=="Smaonr313ffp"){
            $before_day = date('Y-m-d', strtotime('+' . 1 . ' days', strtotime(ONLY_DATE)));
            $this->db->select('business_name,mobile,b_email,expdate,ispaid,planStatus');
            $this->db->where('expdate', $before_day);
            $this->db->or_where('expdate', ONLY_DATE);
            $this->db->where('ispaid', 1);
            $this->db->where('planStatus', 1);
            $data = $this->db->get('admin');
            /* echo $this->db->last_query();exit; */
            $result = $data->result_array();
            $i = 0;
            $e = 0;
            foreach ($result as $key => $value) {
                $mobile = $value["mobile"];
                $tamplate = "trial";
                //send_sms_other($mobile,$tamplate,"");
                $email = $value["b_email"];
                $tamp_name = "PromoCodeExpireTime";
                $var1 = $value["business_name"];
                $var2 = "";
                $var3 = "";
                if($email !=""){
                    send_email($email,$tamp_name,$var1,$var2,$var3);
                    $e++;
                }
                $i++;
            }
            $data_test = array(
                'crone_funcation' =>"morningeighitclock",
                'crone_title' =>"after and today trile expire user SMS-Email-Whatsapp",
                'crone_type' =>"After-Email-SMS-Send",
                'crone_count' =>"SMS-".$i." Email-".$e,
                'created_at' => CURRENT_DATE,
            );
            $this->db->insert('crone_report', $data_test);
        }
    }

    public function countDailyUserPost(){

        $today = date("Y-m-d", strtotime('-60 days'));
        $this->db->where('daily_date <', $today)->delete('day_wise_created_post_video_count');

        $this->db->select('count(post_id) totalPost,created_at');
        $this->db->group_by('created_at');
        $totalDailyPost = $this->db->get('makepost');
        $totalDailyPostResult = $totalDailyPost->result_array();

        foreach($totalDailyPostResult as $ttlPost){
            $updateTotalPost = ["post_count"=>$ttlPost["totalPost"]];
            $this->db->select('dwcpost_id');
            $this->db->where('daily_date',$ttlPost["created_at"]);
            $checkExist = $this->db->get('day_wise_created_post_video_count');

            if ($checkExist->num_rows() > 0) {
                $this->db->where('daily_date',$ttlPost["created_at"]);
                $this->db->update('day_wise_created_post_video_count', $updateTotalPost);
            }else{
                $updateTotalPost["daily_date"] = $ttlPost["created_at"];
                $this->db->insert('day_wise_created_post_video_count', $updateTotalPost);
            }
        }
    }
}
