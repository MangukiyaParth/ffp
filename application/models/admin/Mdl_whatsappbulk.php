<?php
class Mdl_whatsappbulk extends CI_Model
{
    function __construct() {
        
    }
    public function getWhatsAppList()
    {
        $this->db->select('c.*,t.wtemp_id,t.template,t.type,t.media,l.mobile,COUNT(l.wlog_id) as total_send');
        $this->db->from('camping_list as c');
        $this->db->join('whatsapp_logs as l','c.cam_id=l.cam_id','LEFT');
        $this->db->join('whatsapp_template as t','l.tamp_name=t.wtemp_id','LEFT');
        $this->db->group_by('l.cam_id');
        $query = $this->db->get();
        $result = $query->result_array();
        $final_result['new'] = array();
        $final_result['retarget'] = array();
        $final_result['defult'] = array();
        foreach($result as $key=>$value){
           /*  print_r($value);exit; */
            //$countTime = countHour($value['created_at']); 
            if($value['retarget']==0){
                $final_result['new'][$key] = $value;
            }elseif($value['retarget']==1){
                $final_result['retarget'][$key] = $value;
            }elseif($value['retarget']==2){
                $final_result['defult'][$key] = $value;
            }
        }
        /* print_r($final_result);exit; */
        return $final_result;
    }
    public function getTempList()
    {
        $list = $this->db->select("*")->where("bulk_status",1)->order_by('sort', 'asc')->get("whatsapp_template");
        return $list->result_array();
    }
    public function addCamping($data)
    {
        $this->db->insert('camping_list', $data);
        return $this->db->insert_id();
    }
    public function getAllCampingList()
    {
        /* $query = $this->db->where("retarget",0)->where("cam_title !=","default")->get('camping_list'); */
        $query = $this->db->where("cam_title !=","default")->get('camping_list');
        return $query->result_array();
    }
    public function addWhatsappLogs($data)
    {
        $this->db->insert('whatsapp_logs', $data);
        return true;
    }
    public function campingExistOrNot($slug)
    {
        $query = $this->db->where('cam_title', $slug)->get('camping_list');
        if($query->num_rows() > 0){
            return false;
        }else{
            return true;
        }
    }
    public function getCampingSubDetials($cam_id)
    {
        $this->db->select('l.*,a.*');
        $this->db->from('whatsapp_logs as l');
        $this->db->join('admin as a','l.mobile=a.mobile','LEFT');
        $this->db->where('l.cam_id',$cam_id);
        $this->db->where('a.role',1);
        $this->db->order_by('l.wlog_id','desc');
        $query = $this->db->get();
        /* print_r($query->result_array());exit; */
        
        /* $query = $this->db->where('cam_id', $cam_id)->get('whatsapp_logs'); */
        return $query->result_array();
    }
    public function getCampingAutoSendDetials()
    {
        $this->db->select('c.*,t.wtemp_id,t.template,t.type,t.media,l.mobile,l.wlog_id');
        $this->db->from('camping_list as c');
        $this->db->join('whatsapp_logs as l','c.cam_id=l.cam_id','LEFT');
        $this->db->join('whatsapp_template as t','l.tamp_name=t.wtemp_id','LEFT');
        $this->db->where('c.cam_id',1);
        $this->db->order_by('l.wlog_id','desc');
        $this->db->limit(1000);
        $query = $this->db->get();
        /* print_r($query->result_array());exit; */
        return $query->result_array();
    }

    public function getFilterUserDateForWhatsapp($type,$start_date,$end_date){
        $finalResult = array();
        if($type==10){
            $this->db->select('l.mobile,l.created_at,a.business_name');
            $this->db->from('whatsapp_logs as l');
            $this->db->join('admin as a','l.mobile=a.mobile','LEFT');
            $this->db->where('l.cam_id', 1);
            $this->db->where('a.ispaid',0);
            $this->db->where('a.role',1);
            $this->db->where("DATE(l.created_at) >= STR_TO_DATE('$start_date', '%Y-%m-%d')");
            $this->db->where("DATE(l.created_at) <= STR_TO_DATE('$end_date', '%Y-%m-%d')");

            $query = $this->db->get();
            $finalResult1 = $query->result_array();
            
            $filterData = array();
            foreach($finalResult1 as $key=>$datResu){
                $countTime = countHour($datResu['created_at']);
                if($countTime['status']){
                    $filterData[$key] = $datResu;
                }
            }
            $finalResult = $filterData;
            /* print_r($finalResult);exit; */
        }elseif($type==9){
            $razorPayOrderList = getOrderByRazorPayAllListBulk($start_date,$end_date);
            /* print_r($razorPayOrderList);exit; */
            foreach($razorPayOrderList as $key=>$item){
                $userID = explode("_",$item['receipt']);
                $mobilee = getUserMobileNumber(end($userID));
                if($mobilee !="not found!"){
                    $finalResult[$key]['mobile'] = $mobilee;
                    $finalResult[$key]['business_name'] = "User";
                    $finalResult[$key]['created_at'] = date("d/m/Y h:i:s",$item['created_at']);
                }
            }
            function removeDuplicateKeysFromSubarray($subArray) {
                /* print_r($subArray);exit; */
                return array_intersect_key($subArray, array_unique(array_column($subArray, 'mobile')));
            }
            $uniqueArray = array_map('removeDuplicateKeysFromSubarray', $finalResult);

            print_r($uniqueArray);exit;
        }elseif($type==8){
            $this->db->select('w.w_date,w.w_mobile,w.created_at,a.business_name');
            $this->db->from('webhook_failed as w');
            $this->db->join('admin as a','w.w_mobile=a.mobile','LEFT');
            $this->db->where('a.ispaid',0);
            $this->db->where('a.role',1);
            $this->db->where('w.w_date >=', $start_date);
            $this->db->where('w.w_date <=', $end_date);

            $query = $this->db->get();
            $finalResult1 = $query->result_array();
            
            $filterData = array();
            foreach($finalResult1 as $key=>$datResu){
                $filterData[$key] = $datResu;
                $filterData[$key]['mobile'] = $datResu['w_mobile'];
                unset($filterData[$key]['w_mobile']);
                unset($filterData[$key]['w_date']);
            }
            $finalResult = $filterData;
            /* print_r($finalResult);exit; */
        }else{
            $this->db->select('business_name,mobile');
            $this->db->from('admin');
            /* free user */
            if($type==1){
                $this->db->where('ispaid', 0);
                $this->db->where('planStatus', null);
                $this->db->where('expdate', null);
            }
            /* plan active */
            if($type==2){
                $this->db->where('ispaid', 1);
                $this->db->where('planStatus', 2);
                $this->db->where('expdate !=', null);
            }
            /* plan expired */
            if($type==3){
                $this->db->where('ispaid', 0);
                $this->db->where('planStatus', 2);
                //$this->db->where('expdate !=', null);
                /*  */
            }
            /* trial active */
            if($type==4){
                $this->db->where('ispaid', 1);
                $this->db->where('planStatus', 1);
                $this->db->where('expdate !=', null);
            }
            /* trial expired */
            if($type==5){
                $this->db->where('ispaid', 0);
                $this->db->where('planStatus', 1);
                //$this->db->where('expdate !=', null);
                /*  */
            }
            /* without logo profile */
            if($type==6){
                $this->db->where('photo', "");
            }
            /* last login - free user, trial and plan both expired user */
            if($type==7){
                $this->db->where('ispaid', 0);
                $this->db->where("DATE(last_login) >= STR_TO_DATE('$start_date', '%Y-%m-%d')");
                $this->db->where("DATE(last_login) <= STR_TO_DATE('$end_date', '%Y-%m-%d')");
            }
            
            if($type==3 || $type==5){
                $this->db->where('expdate >=', $start_date);
                $this->db->where('expdate <=', $end_date);
                /* expired */
            }else{
                /* created */
                if($type!=7){
                    $this->db->where("DATE(created_date) >= STR_TO_DATE('$start_date', '%Y-%m-%d')");
                    $this->db->where("DATE(created_date) <= STR_TO_DATE('$end_date', '%Y-%m-%d')");
                }
            }
            $query = $this->db->get();
            /* print_r($query->result_array());exit; */
            $finalResult = $query->result_array();
        }
        /* echo $this->db->last_query();exit; */
        return $finalResult;
    }
    public function campDelete($id)
    {
        $this->db->where('cam_id', $id)->delete('whatsapp_logs');
        $this->db->where('cam_id', $id)->delete('camping_list');
    }
    
}
