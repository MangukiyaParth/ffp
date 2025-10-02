<?php
class Mdl_notification extends CI_Model
{
    public function getApplicationList() {
        $this->db->where('status','1');
        $list = $this->db->get('application_add');
        return $list->result_array();
    }
    public function  addNotification($data) {
        $this->db->insert('notification',$data);
        return $this->db->insert_id();
    }

    public function editNotificationById($data, $id) {
        
        $this->db->where('n_id', $id);
        return $this->db->update('notification', $data);
    }
     

    public function NotificationList() {
        $this->db->select("notification.n_id,application_add.app_name,notification.title,notification.message,notification.image,notification.schedule_time,notification.status");
        $this->db->from("notification");
        $this->db->join("application_add",'application_add.app_id=notification.app_id','left');
        $list=$this->db->get();
        return $list->result_array();
    }
   
    public function getNotificationById($id) {
        $query = $this->db->where('n_id',$id)->get('notification');
        return $query->row_array();
    }

    public function deleteNotificationById($id) {

        $this->db->where('n_id', $id);
        return $this->db->delete('notification');
    }

    public function Notificationchk($name) {
        $result=$this->db->where('app_id',$name)
                ->get('notification');
        return $result->result_array();
    }
    public function updatestatus($id, $data) {
        $syn= explode('/', $id);
        $this->db->where($syn[0],$syn[1]);
        $this->db->update($syn[2], $data);
        return "updated";
    }
    public function checkapplicationbyid($id)
    {
        return 0;
    }
    
}   