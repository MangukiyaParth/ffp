<?php
class Mdl_developer extends CI_Model
{
    public function  addDeveloper($data) {
        $this->db->insert('developer',$data);
        return $this->db->insert_id();
    }

    public function editDeveloperById($data, $id) {
        
        $this->db->where('d_id', $id);
        return $this->db->update('developer', $data);
    }

    public function DeveloperList() {
      /*  $list=$this->db->get('developer');
        return $list->result_array();*/

        $this->db->select("developer.d_id,developer.name,developer.email,developer.mobile,developer.address,developer.skype_id,developer.reference_name,developer.time,developer.status,skill.skill_name");
        $this->db->from("developer");
        $this->db->join("skill",'skill.s_id=developer.s_id','left');
        $list=$this->db->get();
        return $list->result_array();
    }
    public function SkillList() {
        $this->db->where('status','1');
        $list = $this->db->get('skill');
        return $list->result_array();
    }    
    public function getDeveloperById($id) {
        $query = $this->db->where('d_id',$id)->get('developer');
        return $query->row_array();
    }

    public function deleteDeveloperById($id) {

        $this->db->where('d_id', $id);
        return $this->db->delete('developer');
    }

    public function developerchk($email) {
        $result=$this->db->where('email',$email)
                ->get('developer');
        return $result->result_array();
    }
     public function updatedeveloper($id, $data) {
        $syn= explode('/', $id);
        $this->db->where($syn[0],$syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    

   
}   