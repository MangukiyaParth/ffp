<?php
class DBExport extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('is_admin_login'))
		{
			echo "<h1>No Direct Script Allowed!......</h1>";
			exit();
		}
		if ($this->session->userdata('role')!=0) {
            redirect(ADMIN_URL . 'dashboard');
        }
		$this->load->model('admin/mdl_dbexport');
	}
	public function index()
	{
		$this->mdl_dbexport->take_database_backup();
	}
}
