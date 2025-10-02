<?php
class Mdl_dbexport extends CI_Model
{
     public function take_database_backup()
    {
        $date=date('d-m-Y');
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('download');
        force_download('db-'.$date.'.zip', $backup);
    }  
}