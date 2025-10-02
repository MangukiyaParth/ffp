<?php
class Mdl_admin_role extends CI_Model
{
    protected $tableName = 'admin_role';


   
    public function add($data)
    {
        $this->db->insert($this->tableName, $data);
        return true;
    }

    public function update($data,$id)
    {
        $this->db->where('id', $id);
       return  $this->db->update($this->tableName, $data);
    }

    public function roleExistsCheck($userId)
    {
        $this->db->where('user_id', $userId);
        $query = $this->db->get($this->tableName);
        return $query->row_array();
    }
}
