<?php
class Mdl_frames extends CI_Model
{

    public function addFrames($type)
    {
        $this->db->insert('frames', $type);
        return true;
    }
    public function getFrameslist()
    {
        $list =$this->db->select("*")->get("frames");
        return $list->result_array();
    }
    public function getFramesDataByID($id)
    {
        $this->db->select("*")->from("frames");
        $this->db->where("fid", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
    public function FramesDelete($id)
    {
        $this->db->where('fid', $id)->delete('frames');
    }
     public function updateFrames($data,$id)
    {
        $this->db->where('fid', $id);
        return $this->db->update('frames', $data);
    }
    public function checkSubFrame($id)
    {
        $this->db->select("*")->from("sub_frames");
        $this->db->where("fid", $id);
        $list = $this->db->get();
        return $list->num_rows();
    }
    /* sub frames */
    public function getSubFramesDataByID($id)
    {
        $this->db->select("*")->from("sub_frames");
        $this->db->where("sf_id", $id);
        $list = $this->db->get();
        return $list->row_array();
    }
   
    public function SubFramesDelete($id)
    {
        $this->db->where('sf_id', $id)->delete('sub_frames');
    }
    public function addSubFrames($type)
    {
        $this->db->insert('sub_frames', $type);
        return true;
    }
    public function getSubFrameslist()
    {
        $list = $this->db->select("s.*,f.frame_name")
        ->from("sub_frames as s")
        ->join("frames as f","s.fid=f.fid","LEFT")
        ->get();
        return $list->result_array();
    }
}
