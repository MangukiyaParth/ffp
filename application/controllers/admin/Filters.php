<?php
class Filters extends CI_Controller
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
        $this->load->model('admin/mdl_filters');
        /* $this->load->library('excel'); */
    }
    
    public function index()
    {
        if($this->input->post()){
            $result = $this->mdl_filters->getFilterUserDate($this->input->post());
            
            switch($this->input->post('type')){
                case 1:
                    $type = "new";
                break;
                case 2:
                    $type = "a#paid";
                break;
                case 3:
                    $type = "a#tril";
                break;
                case 4:
                    $type = "w#logo";
                break;
                case 5:
                    $type = "e#trial";
                break;
                case 6:
                    $type = "e#paid";
                break;
                case 8:
                    $type = "free";
                break;
                case 9:
                    $type = "freeUser#postCount";
                break;
                case 10:
                    $type = "paidUser#postCount";
                break;
                default:
                    $type = "All";
            }


            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $data['data'] = array(
                'list' =>$result,
                'versioncode' =>($this->input->post('version')!="")?$this->input->post('version'):"All",
                'type' =>$type,
                'start' =>($start!="")?date("d-m-Y",strtotime($start)):"All",
                'end' =>($end!="")?date("d-m-Y",strtotime($end)):"All",
            );
            $data['middle'] = 'admin/filter/filterlist';
            $this->load->view('admin/template', $data);
                /* $fileName = 'data-'.time().'.xlsx';  
                
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
                $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
                $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
                
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A1', "fgf");
                $objPHPExcel->getActiveSheet()->SetCellValue('B1', "asdas");
                $objPHPExcel->getActiveSheet()->SetCellValue('C1', "sds");
                $objPHPExcel->getActiveSheet()->SetCellValue('D1', "hi");
                $objPHPExcel->getActiveSheet()->SetCellValue('E1', "helo");

                $filename = "tutsmake". date("Y-m-d-H-i-s").".csv";
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
                $objWriter->save('media/test/'.$filename); */ 
        }else{
            $data['data'] = array(
                'list' =>array(),
                'versioncode' =>"",
                'type' =>"",
                'start' =>"",
                'end' =>"",
            );
            $data['middle'] = 'admin/filter/filterlist';
            $this->load->view('admin/template', $data);
        }
       
    }
}
