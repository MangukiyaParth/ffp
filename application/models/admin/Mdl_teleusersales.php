<?php
class Mdl_teleusersales extends CI_Model
{
    function __construct() {
        $this->column_order = array('l.cus_id');
        $this->column_search = array('l.cus_id');
    }

    public function getDayWiseReportDataResult($start,$end)
    {
        $this->db->select('l.*,a.photo,a.id,a.name,a.mobile,a.b_mobile2,a.b_email,a.ispaid,a.planStatus,a.business_name,a.last_login,s.lead_status_title');
        $this->db->from('lead_assign_data as l');
        $this->db->join('admin as a', 'l.cus_id=a.id', 'LEFT');
        $this->db->join('lead_status as s', 'l.lead_status_id=s.lead_status_id', 'LEFT');
        /* $this->db->join('lead_customer_chat as lcc', 'l.lead_assign_id=lcc.lead_assign_id','LEFT');
        $this->db->where('lcc.chat_id IS NULL OR lcc.chat_id = (SELECT MAX(chat_id) FROM lead_customer_chat WHERE lead_assign_id = l.lead_assign_id)', NULL, FALSE); */
        if ($start && $start != "") {
            $this->db->where('l.created_at >=', $start);
        }
        if ($end && $end != "") {
            $this->db->where('l.created_at <=', $end);
        }
        $this->db->where('l.user_id', $this->session->userdata('admin_user_id'));
        $this->db->where('l.final_status', 0);
        $this->db->order_by('l.lead_status_id', 'asc');
        $query = $this->db->get();
        /* echo $this->db->last_query();exit; */
        $result = $query->result_array();
        /* print_r($result); */
        $final_result = $result;
        foreach($result as $key=>$val){
            $final_result[$key]['totalUserPost'] = $this->countUserPostTotal($val['id']);
           /*  print_r($val['lead_assign_id']);exit; */
            $this->db->select('messages,next_schedule_date,client_percentage')->where("lead_assign_id",$val['lead_assign_id'])->order_by("chat_id","desc")->limit(1);
            $query_qur = $this->db->get("lead_customer_chat");
            if ($query_qur->num_rows() > 0) {
                $query_res = $query_qur->row_array(); 
                $final_result[$key]['messages'] = $query_res['messages'];
                $final_result[$key]['next_schedule_date'] = $query_res['next_schedule_date'];
                $final_result[$key]['client_percentage'] = $query_res['client_percentage'];
            } else{
                $final_result[$key]['messages'] = "";
                $final_result[$key]['next_schedule_date'] = "";
                $final_result[$key]['client_percentage'] = "";
            }
        }
        /* print_r($final_result);exit; */
        return $final_result;
    }
    public function countUserPostTotal($user_id)
    {
        $this->db->select('tamp_count');
        $this->db->where('user_id', $user_id);
        $list = $this->db->get("daily_post_count");
        if($list->num_rows() > 0){
            return $list->row()->tamp_count;
        }else{
            return 0;
        }
    }

    public function checkIDAssignBuThisUser($id,$lead_assign_id){
        $this->db->select('lead_assign_id');
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->where('cus_id', $id);
        $this->db->where('lead_assign_id', $lead_assign_id);
        /* $this->db->where('final_status', 0); */
        $query = $this->db->get("lead_assign_data");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getCustomerProfileData($id,$lead_assign_id){
        $this->db->select('a.*,l.*,lc.*,lr.pack_id,lr.sales_amount,lr.pack_buy_date,lr.sub_ss,lr.note,lr.created_at as report_created_date,lr.sub_status');
        $this->db->from('admin as a');
        $this->db->join('lead_assign_data as l',"a.id=l.cus_id","LEFT");
        $this->db->join('lead_customer_review as lc',"l.lead_assign_id=lc.lead_assign_id","LEFT");
        $this->db->join('lead_sales_report as lr',"l.lead_assign_id=lr.lead_assign_id","LEFT");
        $this->db->where('a.id', $id);
        $this->db->where('l.cus_id', $id);
        /* $this->db->where('l.final_status', 0); */
        $this->db->limit(1);
        $query = $this->db->get();
        $dataResumt = $query->row_array();

        /* customer profile - admin and lead assign  */
        $this->db->select('*');
        $this->db->where('month >', 0);
        $this->db->where('status', 1)->order_by('month','asc');
        $query = $this->db->get("subscriptionPlan");
        $packagelist = $query->result_array();


         /* lead_customer_feedback_status list  */
         $this->db->select('custom_status_title,customer_status_id');
         $query = $this->db->get("lead_customer_feedback_status");
         $cus_feedback_status = $query->result_array();

         /* chat history get  */
         $this->db->select('lc.*,fs.customer_status_id,fs.custom_status_title');
         $this->db->from('lead_customer_chat as lc');
         $this->db->join('lead_customer_feedback_status as fs','lc.customer_status_id=fs.customer_status_id','LEFT');
         $this->db->where("lc.lead_assign_id",$lead_assign_id);
         $this->db->order_by("lc.chat_id","desc");
         $query = $this->db->get();
         $cus_chat_history = $query->result_array();

        $data = array(
            "dataResumt" => $dataResumt,
            "packagelist" => $packagelist,
            "cus_feedback_status" => $cus_feedback_status,
            "cus_chat_history" => $cus_chat_history,
        );
        return $data; 
    }
    public function addReviewData($data){
        $this->db->insert('lead_customer_review', $data);
    }
    public function addSubscriptionForSalesData($data){
        $this->db->insert('lead_sales_report', $data);
    }
    public function addChatHistoryData($data){
        $this->db->insert('lead_customer_chat', $data);
    }

    public function getTeleSalesOverView($user_id){

        $this->db->select('a.name,a.email,a.id');
        $this->db->from("admin_role as ar");
        $this->db->join('admin as a', 'ar.user_id=a.id',"LEFT");
        $this->db->where('a.status', 1);
        $this->db->where('a.id', $user_id);
        $this->db->where('a.role', 0);
        $this->db->where('ar.role_id', 3);
        $query = $this->db->get();
        $totalUserSale = $query->result_array();
        $result = array();
        foreach($totalUserSale as $user){
            
            $leadStatu = $this->db->select('lead_status_id,lead_status_title')->get("lead_status");
            $totalLeadStatus = $leadStatu->result_array();
            foreach($totalLeadStatus as $status){
                $this->db->select('count(lead_assign_id) as totalCount');
                $this->db->where('user_id', $user['id']);
                $this->db->where('lead_status_id', $status['lead_status_id']);
                $query_count = $this->db->get("lead_assign_data");
                $result[$user['name'].'-'.$user['email']][$status['lead_status_title']] = $query_count->row_array();
            }

        }
        return $result;
    }
    public function getTodayRegisterUser(){
        $this->db->select('*');
        $this->db->where('created_date >=', date('Y-m-d'));
        $this->db->where('created_date <', date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))));
        /* $this->db->where('ispaid !=', 1);
        $this->db->where('ispaid !=', 1); */
        $query = $this->db->get("admin");
        /* echo $this->db->last_query();exit; */
        return $query->result_array();
    }
    public function getTelesalesAllCounter($sales_id){
        $result = array();
        $result["dayReceviedCall"] = $this->calculateTotalReceviceCallTime($sales_id,"day");
        $result["monthReceviedCall"] = $this->calculateTotalReceviceCallTime($sales_id,"month");
        $result["totalReceviedCall"] = $this->calculateTotalReceviceCallTime($sales_id,"total");
        return $result;
    }
    public function calculateTotalReceviceCallTime($sales_id,$time){
        $this->db->select('lcc.start_time, lcc.end_time,lcc.created_time');
        $this->db->from('lead_assign_data as lad');
        $this->db->join('lead_customer_chat as lcc',"lad.lead_assign_id=lcc.lead_assign_id","LEFT");
        $this->db->where('lad.user_id',$sales_id);
        $this->db->where('lad.lead_status_id !=',1);

        if($time == "month"){
            $this->db->where('YEAR(lcc.created_time)', date('Y'));
            $this->db->where('MONTH(lcc.created_time)', date('m'));
        }

        if($time == "day"){
            $this->db->where('YEAR(lcc.created_time)', date('Y'));
            $this->db->where('MONTH(lcc.created_time)', date('m'));
            $this->db->where('day(lcc.created_time)', date('d'));
        }
        $this->db->where_not_in('lcc.customer_status_id', array(2,3,5,6));
        $query = $this->db->get();
        /* echo $this->db->last_query();exit; */
        $result = $query->result_array();
        $sumInMinutes = 0;
        $sumHours = 0;
        $interval = 0;
        $remainingMinutes = 0;
        foreach ($result as $row) {
            $time1 = new DateTime($row['start_time']);
            $time2 = new DateTime($row['end_time']);
            $interval = $time1->diff($time2);

            $sumInMinutes += $interval->format('%i');
        }
        $sumHours = floor($sumInMinutes / 60);
        $remainingMinutes = $sumInMinutes % 60;
        return $sumHours.":".$remainingMinutes;
    }
    public function getPlanExpiredData()
    {
        $query = $this->db->select('a.*,p.pstatus,pmonth')
            ->from('admin a')
            ->join('payments as p',"a.id=p.u_id","inner")
            ->where('a.expdate <=',date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))))
            ->where('a.expdate >=',date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))))
            /* ->where('a.ispaid',1) */
            ->where('a.planStatus',2)
            ->where('a.role',1)
            ->group_by('p.u_id')
            ->where('p.pid', '(SELECT MAX(pid) FROM payments WHERE u_id = a.id)', false)
            /* ->order_by('p.pid',"asc") */
            ->order_by('p.pmonth',"desc")
            ->get();
        return $query->result_array();
    }
    public function getPromoCodeData($startDate,$endDate,$promo_filter_type)
    {
        $user_id = $this->session->userdata('admin_user_id');
        $userData = getUserFullData($user_id);
        $result = array();
        if($userData){
            if($userData['note'] !=""){
                $this->db->select('a.id,a.business_name,a.mobile,a.ispaid,a.expdate,a.planStatus,a.last_login,a.created_date,a.b_mobile2,p.pstatus,pdate,pmonth');
                $this->db->from('payments p');
                $this->db->join('admin as a',"p.u_id=a.id","inner");
                $this->db->where_in('p.pstatus',explode(",",$userData['note']));
                if ($startDate && $startDate != "") {
                    $this->db->where('a.expdate >=', $startDate);
                }
                if ($endDate && $endDate != "") {
                    $this->db->where('a.expdate <=', $endDate);
                }
                if($promo_filter_type==2){
                    $this->db->where('a.ispaid',1);
                    $this->db->where('a.planStatus',1);
                }
                if($promo_filter_type==3){
                    $this->db->where('a.ispaid',0);
                    $this->db->where('a.planStatus',1);
                }
                if($promo_filter_type==4){
                    $this->db->where('a.expdate',ONLY_DATE);
                    $this->db->where('a.ispaid',1);
                    $this->db->where('a.planStatus',1);
                }
                $query = $this->db->get();
                /* echo $this->db->last_query();exit; */
                $result['data'] = $query->result_array();
                $result['promo'] = $userData['note'];
                /* print_r($result);exit; */
                return $result;
            }else{
                return false;
            }
        }
    }

}
