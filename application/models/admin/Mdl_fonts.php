<?php
class Mdl_fonts extends CI_Model
{
    public function addFonts($type)
    {
        $this->db->insert('fonts', $type);
        return true;
    }

    public function getFontList()
    {
        $this->db->select('*');
        $list = $this->db->get("fonts");
        return $list->result_array();
    }
}
