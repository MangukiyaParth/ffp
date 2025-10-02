<?php
class Mdl_skill extends CI_Model
{
    public function  addSkill($data) {
        $this->db->insert('skill',$data);
        return $this->db->insert_id();
    }

    public function editSkillById($data, $id) {
        
        $this->db->where('s_id', $id);
        return $this->db->update('skill', $data);
    }

    public function SkillList() {
        $list=$this->db->get('skill');
        return $list->result_array();
    }
        
    public function getSKillById($id) {
        $query = $this->db->where('s_id',$id)->get('skill');
        return $query->row_array();
    }

    public function deleteSkillById($id) {

        $this->db->where('s_id', $id);
        return $this->db->delete('skill');
    }

    public function skillchk($name) {
        $result=$this->db->where('skill_name',$name)
                ->get('skill');
        return $result->result_array();
    }
     public function updateskill($id, $data) {
        $syn= explode('/', $id);
        $this->db->where($syn[0],$syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    /* Check skill exist */
    public function checkskillbyid($id)
    {
        $this->db->select('count(*) as count');
        $this->db->where('s_id', $id);
        $record = $this->db->get('developer')->row_array();
        
        return $record['count'];
        //return 0;
    }
    

   
}   