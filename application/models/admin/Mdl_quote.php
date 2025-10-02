<?php
class Mdl_quote extends CI_Model
{
    public function addQuotes($data)
    {
        $this->db->insert('quotes', $data);
    }
    public function checkQuoteExist($title)
    {
        $query = $this->db->select('qu_id')
            ->where('title', $title)
            ->get('quotes');
        return $query->num_rows(); 
    }
}
