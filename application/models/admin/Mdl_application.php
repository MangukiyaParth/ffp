<?php
class Mdl_application extends CI_Model
{
    public function  addApplication($data)
    {
        $this->db->insert('application_add', $data);
        return $this->db->insert_id();
    }
    public function  addApplicationDailog($data)
    {
        $this->db->insert('dailog', $data);
    }
    public function editApplicationById($data, $id)
    {
        $this->db->where('app_id', $id);
        return $this->db->update('application_add', $data);
    }
    public function editApplicationByIdDailog($data, $id)
    {
        $this->db->where('app_id', $id)->update('dailog', $data);
    }
    public function ApplicationList()
    {
        /* $list = $this->db->get('application_add');
        return $list->result_array(); */
        $this->db->select('count(ap.a_id) as totalUnite, a.*');
        $this->db->from('application_add as a');
        $this->db->join('ads_api as ap','a.app_id=ap.app_id','LEFT');
        $this->db->group_by('ap.app_id');
        $list = $this->db->get();
        return $list->result_array();

    }
    public function getApplicationById($id)
    {
        /* $query = $this->db->where('app_id', $id)->get('application_add'); */

        $this->db->select('a.*,d.*');
        $this->db->from('application_add as a');
        $this->db->join('dailog as d','a.app_id=d.app_id','LEFT');
        $this->db->where('a.app_id', $id);
        //$this->db->group_by('ap.app_id');
        $list = $this->db->get();
        return $list->row_array();
    }

    public function deleteApplicationById($id)
    {
        $this->db->where('app_id', $id)->delete('dailog');
        $this->db->where('app_id', $id)->delete('ads_api');

        $this->db->where('app_id', $id);
        return $this->db->delete('application_add');
    }

    public function Applicationchk($name)
    {
        $result = $this->db->where('app_package_name', $name)->get('application_add');
        return $result->result_array();
    }
   
    public function updatestatus($id, $data)
    {
        $syn = explode('/', $id);
        $this->db->where($syn[0], $syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    public function checkApplicationbyid($id)
    {
        $this->db->select('count(*) as count');
        $this->db->where('app_id', $id);
        $record = $this->db->get('ads_api')->row_array();

        return $record['count'];
    }

     public function appViewById($id)
    {
        $query = $this->db->where('app_id', $id)->get('ads_api');
        return $query->result();
    }

    public function advertiseListById($id)
    {
        $this->db->select("*");
        $this->db->from("ads_api");
        $this->db->where("app_id",$id);
        $list = $this->db->get();
        return $list->result_array();
    }
    public function dailogSDataGetList($id)
    {
        $list = $this->db->select("*")->from("dailog")->where("app_id",$id)->get();
        return $list->row_array();
    }
    public function applicationDataById($id)
    {
        $this->db->select("*");
        $this->db->from("application_add");
        $this->db->where("app_id",$id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function analyticsByPackageName($packageName)
    {
        $this->db->select("*");
        $this->db->from("appcounter");
        $this->db->where("package_name",$packageName);
        $this->db->order_by("c_date",'desc');
        $this->db->limit(7);
        $list = $this->db->get();
        return $list->result_array();
    }
    public function liveAnalyticsByPackageName($packageName)
    {
        $today = date('Y-m-d');
        $query1 = $this->db->select('d_date,d_package_name,sum(impression) as totalImpression, sum(d_new) as totalNew, count(d_app_c_id) as totalActive')
        ->where('d_date',$today)
        ->where('d_package_name',$packageName)
        ->group_by(array("d_package_name", "d_date"))
        ->get('dailyappcounter');
        return $totalOldData = $query1->row_array();
        
    }
    public function remoceDailogImage($id)
    {
        $data = array(
            'image' => "",
        );
        $this->db->where('did', $id)->update('dailog', $data);
    }
}
