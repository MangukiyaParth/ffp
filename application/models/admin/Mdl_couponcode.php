<?php
class Mdl_couponcode extends CI_Model
{
    public function getCouponCodeList()
    {
        $list = $this->db->select("*")->get("coupon_code");
        $result = $list->result_array();
        $final_result['active']= array();
        $final_result['deactive']= array();
        foreach($result as $key=>$value){
            if($value['status']==1){
                $final_result['active'][$key] = $value;
            }
            if($value['status']==0){
                $final_result['deactive'][$key] = $value;
            }
        }
        return $final_result;
    }
    public function updateCouponCode($data,$id)
    {
        $this->db->where('coupon_id', $id);
        return $this->db->update('coupon_code', $data);
    }
    public function addCouponCode($type)
    {
        $this->db->insert('coupon_code', $type);
        return true;
    }
    public function getCouponCodeDataByID($id)
    {
        $this->db->select("*")->from("coupon_code");
        $this->db->where("coupon_id", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function couponCodeDelete($id)
    {
        $this->db->where('coupon_id', $id)->delete('coupon_code');
    }
       
}
