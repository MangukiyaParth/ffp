<?php
class Mdl_notificationsend extends CI_Model
{
	public function updatenotification($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('notification_send', $data);
		return "updated";
	}

	public function insertnotification($data)
	{
		$this->db->insert('notification_send', $data);
		return $this->db->insert_id();
	}


	public function getnotificationlist()
	{
		$data = $this->db->get('notification_send');
		return $data->result_array();
	}


	public function getnotificationbyid($id)
	{
		$query = $this->db->where('id', $id)->get('notification_send');
		return $query->row_array();
	}

	public function notificationdelete($id)
	{
		$this->db->where('id', $id)->delete('notification_send');
	}
	public function gettodaySpecialList()
    {
        $this->db->select('tid,path,cat_id');
        $this->db->where('t_event_date', ONLY_DATE);
        $this->db->limit(1);
        $data = $this->db->get('tamplet');
        $result = $data->row_array();
		if(!empty($result)){
			$result['path'] = base_url('media/template/').$result['path'];
			$result['cat_name'] = $this->getCategoryName($result['cat_id']);
		}
		return $result;
    }
	public function getCategoryName($cat_id)
    {
        if ($cat_id != "") {
            $user = $this->db->select('mtitle')->where('mid', $cat_id)->get("main_category");
            return $user->row_array()['mtitle'];
        } else {
            return false;
        }
    }

	public function getGreetingByCategoryId($cat_id)
    {
        $this->db->select('*');
        $this->db->where('cat_id', $cat_id);
        $this->db->order_by('rand()');
        $data = $this->db->get('tamplet');

        $result = $data->result_array();
        foreach ($result as $key => $res) {
            $result[$key]['t_event_date'] = ($res['t_event_date'] != "0000-00-00") ? date('d, F Y', strtotime($res['t_event_date'])) : '';
            $result[$key]['path'] = base_url('media/template/') . $res['path'];
            $result[$key]['cat_name'] = $this->getCategoryName($res['cat_id']);
        }
        return $result;
    }
	public function CategoryList()
    {
        $this->db->select('*');
        $this->db->from('main_category');
        $list = $this->db->get();
        return $list->result_array();
    }
}
