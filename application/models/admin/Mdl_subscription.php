<?php
class Mdl_subscription extends CI_Model
{

    public function getSubScriptionPlanList()
    {
        $this->db->select("s.*,sd.*");
        $this->db->from("subscriptionPlan as s");
        $this->db->join("subscriptionDescription as sd", 's.plan_id=sd.plan_id', 'left');
        $list = $this->db->get();
        return $list->result_array();
    }
    public function addSubScriptionPlan($data)
    {
        $this->db->insert('subscriptionDescription', $data);
        return $this->db->insert_id();
    }
    public function editSubScriptionById($data, $id)
    {
        $this->db->where('sub_dis_id', $id);
        return $this->db->update('subscriptionDescription', $data);
    }
    public function getSubScriptionById($id)
    {
        $query = $this->db->where('sub_dis_id', $id)->get('subscriptionDescription');
        return $query->row_array();
    }
    public function getPlanDataById($id)
    {
        $query = $this->db->where('plan_id', $id)->get('subscriptionPlan');
        return $query->row_array();
    }
    public function getAllPlanData()
    {
        $query = $this->db->get('subscriptionPlan');
        return $query->result_array();
    }
    public function deleteSubDescriptionById($id)
    {
        $this->db->where('sub_dis_id', $id);
        return $this->db->delete('subscriptionDescription');
    }
    public function updateSubPlanById($data, $id)
    {
        $this->db->where('plan_id', $id);
        return $this->db->update('subscriptionPlan', $data);
    }

    public function countTotalSubRecord()
    {
        $query = $this->db->where('plan_id', 1)->get('subscriptionDescription');
        return $query->num_rows();
    }
    
}
