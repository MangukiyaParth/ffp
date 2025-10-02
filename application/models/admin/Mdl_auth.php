<?php

class Mdl_Auth extends CI_Model
{

    public function do_login($email, $password)
    {
        $query = $this->db->select('a.id,a.email,a.role,a.mobile, r.title, r.code, ar.role_id')
            ->join('admin_role as ar', 'a.id = ar.user_id')
            ->join('role as r', 'ar.role_id = r.r_id')
            ->where('a.email', $email)
            ->where('a.password', $password)
            ->where('a.status', 1)
            ->where('a.role', 0)
            ->limit(1)
            ->get('admin as a');

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function do_login_otp($email, $otp)
    {
        $query = $this->db->select('a.id,a.email,a.role,a.mobile, r.title, r.code, ar.role_id')
            ->join('admin_role as ar', 'a.id = ar.user_id')
            ->join('role as r', 'ar.role_id = r.r_id')
            ->where('a.email', $email)
            ->where('a.otp', $otp)
            ->where('a.status', 1)
            ->where('a.role', 0)
            ->limit(1)
            ->get('admin as a');

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function login_teacher($email, $password)
    {
        $i = 0;
        $query = $this->db->select('t_id,t_email,role')
            ->where('t_email', $email)
            ->where('t_password', $password)
            ->where('t_status', 1)

            ->limit(1)
            ->get('teacher');
        $row = $query->result_array();

        $row[$i];
        foreach ($row as $key) {

            $divison = $this->db->select('divison.*')
                ->from('divison')
                //->join('teacher','teacher.t_id=divison.t_id','left')
                ->where('t_id', $key['t_id'])
                ->get()
                ->result();
            $row[$i]['divison'] = $divison;

            $i++;
        }

        return $row;
    }

    public function divison($id)
    {
        $query = $this->db->select('divison.*')
            ->where('t_id', $id)
            ->get('divison');
        return $query->result_array();
    }

    public function checkEmail($email)
    {
        $query = $this->db->select('ad_id')
            ->where('ad_email', $email)
            ->get('admin');

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * @param $data
     */
    public function resetPasswordToken($data)
    {
        $this->db->insert('admin_password_reset', $data);
    }

    /**
     * @param $token
     * @return bool
     */
    public function resetLinkCheck($token)
    {
        $query = $this->db->select('email')
            ->where('token', $token)
            ->get('admin_password_reset');

        if ($query->num_rows() != 0) {
            $email = $query->result();
            return $email[0]->email;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @param $data
     */
    public function updatePasswordByToken($email, $data)
    {
        $this->db->where('email', $email)
            ->update('admin', $data);
    }

    /**
     * @param $email
     * @return bool
     */
    public function alreadyResetToken($email)
    {
        $query = $this->db->select('email')
            ->where('email', $email)
            ->get('admin_password_reset');

        if ($query->num_rows() != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update token by email id
     */

    public function updateTokenByEmail($email, $data)
    {
        $this->db->where('email', $email)
            ->update('admin_password_reset', $data);
    }

    /**
     *@param data
     */
    public function save_token_by_email($data)
    {
        $this->db->insert('admin_password_reset', $data);
    }

    /*
*------------------------------------------------------------------------------------------------
*forgot password start
*------------------------------------------------------------------------------------------------
*/
    public function already_have_token_by_email($email)
    {
        $q = $this->db->where('email', $email)->get("admin_password_reset");
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function token_available($token)
    {
        $q = $this->db->where('token', $token)->get('admin_password_reset');
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function update_password_by_reset_token($token, $update)
    {
        $q = $this->db->where('token', $token)->get('admin_password_reset');

        if ($q->num_rows() > 0) {
            $result = $q->result();
            $email = $result[0]->email;
            $this->db->where('email', $email)->update('admin_user', $update);
            $token = md5(time() . SALT);
            $this->db->where('email', $email)->update('admin_password_reset', ["token" => $token]);
            return true;
        } else {
            return false;
        }
    }
}
