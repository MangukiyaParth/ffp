<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
        }
        $this->load->model('admin/mdl_pyments');
        $this->load->model('admin/mdl_users');
        $this->load->helper('array_group_by');
        $this->load->helper('common');
    }

    public function dayWiseReg()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/reports/users/dailyRegUser';
        $this->load->view('admin/template', $data);
    }


    function getDayWiseRegReport()
    {
        $data = array();
        $queryData = $this->mdl_users->getDailyUserRegCount($_POST);
        $i = $_POST['start'];       

        foreach ($queryData as $key => $gData) {
            $i++;

            $data[] = array(
                'DT_RowId' => $key,
                'srNo' => $i,
                'date' => $gData->formatDate,
                'count' => $gData->totalCount,
            );
        }

        $countData = count($data);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countData,
            "recordsFiltered" => $countData,
            "data" => $data,
        );
        echo json_encode($output);
    }

}
