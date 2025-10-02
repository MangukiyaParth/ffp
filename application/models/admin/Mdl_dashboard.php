<?php
class Mdl_dashboard extends CI_Model
{
    public function totalUserPost()
    {
        $query = $this->db->select('count(post_id) as totalUserPost')->get('makepost');
        return $query->row_array()['totalUserPost'];
    }
    public function videoanalytics()
    {
        $query = $this->db->select('sum(ca_count) as totalUserVideo')->get('videoanalytics');
        return $query->row_array()['totalUserVideo'];
    }
    public function videoanalyticsToday()
    {
        $query = $this->db->select('sum(ca_count) as totalUserVideoToday')->where('va_date',ONLY_DATE)->get('videoanalytics');
        return $query->row_array()['totalUserVideoToday'];
    }
    public function totalUserPostToday()
    {
        $query = $this->db->select('count(post_id) as totalTodayPost')
        ->where('created_at',ONLY_DATE)
        ->get('makepost');
        /* print_r($query->row_array()['totalUser']);exit; */
        return $query->row_array()['totalTodayPost'];
    }
    public function totalUser()
    {
        $query = $this->db->select('count(id) as totalUser')->get('admin');
        /* print_r($query->row_array()['totalUser']);exit; */
        return $query->row_array()['totalUser'];
    }
    public function totalTodayNewUser()
    {
       
        $query = $this->db->select('count(id) as totalUser')
        ->where('DATE(created_date) <=',ONLY_DATE)
        ->where('DATE(created_date) >=',ONLY_DATE)
        ->get('admin');
        /* echo $this->db->last_query();
        print_r($query->row_array()['totalUser']);exit; */
        return $query->row_array()['totalUser'];
    }
    
    public function totalDeactiveUser()
    {
        $query = $this->db->select('count(id) as totalUser')->where('status',0)->get('admin');
        /* print_r($query->row_array()['totalUser']);exit; */
        return $query->row_array()['totalUser'];
    }
    public function totalTamplate()
    {
        $query = $this->db->select('count(tid) as totalTamplate')->get('tamplet');
        /* print_r($query->row_array()['totalTamplate']);exit; */
        return $query->row_array()['totalTamplate'];
    }
    
    public function totalTamplateCategoryWise()
    {
        $query = $this->db->select('mid,mtitle,event_date')->order_by('event_date','asc')->get('main_category');
        $result = $query->result_array();
       
        foreach ($result as $key => $value) {
            $query = $this->db->select('count(tid) as totalTamplate')->where('cat_id',$value['mid'])->get('tamplet');
            $result[$key]['totalPost'] = $query->row_array()['totalTamplate'];
            $result[$key]['event_date'] = ($value['event_date']!='0000-00-00')?date('d/m/Y',strtotime($value['event_date'])):'No';
            /* unset($result[$key][$value['mid']]);
            unset($result[$key][$value['mtitle']]); */
        }
        /* print_r($result);exit; */
        return $result;
    }
    public function totalPhotoCategoryWise()
    {
        $query = $this->db->select('*')->get('photo_category');
        $result = $query->result_array();
       
        foreach ($result as $key => $value) {
            $query = $this->db->select('count(photoId) as totalPhoto')->where('pcat_id',$value['pcat_id'])->get('photos');
            $result[$key]['totalPhoto'] = $query->row_array()['totalPhoto'];
        }
        /* print_r($result);exit; */
        return $result;
    }
    public function totalPositione()
    {
        $query = $this->db->select('count(pid) as totalPosition')->get('position');
        /* print_r($query->row_array()['totalPosition']);exit; */
        return $query->row_array()['totalPosition'];
    }
    public function totalCategory()
    {
        $query = $this->db->select('count(mid) as totalCategory')->get('main_category');
       /*  print_r($query->row_array()['totalCategory']);exit; */
        return $query->row_array()['totalCategory'];
    }
    
    public function totalTamplateByCategory($id)
    {
        $query = $this->db->select('count(tid) as totalTamplate')->where('cat_id',$id)->get('tamplet');
        return $query->row_array()['totalTamplate'];
    }
    public function todayFestivalPostList()
    {
        $query = $this->db->select('t.planImgName,t.tid,t.path,m.mid,m.event_date,m.mtitle,m.mslug')
        ->from('tamplet as t')
        ->join('main_category as m','t.cat_id=m.mid','LEFT')
        ->where('m.event_date',ONLY_DATE)
        /* ->where('m.status',1) */
        ->get();
        return $query->result_array();
    }
    public function upComingFestivalPostList()
    {
        $dt = date('Y-m-d', strtotime(ONLY_DATE .'+1 days'));
        $query = $this->db->select('t.planImgName,t.tid,t.path,m.mid,m.event_date,m.mtitle,m.mslug')
        ->from('tamplet as t')
        ->join('main_category as m','t.cat_id=m.mid','LEFT')
        ->where('m.event_date',$dt)
        /* ->where('m.status',1) */
        ->get();
        return $query->result_array();
    }
    public function getUpComingEventtList()
    {
        $totaldays = '+100 days';
        $dt = date('Y-m-d', strtotime(ONLY_DATE . $totaldays));
        $this->db->select('*');
        $this->db->where('event_date >=', ONLY_DATE);
        $this->db->where('event_date <', $dt);
        $this->db->where('status', 1);
        $this->db->order_by('event_date');
        $this->db->limit(30);
        $data = $this->db->get('main_category');

        /* echo $this->db->last_query();exit; */
        $result = $data->result_array();
        foreach ($result as $key => $res) {
            $result[$key]['event_date'] = ($res['event_date'] != "0000-00-00") ? date('d, M Y', strtotime($res['event_date'])) : '';
            if ($result[$key]['image'] != "") {
                $result[$key]['image'] = base_url('media/category/') . $res['image'];
                $result[$key]['thumb'] = base_url('media/category/thumb/') . $res['image'];
            } else {
                $result[$key]['thumb'] = base_url('media/category/notcategoryimg.jpg');
                $result[$key]['image'] = base_url('media/category/notcategoryimg.jpg');
            }
            /* total automative frame vala tamplte ketla che te */
            $tamp_res = $this->db->select('count(tid) as total_auto_tamp')->where('cat_id', $res['mid'])->get('tamplet')->row_array();
            $result[$key]['total_auto_tamp'] = $tamp_res['total_auto_tamp'];
            /* total paid tamplate count */
            $tamp_res1 = $this->db->select('count(tid) as totalPaidTamp')
            ->where('cat_id', $res['mid'])
            ->where('free_paid', 1)
            ->get('tamplet')
            ->row_array();
            $result[$key]['totalPaidTamp'] = $tamp_res1['totalPaidTamp'];

            /* total video ketla che te count */
            $tamp_video_res = $this->db->select('count(v_id) as total_video_tamp')->where('mid', $res['mid'])->get('videogif')->row_array();
            $result[$key]['total_video_tamp'] = $tamp_video_res['total_video_tamp'];
            /* total paid video ketla che te count */
            $tamp_video_res1 = $this->db->select('count(v_id) as totalPaidvVideo')
            ->where('mid', $res['mid'])
            ->where('free_paid',1)
            ->get('videogif')
            ->row_array();
            $result[$key]['totalPaidvVideo'] = $tamp_video_res1['totalPaidvVideo'];

            /* plan post count */
            $plan_tamp = $this->db->select('tid')->where('cat_id', $res['mid'])->get('tamplet')->result_array();
            $count_plan_tamp = 0;
            foreach ($plan_tamp as $key1 => $res1) {
                $filestring = PUBPATH . "media/template/plan/".$res['mslug'].'/'. $res1['tid'].'.jpg';
                if (file_exists($filestring)) {
                    $count_plan_tamp++;
                }
            }
            $result[$key]['totalPlanPost'] = $count_plan_tamp;

        }
        return $result;
    }

    public function getVideoAnalyticsLastDays()
    {
        
        
        $today = date("Y-m-d", strtotime('-60 days'));
        $this->db->where('va_date <', $today)->delete('videoanalytics');

        $this->db->select('*');
        $this->db->limit(7);
        $this->db->order_by('va_date',"DESC");
        $data = $this->db->get('videoanalytics');

        $result = $data->result_array();
        foreach ($result as $key => $res) {
            $result[$key]['va_date'] = ($res['va_date'] != "0000-00-00") ? date('d/m/Y', strtotime($res['va_date'])) : '';
        }
        return $result;
    }

    public function countDailyUserPost(){
        $this->db->select('count(post_id) totalPost,created_at');
        $this->db->group_by('created_at');
        $totalDailyPost = $this->db->get('makepost');
        $totalDailyPostResult = $totalDailyPost->result_array();

        foreach($totalDailyPostResult as $ttlPost){
            $updateTotalPost = ["post_count"=>$ttlPost["totalPost"],"video_count"=>0];
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

    public function getVersionWiseAppUserCount()
    {
        $query = $this->db->select('app_version,count(n_id) as totalUser')
                ->group_by('app_version')
                ->order_by('app_version','DESC')
                ->get('notification');
                /* echo $this->db->last_query();exit; */
        $result = $query->result_array();
       /* print_r($result);exit; */
        return $result;
    }

    public function totalPremiumUser()
    {
        $data = array();
        $query = $this->db->select('count(id) as totalPremiumUser')
            ->from("admin")
            /* ->where('ispaid', "1") */
            ->where('planStatus', "2")
            ->get();
        $result = $query->row_array();
        $data['totalPremiumUser'] = $result['totalPremiumUser'];
     /* today premum user */

        $query1 = $this->db->select('count(a.id) as totalTodayPremiumUser')
            ->from("admin as a")
            ->join("payments as p","a.id=p.u_id","LEFT")
            ->where('a.ispaid', "1")
            ->where('a.planStatus', "2")
            ->where('p.pdate', ONLY_DATE)
            ->where('p.packageid !=', "1")
            ->get();
        $result1 = $query1->row_array();
        $data['totalTodayPremiumUser'] = $result1['totalTodayPremiumUser'];


        $query2 = $this->db->select('count(id) as totalActivePremiumUser')
        ->from("admin")
        ->where('ispaid', "1")
        ->where('planStatus', "2")
        ->get();
        $result2 = $query2->row_array();
        $data['totalActivePremiumUser'] = $result2['totalActivePremiumUser'];

        $query3 = $this->db->select('count(id) as totalExpiredTodayUser')
        ->where('expdate', ONLY_DATE)
        ->where('ispaid', "1")
        ->where('planStatus', "2")
        ->get("admin");
        $result3 = $query3->row_array();
        $data['totalExpiredTodayUser'] = $result3['totalExpiredTodayUser'];

        $query4 = $this->db->select('count(id) as totalExpiredUser')
        ->where('expdate <', ONLY_DATE)
        ->where('ispaid', "0")
        ->where('planStatus', "2")
        ->get("admin");
        $result4 = $query4->row_array();
        $data['totalExpiredUser'] = $result4['totalExpiredUser'];


        return $data;
    }
    public function totalTrialUser()
    {
        $data = array();
        $query = $this->db->select('count(id) as totalTrialUser')
            ->from("admin")
            /* ->where('ispaid', "1") */
            ->where('planStatus', "1")
            ->get();
            /* echo $this->db->last_query();exit; */
        $result = $query->row_array();
        $data['totalTrialUser'] = $result['totalTrialUser'];

        $query1 = $this->db->select('count(a.id) as totalTodayTrialUser')
            ->from("admin as a")
            ->join("payments as p","a.id=p.u_id","LEFT")
            ->where('a.ispaid', "1")
            ->where('a.planStatus', "1")
            ->where('p.pdate', ONLY_DATE)
            ->where('p.packageid', "1")
            ->get();
            /* echo $this->db->last_query();exit; */
        $result1 = $query1->row_array();
        $data['totalTodayTrialUser'] = $result1['totalTodayTrialUser'];


        $query3 = $this->db->select('count(id) as totalActiveTrialUser')
            ->from("admin")
            ->where('ispaid', "1")
            ->where('planStatus', "1")
            ->get();
            /* echo $this->db->last_query();exit; */
        $result3 = $query3->row_array();
        $data['totalActiveTrialUser'] = $result3['totalActiveTrialUser'];

        $query4 = $this->db->select('count(id) as totalExpiredTrialUser')
            ->from("admin")
            ->where('ispaid', "0")
            ->where('planStatus', "1")
            ->get();
            /* echo $this->db->last_query();exit; */
        $result4 = $query4->row_array();
        $data['totalExpiredTrialUser'] = $result4['totalExpiredTrialUser'];

        $query5 = $this->db->select('count(id) as totalExpiredTodayTrialUser')
            ->from("admin")
            ->where('expdate', ONLY_DATE)
            ->where('ispaid', "1")
            ->where('planStatus', "1")
            ->get();
            /* echo $this->db->last_query();exit; */
        $result5 = $query5->row_array();
        $data['totalExpiredTodayTrialUser'] = $result5['totalExpiredTodayTrialUser'];


        return $data;
    }
    public function totalExpirePckduser()
    {
        $data = array();
        $query = $this->db->select('count(id) as totalExpPckUser')
        ->where('expdate <=', ONLY_DATE)
        ->where('ispaid', "0")
        ->where('planStatus', "2")
        ->get("admin");
        $result = $query->row_array();
        $data['totalExpPckUser'] = $result['totalExpPckUser'];

        $query1 = $this->db->select('count(id) as totalExpPckUserTodat')
        ->where('expdate', ONLY_DATE)
        ->where('ispaid', "0")
        ->where('planStatus', "2")
        ->get("admin");
        $result1 = $query1->row_array();
        $data['totalExpPckUserTodat'] = $result1['totalExpPckUserTodat'];
        
        return $data;
    }
    public function getTodayPaidSubscriptionUser()
    {
        $query = $this->db->select('p.*,u.mobile')
        ->from('payments as p')
        ->join('admin as u','p.u_id=u.id','LEFT')
        ->where('p.pmonth !=',0)
        ->order_by('p.pid',"desc")
        ->limit(10)
        ->get();
        return $query->result_array();
    }
    public function getTodayTrialSubscriptionUser()
    {
        $query = $this->db->select('p.*,u.mobile')
        ->from('payments as p')
        ->join('admin as u','p.u_id=u.id','LEFT')
        ->where('p.pmonth',0)
        ->order_by('p.pid',"desc")
        ->limit(10)
        ->get();
        return $query->result_array();
    }

    
    public function totalRevenuTillDate()
    {
        $result = $this->db->select('SUM(pamount) as total_amount')
        ->get('payments')
        ->row_array();
        
        return $result['total_amount'];
    }
    public function getSMSOtpCount()
    {
        $result = array();
        $this->db->select('sms_date,(count(if(sms_type="forgotpass",1,NULL))) AS total_forgot_sms, (count(if(sms_type="signup",1,NULL))) AS total_singup_sms, (count(DISTINCT if(sms_type="signup",sms_mobile,NULL))) AS total_unique_singup_sms', FALSE)
        ->group_by(array("sms_date"))
        ->order_by("sms_id","desc")
        ->limit(7);
        $query = $this->db->get('sms_log');
        $result = $query->result_array();
       /*  $query = $this->db->select('count(sms_id) as total_singup_sms where sms_type=forgotpass');
        $this->db->from('sms_log');
        $this->db->group_by("sms_date");
        $this->db->get();
        $ab = $query->result_array(); */
        /* print_r($ab);exit; */
        //$query1 = $this->db->select('count(sms_id) as total_forgot_sms')->where("sms_date",ONLY_DATE)->where("sms_type","forgotpass")->get('sms_log')->row_array();
        
        /* $result['total_singup_sms'] = $query['total_singup_sms'];
        $result['total_forgot_sms'] = $query['total_forgot_sms'];
        return $result; */
        return $result;
    }
    public function getCustomReport(){
        $final_result = array();
        $this->db->select('count(post_id) as totalPost,created_at,post_id');
        $this->db->group_by('created_at');
        $this->db->order_by('post_id', 'DESC');
        $this->db->limit(30);
        $totalDailyPost = $this->db->get('makepost');
        $totalDailyPostResult = $totalDailyPost->result_array();

//print_r($totalDailyPostResult);exit;
        foreach($totalDailyPostResult as $ttlPost){
            $final_result[$ttlPost["created_at"]]["totalPost"] = $ttlPost["totalPost"];
            $dt = $ttlPost['created_at'];
            /* register user */
            $this->db->select('count(id) as totalRegister');
            $this->db->where("DATE(created_date) = STR_TO_DATE('$dt', '%Y-%m-%d H:i:s')");
            $totalRegister = $this->db->get('admin');
            $final_result[$ttlPost["created_at"]]["totalRegister"] = $totalRegister->row_array()['totalRegister'];

            /* total subscription */
            $this->db->select('count(pid) as totalSub');
            $this->db->where("pdate", $ttlPost["created_at"]);
            $this->db->where("packageid !=", 1);
            $this->db->where("pprice !=", 0.00);
            $totalSub = $this->db->get('payments');
            $final_result[$ttlPost["created_at"]]["totalSub"] = $totalSub->row_array()['totalSub'];

            /* total fail */
            $this->db->select('count(DISTINCT w_mobile) as totalFail');
            $this->db->where("w_date", $ttlPost["created_at"]);
            $totalRFail = $this->db->get('webhook_failed');
            $final_result[$ttlPost["created_at"]]["totalFail"] = $totalRFail->row_array()['totalFail'];

            /* total trile */
            $this->db->select('count(DISTINCT u_id) as totalTrial');
            $this->db->where("pdate", $ttlPost["created_at"]);
            $this->db->where("packageid", 1);
            $this->db->where("pprice", 0.00);
            $totalTrial = $this->db->get('payments');
            $final_result[$ttlPost["created_at"]]["totalTrial"] = $totalTrial->row_array()['totalTrial'];

            /* total revenew */
            $this->db->select('sum(pprice) as totalRevenew');
            $this->db->where("pdate", $ttlPost["created_at"]);
            $totalRevenew = $this->db->get('payments');
            $final_result[$ttlPost["created_at"]]["totalRevenew"] = ($totalRevenew->row_array()['totalRevenew']!=null)?$totalRevenew->row_array()['totalRevenew']:0.00;
            
            /* total video create */
            $this->db->select('sum(ca_count) as totalVideoCreate');
            $this->db->where("va_date", $ttlPost["created_at"]);
            $totalVideoCreate = $this->db->get('videoanalytics');
            $final_result[$ttlPost["created_at"]]["totalVideoCreate"] = $totalVideoCreate->row_array()['totalVideoCreate'];

        }
        return $final_result;
    }

    public function getCroneReportFetch()
    {
        $query = $this->db->select('*')
        ->from('crone_report')
        ->order_by('crone_id',"desc")
        ->limit(10)
        ->get();
        return $query->result_array();
    }

}	
