<?php
error_reporting(1);
//ini_set('display_errors', 1);
defined('BASEPATH') or exit('No direct script access allowed');

class ImportPaidUser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $this->load->model('admin/Import_model');
    }

    public function index() {
        $this->load->view('admin/import_view');
    }

    public function import_excel() {
        $file_mimes = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            
            if('csv' == $extension) {
                $reader = PHPExcel_IOFactory::createReader('CSV');
            } else {
                $reader = PHPExcel_IOFactory::createReader('Excel2007');
            }
            
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
           /*  print_r($sheetData);exit; */
            $i = 0;
            foreach($sheetData as $row) {
                if($i==100){
                    $i=1;
                    sleep(5);
                }
                if($i!=0){
                    /* package get */
                    $getPackageData = $this->db->select('*')
                        ->where('plan_id', $row[9])
                        ->limit(1)
                        ->get('subscriptionPlan');
                    $resultPackageData = $getPackageData->row_array();

                    /* payment id exist check */
                    $query_status = $this->db->select('*')
                        ->where('ptransactionid', $row[0])
                        ->get('payments');


                    /* mobile exist or not */
                    $query = $this->db->select('*')
                        ->where('mobile', $row[6])
                        ->get('admin');
                    $exist_mobile = $query->row_array();
                    /* print_r($row);exit; */
                    
                    
                    /* $e_date = DateTime::createFromFormat('d-m-Y H:i', $row[8]);
                    $created_at = $e_date->format('Y-m-d H:i:s');
                    $currentDate = $e_date->format('Y-m-d'); */


                    $currentDate = date('Y-m-d',strtotime($row[8]));
                    $created_at = date('Y-m-d H:i:s',strtotime($row[8]));


                    $pexpdate = date('Y-m-d', strtotime($currentDate . ' +'.($resultPackageData["month"]+1).' month'));


                    if ($query->num_rows() <= 0) {
                        /* mobile resgiter thashe */
                            /*  print_r($row);exit; */
                            $c_email = "";
                            if($row[5]!="" && $row[5]!="brandfotoss@gmail.com"){
                                $c_email = $row[5];
                            }

                            $data = array(
                                'name' => "",
                                'business_name' => "",
                                'mobile' => $row[6],
                                'b_mobile2' => "",
                                'email' => strtolower($c_email),
                                'b_email' => "",
                                'b_website' => "",
                                'password' => md5("123456" . SALT),
                                'gender' => "",
                                'role' => 1,
                                'address' => "",
                                'status' => 1,
                                'ispaid' => 1, 
                                'expdate' => $pexpdate,
                                'planStatus' => 2,
                                'last_login' => $created_at,
                                'created_date' => $created_at,
                                'updated_date' => $created_at,
                            );
                            /*  print_r($data);exit; */
                            $this->db->insert('admin', $data);
                            $user_id = $this->db->insert_id();

                            if ($query_status->num_rows() <= 0) {
                                $SubPayInsert = array(
                                    'u_id' => $user_id,
                                    'pamount' =>$row[1],
                                    'pdate' => $currentDate,
                                    'ptransactionid' => $row[0],
                                    'pstatus' => $resultPackageData['plan_name'], 
                                    'packageid' => $row[9],
                                    'pprice' => $row[1],
                                    'pmonth' => $resultPackageData['month'],
                                    'ref_status' => 0,
                                    'refund_id' => null,
                                    'refundDate' => null,
                                    'userRole' => null,
                                    'created_at' => $created_at,
                                );
    
                                $this->db->insert('payments', $SubPayInsert);
                            }
                        
                    } else {
                        /* user register but payment status check and insert */
                       /* print_r($exist_mobile['id']);exit; */

                        if ($query_status->num_rows() <= 0) {
                            
                            $data = array(
                                'ispaid' => 1, 
                                'expdate' => $pexpdate,
                                'planStatus' => 2,
                                'last_login' => $created_at,
                                'created_date' => $created_at,
                                'updated_date' => $created_at,
                            );

                            $this->db->where('id', $exist_mobile['id'])->update('admin', $data);

                            $SubPayInsert = array(
                                'u_id' => $exist_mobile['id'],
                                'pamount' =>$row[1],
                                'pdate' => $currentDate,
                                'ptransactionid' => $row[0],
                                'pstatus' => $resultPackageData['plan_name'], 
                                'packageid' => $row[9],
                                'pprice' => $row[1],
                                'pmonth' => $resultPackageData['month'],
                                'ref_status' => 0,
                                'refund_id' => null,
                                'refundDate' => null,
                                'userRole' => null,
                                'created_at' => $created_at,
                            );
                            $this->db->insert('payments', $SubPayInsert);
                        }

                    }
                }
                $i++;
            }
            echo "Data imported successfully";
        } else {
            echo "Please upload a valid Excel file.";
        }
    }
}
