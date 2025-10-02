<?php
class Mdl_telesales extends CI_Model
{
    function __construct() {
    }
    public function getFilterUserDate($POST){
        $type = $this->input->post('type');

        $this->db->select('a.*,n.app_version,dp.tamp_count');
        $this->db->from('admin as a');
        $this->db->join('notification as n','a.id = n.user_id','LEFT');
        $this->db->join('lead_assign_data as l','a.id=l.cus_id ',"LEFT");
        $this->db->join('daily_post_count as dp','a.id=dp.user_id ',"LEFT");
        $this->db->where("l.cus_id",null);
        
        if($this->input->post('version') && $this->input->post('version')!=""){
            if($type == 5){
                $this->db->where("dp.tamp_count >=",$this->input->post('version'));
            }else{
                $this->db->where('n.app_version', $this->input->post('version'));
            }
        }
        /* 
        1 Free User
        2 Plan Expried
        3 Trial Active
        4 Trial Expried
        // 5 User Wise Post Count

        */
         /* Free User */
        if($type==1){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.expdate', null);
            $this->db->where('a.planStatus', null);
        }

        /* Plan Expried */
        if($type==2){
            /* $this->db->where('a.ispaid', 0); */
            $this->db->where('a.planStatus', 2);
        }

        /* Trial Active */
        if($type==3){
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', 1);
        }

        /* Trial Expried */
        if($type==4){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.planStatus', 1);
        }

        if($type==5){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.planStatus', null);
        }

        /* if($type==6){
            $this->db->group_start();
            $this->db->where('a.planStatus', null);
            $this->db->or_where('a.planStatus', 1);
            $this->db->group_end();
        } */

        if($type==2 || $type==4){
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                $this->db->where('a.expdate >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                /* $endDate = date('Y-m-d', strtotime("+1 day", strtotime($this->input->post('end_date')))); */
                $this->db->where('a.expdate <=',$this->input->post('end_date'));
            }
        }else{
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                /* $start_date = $this->input->post('start_date');
                $this->db->where("DATE(a.created_date) >= STR_TO_DATE('$start_date', '%Y-%m-%d')"); */
                $this->db->where('a.created_date >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                $endDate = date('Y-m-d', strtotime("+1 day", strtotime($this->input->post('end_date'))));

                /* $this->db->where("DATE(a.created_date) <= STR_TO_DATE('$endDate', '%Y-%m-%d')"); */
                $this->db->where('a.created_date <=', $endDate);
            }
        }

        $this->db->where('a.role >',0);
        $this->db->group_by('a.id');
        $query = $this->db->get();
       /*  echo $this->db->last_query();exit; */
        return $result = $query->result();
    }
    public function getTelesaleUser($id = null){
        $this->db->select('a.*,r.title,r.code');
        $this->db->join('admin_role as ar', 'a.id=ar.user_id');
        $this->db->join('role as r', 'ar.role_id=r.r_id',"LEFT");
        $this->db->where('a.status', 1);
        $this->db->where('a.role', 0);
        if($id){
            $this->db->where('a.id', $id);
        }
        /* $array_check = array("TELESALES","SUB_ADMIN"); 
        $this->db->where_in('r.code', $array_check);*/
        $this->db->where_in('r.code', "TELESALES");
        $query = $this->db->get('admin as a');
       /*  echo $this->db->last_query();exit; */
        return $query->result_array();
        
    }
    public function addDataAssign($data){
        $this->db->insert('lead_assign_data', ($data));
    }
    public function addDataLogInsert($data){
        $this->db->insert('lead_logs', ($data));
    }
    public function getPendingReviewList(){
        $this->db->select('cr.*,ls.*,a.id,a.name,a.mobile,a.email,saleA.name as salesName,saleA.mobile as salesMobile,saleA.email as salesEmail');
        $this->db->from('lead_customer_review as cr');
        $this->db->join('lead_assign_data as ls','cr.lead_assign_id=ls.lead_assign_id',"LEFT");
        $this->db->join('admin as a','ls.cus_id=a.id',"LEFT");
        $this->db->join('admin as saleA','ls.user_id=saleA.id',"LEFT");
        $this->db->where('cr.review_status', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPendingSubscriptionList(){
        $this->db->select('lsr.sales_report_id,lsr.sales_amount,lsr.pack_buy_date,lsr.sub_ss,lsr.note,lsr.created_at as subRequestAddDate,ls.open_status_time,ls.created_at as leadAssignDate,sp.plan_name,sp.price,a.ispaid,a.planStatus,a.created_date as userCreatedDate,a.name,a.mobile,saleA.name as salesName,saleA.mobile as salesMobile,saleA.email as salesEmail');
        $this->db->from('lead_sales_report as lsr');
        $this->db->join('lead_assign_data as ls','lsr.lead_assign_id=ls.lead_assign_id',"LEFT");
        $this->db->join('subscriptionPlan as sp','lsr.pack_id=sp.plan_id',"LEFT");
        $this->db->join('admin as a','ls.cus_id=a.id',"LEFT");
        $this->db->join('admin as saleA','ls.user_id=saleA.id',"LEFT");
        $this->db->where('lsr.sub_status', 0);
        $query = $this->db->get();
        /*  echo $this->db->last_query();exit; */
        return $query->result_array();
    }
    public function getLeadsLogs(){
        $this->db->select('l.*,a.name as subAdmin,at.name as teleSales');
        $this->db->from('lead_logs as l');
        $this->db->join('admin as a',"l.user_id=a.id","LEFT");
        $this->db->join('admin as at',"l.telesales_id=at.id","LEFT");
        $this->db->order_by("l.log_id","desc");
        $query = $this->db->get();
        /*  print_r($query->result_array()); */
        return $query->result_array();
    }
    public function getAllTeleSalesOverView(){

        $this->db->select('a.name,a.email,a.id');
        $this->db->from("admin_role as ar");
        $this->db->join('admin as a', 'ar.user_id=a.id',"LEFT");
        $this->db->where('a.status', 1);
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
}
