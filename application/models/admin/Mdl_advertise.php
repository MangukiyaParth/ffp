<?php
class Mdl_advertise extends CI_Model
{
    public function getApplicationList()
    {
        $list = $this->db->get('application_add');
        return $list->result_array();
    }
    public function  addAdvertise($data)
    {
        $this->db->insert('ads_api', $data);
        return $this->db->insert_id();
    }

    public function editAdvertiseById($data, $id)
    {

        $this->db->where('a_id', $id);
        return $this->db->update('ads_api', $data);
    }

    public function AdvertiseList()
    {
        $this->db->select("a.*,app.app_name,app.status,app.admob_main_id");
        $this->db->from("ads_api as a");
        $this->db->join("application_add as app", 'a.app_id=app.app_id', 'left');
        $list = $this->db->get();
        return $list->result_array();
    }

    public function getAdvertiseById($id)
    {
        $query = $this->db->where('a_id', $id)->get('ads_api');
        return $query->row_array();
    }

    public function deleteAdvertiseById($id)
    {

        $this->db->where('a_id', $id);
        return $this->db->delete('ads_api');
    }

    public function Advertisechk($name)
    {
        $result = $this->db->where('app_id', $name)
            ->get('ads_api');
        return $result->result_array();
    }
    public function updatestatus($id, $data)
    {
        $syn = explode('/', $id);
        $this->db->where($syn[0], $syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    public function checkcategorybyid($id)
    {
        return 0;
    }
}
