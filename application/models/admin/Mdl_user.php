<?php
class Mdl_user extends CI_Model
{
 
    public function checkEmailExist($email)
    {
        $query = $this->db->select('id')
            ->where('email', $email)
            ->get('admin');

        if ($query->num_rows() > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }

   
    public function getUserById($id)
    {
        $query = $this->db->where('id', $id)
            ->get('admin');
        return $query->result();
    }


    /**
     * @param $id
     * @param $data
     */
    public function editUser($id, $data)
    {
        $query = $this->db->where('id', $id)
            ->update('admin', $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProfile($id)
    {
        $query = $this->db->where('id', $id)
            ->limit(1)
            ->get('admin');

        return $query->row_array();

    }

    /**
     * @param $old
     * @return mixed
     */
    public function checkOldPassword($id,$old)
    {
        $query = $this->db->select('id')
            ->where('password', $old)
            ->where('id',$id)
            ->get('admin');

        return $query->num_rows();
    }

    /**
     * @param $id
     * @param $data
     */
    public function updatePassword($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
    }
	public function updateProfile($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
    }

}