<?php
class Mdl_setting extends CI_Model
{

	public function getrolelist()
	{
		$data = $this->db->get('role');
		return $data->result_array();
	}

	public function checkrole($id)
	{
		$query = $this->db->where('title', $id)->get('role');
		return $query->result_array();
	}

	public function insertrole($data)
	{
		$this->db->insert('role', $data);
		return $this->db->insert_id();
	}
	public function getrolebyid($id)
	{
		$query = $this->db->where('r_id', $id)->get('role');
		return $query->row_array();
	}
	public function updaterole($id, $data)
	{
		$this->db->where('r_id', $id);
		$this->db->update('role', $data);
		return "updated";
	}
	public function roledelete($id)
	{
		$this->db->where('r_id', $id)->delete('role');
	}
	public function getmodule()
	{
		$this->db->order_by('title asc');
		/*$this->db->order_by("title", "asc" );*/
		$query = $this->db->get('modul');
		return $query->result_array();
	}
	public function insertpermission($data)
	{
		$this->db->insert('permision', $data);
		return $this->db->insert_id();
	}
	public function getpermissionid($id)
	{
		$query = $this->db->select('m_id')->where('r_id', $id)->get('permision');
		return $query->result_array();
	}
	public function deletepermission($id)
	{
		$this->db->where('r_id', $id)->delete('permision');
	}

	public function geteditbyid($id, $table)
	{
		$query = $this->db->where($id)->get($table);
		return $query->row_array();
	}

	public function checkeditname($id, $table)
	{
		$query = $this->db->where($id)->get($table);
		return $query->result_array();
	}

	public function getuserpermission($modul, $id)
	{
		$this->db->select('permision.r_id,permision.p_id,permision.m_id,modul.title as modultitle, role.title as roletitle , role.r_id');
		$this->db->from('permision');
		$this->db->join('role', 'permision.r_id = role.r_id', 'left');
		$this->db->join('modul', 'permision.m_id = modul.m_id', 'left');
		$this->db->where('role.r_id', $id);
		$this->db->like('modul.title', $modul);
		return $this->db->get()->result_array();
	}

	public function status($id, $data)
	{
		$syn = explode('/', $id);
		$this->db->where($syn[0], $syn[1]);
		$this->db->update($syn[2], $data);
		return "updated";
	}


	public function getAllSetting()
	{
		$query = $this->db->get('setting');
		return $query->result();
	}
	/**
	 * @return array
	 */
	public function get_All_Setting()
	{
		$this->db->select('option_name,value');

		$query = $this->db->get('setting');

		$qresult = $query->result();
		$result = [];
		foreach ($qresult as $key => $value) {
			$result[$value->option_name] = $value->value;
		}

		return $result;
	}
	public function get_All_Setting1()
	{
		$this->db->select('id,option_name,value');

		$query = $this->db->get('setting');

		$qresult = $query->result();
		$result = [];
		foreach ($qresult as $key => $value) {
			$result[$value->id] = $value->id;
		}

		return $result;
	}


	public function updateRow($colVal, $data)
	{

		$this->db->where('option_name', $colVal);
	  $query = $this->db->update('setting', $data);

	  return $query;
	}

	/**
	 * @param $option
	 * @return mixed
	 */
	public function getValueByOption($option)
	{
		$id = $this->session->userdata('admin_user_id');
		$query = $this->db->select('value')
			->where('option_name', $option)

			->get('setting');

		$res = $query->row();

		if (!empty($res)) {
			return $res->value;
		} else {
			return false;
		}
	}

	public function insertData($data)
	{
		
		$this->db->insert('setting', $data);
	}

	/**
	 * @param $id
	 * @param $data
	 */
	public function editData($id, $data)
	{
		$this->db->where('id', $id)
			->update('setting', $data);
	}

	/**
	 * @param $id
	 */
	public function deleteSettingLogo($id)
	{
		$data = array(
			'value' => '',
		);
		$this->db->where('option_name', 'site_logo')
			->update('setting', $data);
	}

	public function deleteSharingBanner()
	{
		$data = array(
			'value' => '',
		);
		$this->db->where('option_name', 'sharingBanner')
			->update('setting', $data);
	}
	public function insert_setting_ajax($array)
	{
		$this->db->insert('setting', $array);
	}
}
