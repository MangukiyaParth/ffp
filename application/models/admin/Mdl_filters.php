<?php
class Mdl_filters extends CI_Model
{
    function __construct() {
    }
    public function getFilterUserDate($POST){
        $type = 0;
        if($this->input->post('type') && $this->input->post('type')!="1" && $this->input->post('type')!=""){
            $type = $this->input->post('type');
        }
        $this->db->select('a.*,n.app_version,dp.tamp_count');
        $this->db->from('admin as a');
        $this->db->join('notification as n','a.id = n.user_id','LEFT');
        $this->db->join('daily_post_count as dp','a.id = dp.user_id',"LEFT");

        if($this->input->post('version') && $this->input->post('version')!=""){
            if($type == 6 || $type == 7){
                $this->db->where("dp.tamp_count >=",$this->input->post('version'));
            }else{
                $this->db->where('n.app_version', $this->input->post('version'));
            }
        }
        /* 

        * 1 New User
        * 2 Total Package Paid User
        * 6 Total Package Expried User
        * 3 Trial Plan Active User
        * 5 Trial Plan Expried User
        * 4 Without Logo
        * 8 Total Free User

        1 Free User
        2 Plan Active
        3 Plan Expired
        4 Trial Active
        5 Trial Expried
        6 Free User Wise Post Count
        7 Paid User Wise Post Count

        <option value="1">New User</option>
        <option value="2">Total Package Paid User</option>
        <option value="6">Total Package Expried User</option>
        <option value="3">Trial Plan Active User</option>
        <option value="5">Trial Plan Expried User</option>
        <option value="4">Without Logo</option>
        <option value="8">Total Free User</option>
        <option value="9">Free User Wise Post Count</option>
        <option value="10">Paid User Wise Post Count</option>

        */
        /* Free User */
        if($type==1){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.expdate', null);
            $this->db->where('a.planStatus', null);
        }
        /* Plan Active */
        if($type==2){
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', 2);
        }
        /* Plan Expired */
        if($type==3){
            /* $this->db->where('a.ispaid', 0); */
            $this->db->where('a.planStatus', 2);
        }
        /* Trial Active */
        if($type==4){
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', 1);
        }
        /* Trial Expried */
        if($type==5){
            $this->db->where('a.ispaid', 0);
            $this->db->where('a.planStatus', 1);
        }
        /* Free User Wise Post Count */
        if($type == 6){ 
            $where = ("(`a`.`planStatus` is NULL".' OR '."`a`.`planStatus`=1)");
            $this->db->where($where);
        }
        /* Paid User Wise Post Count */
        if($type == 7){ 
            $this->db->where('a.ispaid', 1);
            $this->db->where('a.planStatus', 2);
        }

        /* if($type==2){
            if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                $this->db->where('p.pdate >=', $this->input->post('start_date'));
            }
            if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                $this->db->where('p.pdate <=', $this->input->post('end_date'));
            }
        }else{ */
            if($type==3 || $type==5){
                if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                    $this->db->where('a.expdate >=', $this->input->post('start_date'));
                }
                if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                    /* $endDate = date('Y-m-d', strtotime("+1 day", strtotime($this->input->post('end_date')))); */
                    $this->db->where('a.expdate <=',$this->input->post('end_date'));
                }
            }else{
                if($this->input->post('start_date') && $this->input->post('start_date')!=""){
                    $this->db->where('a.created_date >=', $this->input->post('start_date'));
                }
                if($this->input->post('end_date') && $this->input->post('end_date')!=""){
                    $endDate = date('Y-m-d', strtotime("+1 day", strtotime($this->input->post('end_date'))));
                    $this->db->where('a.created_date <=', $endDate);
                }
            }
       /*  } */
        
        $this->db->where('a.role >', '0');
        $this->db->group_by('a.id');
        $query = $this->db->get();
        /* echo $this->db->last_query();exit; */
        return $result = $query->result();
    }
}
