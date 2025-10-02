<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsappbulk extends CI_Controller
{
    protected $current_user;
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        $this->load->model('admin/mdl_whatsappbulk');
        $this->load->helper('razorpay_data');
    }

    public function index()
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsappbulk->getTempList(),
            'getCampingList' => $this->mdl_whatsappbulk->getAllCampingList(),
        );
        $data['middle'] = 'admin/whatsapp/whatsappbulkadd';
        $this->load->view('admin/template', $data);
    }
    public function list()
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsappbulk->getWhatsAppList(),
        );
        $data['middle'] = 'admin/whatsapp/whatsappbulklist';
        $this->load->view('admin/template', $data);
    }
    public function camsublist($cam_id)
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsappbulk->getCampingSubDetials($cam_id),
        );
        $data['middle'] = 'admin/whatsapp/whatsappbulkcamplist';
        $this->load->view('admin/template', $data);
    }
    public function autosend()
    {
        $data['data'] = array(
            'list' => $this->mdl_whatsappbulk->getCampingAutoSendDetials(),
        );
        $data['middle'] = 'admin/whatsapp/whatsappbulkautolist';
        $this->load->view('admin/template', $data);
    }

    public function filterDataRecordCount(){
        $filter = $this->input->post('filter');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $filter_result = $this->mdl_whatsappbulk->getFilterUserDateForWhatsapp($filter,$startDate,$endDate);
        $data['status'] = 'success';
        $data['message'] = 'Get Successfully -'.count($filter_result);
        $data['record'] = count($filter_result);
        echo json_encode($data);

    }
    public function sendBulkCamping()
    {
        $typeoffilter = $this->input->post('typeoffilter');
        $cam_title = $this->input->post('cam_title');
        $tamp_id = $this->input->post('tamp_name');
        $numbers_menually = $this->input->post('numbers_menually');
        $custom_auto = "bulk";
        if($typeoffilter=="filter"){
            $filter_type = $this->input->post('filter_type');
            /* only test device */
            if($filter_type==11){
                $filter_final_result = array();
                $sendMsgCount = $this->sendMsgInsertLog($filter_final_result,1,$tamp_id,$custom_auto);
                $data['status'] = 'success';
                $data['message'] = 'Test Camping Send Successfully...!--'.$sendMsgCount;
                echo json_encode($data);exit;
            }
            if($filter_type=="10"){
                $custom_auto = "auto";
            }
            $start_date = $this->input->post('start_date');
            /* var_dump($start_date);exit; */
            $end_date = $this->input->post('end_date');
            if($start_date =="" || $end_date ==""){
                $data['status'] = 'error';
                $data['message'] = 'Start and End Date are required!';
                echo json_encode($data);exit;
            }
            $filter_result = $this->mdl_whatsappbulk->getFilterUserDateForWhatsapp($filter_type,$start_date,$end_date);
            if(empty($filter_result)){
                $data['status'] = 'error';
                $data['message'] = 'Data not found...!';
                echo json_encode($data);exit;
            }
            $filter_final_result = array();
            
            foreach($filter_result as $key=>$retarg_resu){
                $filter_final_result[$key][] = $retarg_resu["mobile"];
                $filter_final_result[$key][] = ($retarg_resu["business_name"]!="")?$retarg_resu["business_name"]:"User";
                $filter_final_result[$key][] = "";
            }
            /* print_r($filter_final_result);exit; */
            /* camping list title add and check */
            if($filter_type==10){
                $cam_id = $this->insertCampingTitle($cam_title,2);
            }else{
                $cam_id = $this->insertCampingTitle($cam_title,0);
            }
            if($cam_id == false){
                $data['status'] = 'error';
                $data['message'] = 'Camping Title already exist..!';
                echo json_encode($data);exit;
            }
            /* call and send array for send message and insert log */
            $sendMsgCount = $this->sendMsgInsertLog($filter_final_result,$cam_id,$tamp_id,$custom_auto);

            $data['status'] = 'success';
            $data['message'] = 'Camping Send Successfully Added...!!--'.$sendMsgCount;

        }else if($typeoffilter=="bulk"){
            if (isset($_FILES['image']['name'])) {
                $config['upload_path'] = './media/whatsappTemp/files/';
                $config['allowed_types'] = 'csv|xls|xlsx';
                $config['max_size']      = 2048;
    
                $new_name = time() . slug_string($_FILES['image']['name']);
                $config['file_name'] = $new_name;
    
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $data['status'] = 'error';
                    $data['message'] = $this->upload->display_errors();
                    echo json_encode($data);exit;
                } else {
                    $data1 = $this->upload->data();
                }
    
                $csvFilePath = './media/whatsappTemp/files/'.$data1['file_name'];
                if (file_exists($csvFilePath)) {
                    $csvData = file_get_contents($csvFilePath);
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'CSV file not found.';
                    echo json_encode($data);exit;
                }

                if (file_exists($csvFilePath)) {
                    $csvData = file_get_contents($csvFilePath);
                    $rows = str_getcsv($csvData, "\n");
                    $csvArray = array();
                    foreach ($rows as $row) {
                        $csvArray[] = str_getcsv($row, ",");
                    }
                    /* remove fist row in array */
                    array_shift($csvArray);
                    if(count($csvArray) <= 0){
                        $data['status'] = 'error';
                        $data['message'] = 'CSV file not found.';
                        echo json_encode($data);exit;
                    }
                    /* print_r($csvArray);exit; */
                    /* camping list title add and check */
                    $cam_id = $this->insertCampingTitle($cam_title,0);
                    if($cam_id == false){
                        $data['status'] = 'error';
                        $data['message'] = 'Camping Title already exist..!';
                        echo json_encode($data);exit;
                    }
                    /* call and send array for send message and insert log */
                    $sendMsgCount = $this->sendMsgInsertLog($csvArray,$cam_id,$tamp_id,$custom_auto);

                    $data['status'] = 'success';
                    $data['message'] = 'Camping Send Successfully Added...!!--'.$sendMsgCount;
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'CSV file not found.';
                }
            }else{
                $data['status'] = 'error';
                $data['message'] = 'File not upload...!';
            } 
        }else if($typeoffilter=="manually"){
            $menually_array = explode(",",$numbers_menually);
            /* print_r($menually_array); */
            $custom_array = array();
            for($i=0;$i<count($menually_array);$i++){
                $custom_array[$i][] = preg_replace('/\s+/', '', $menually_array[$i]);
                $custom_array[$i][] = "User";
                $custom_array[$i][] = "";
            }
            /* print_r($custom_array);exit; */
            /* camping list title add and check */
            $cam_id = $this->insertCampingTitle($cam_title,0);
            if($cam_id == false){
                $data['status'] = 'error';
                $data['message'] = 'Camping Title already exist..!';
                echo json_encode($data);exit;
            }
            /* call and send array for send message and insert log */
            $sendMsgCount = $this->sendMsgInsertLog($custom_array,$cam_id,$tamp_id,$custom_auto);
            $data['status'] = 'success';
            $data['message'] = 'Camping Send Successfully Added...!!--'.$sendMsgCount;
            
        }else if($typeoffilter=="retarget"){
            $previus_camping_id = explode("<->",$this->input->post('previus_camping'));
            $retarget_result = $this->mdl_whatsappbulk->getCampingSubDetials($previus_camping_id[0]);
            $retarget_final_result = array();
            foreach($retarget_result as $key=>$retarg_resu){
                if($retarg_resu["ispaid"] ==1 && $retarg_resu["planStatus"] ==2){

                }else{
                    $retarget_final_result[$key][] = $retarg_resu["mobile"];
                    $retarget_final_result[$key][] = "User";
                    $retarget_final_result[$key][] = "";

                }
            }
            /* print_r($retarget_final_result);exit; */
            /* camping list title add and check */
            $cam_id = $this->insertCampingTitle("Retarget__".$previus_camping_id[1]."__".$cam_title,1);
            if($cam_id == false){
                $data['status'] = 'error';
                $data['message'] = 'Camping Title already exist..!';
                echo json_encode($data);exit;
            }
            /* call and send array for send message and insert log */
            $sendMsgCount = $this->sendMsgInsertLog($retarget_final_result,$cam_id,$tamp_id,$custom_auto);
            $data['status'] = 'success';
            $data['message'] = 'Camping Send Successfully Added...!!--'.$sendMsgCount;
        }
        echo json_encode($data);
    }

    public function sendMsgInsertLog($csvArray,$cam_id,$tamp_id,$custom_auto){
        $mobile = "";
        $userName = "User";
        $expired = "";
        $team = "";

        $temp_query = $this->db->where('wtemp_id', $tamp_id)->get('whatsapp_template');
        $tampData = $temp_query->row_array();
        $tamp_name = $tampData['template'];
        $total_recordinsert = 0;
        $sleep_cnt = 0;
        $mynumber = [
            "0" => array(
                "0"=>"8141631370",
                "1"=>"Techbit Infotech",
                "2"=>"",
            )/* ,
            "1" => array(
                "0"=>"8140886300",
                "1"=>"Pragnesh",
                "2"=>"",
            ),
            "2" => array(
                "0"=>"7874216031",
                "1"=>"Mitali",
                "2"=>"",
            ),
            "3" => array(
                "0"=>"9429640939",
                "1"=>"Bipin",
                "2"=>"",
            ) */
        ];
        $csvArray = array_merge($mynumber,$csvArray);
        /* print_r($csvArray);exit; */
        /* array_unshift($csvArray,$mynumber); */

        foreach($csvArray as $key=>$users){
            /* 
            0-mobile,
            1-username,
            2-team,
            */
            $mobile = $users[0];
            $userResult = getUserFullDataByMobile($users[0]);
            if($userResult){
                $userName = $userResult['business_name'];	
                $expired = ($userResult['expdate']!="" && $userResult['expdate']!="0000-00-00")?date('d/m/Y', strtotime($userResult['expdate'])):"";
                $team = $users[2]." Month";
            }else{
                $userName = $users[1];
            }
            /* sms_helper */
            set_whatsapp_api_tamplate($mobile,$tamp_name,$userName,$expired,$team,$cam_id,$custom_auto);
            if($sleep_cnt == 50){
                sleep(1);
                $sleep_cnt = 0;
            } 
            
            $total_recordinsert++;
            $sleep_cnt++;
        }
        return $total_recordinsert;
    }
    public function insertCampingTitle($title,$status){
        /* camping add */
        $camp_insert = array(
            'cam_title' => stringToSlug($title),
            'cam_date' => ONLY_DATE,
            'retarget' => $status,
            'created_at' => date('Y-m-d H:i:s'),
        );
        $checkSlug = $this->mdl_whatsappbulk->campingExistOrNot(stringToSlug($title));
        if($checkSlug == false){
            return false;
        }else{
            return $this->mdl_whatsappbulk->addCamping($camp_insert);
        }
    }
    public function deletecamp()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = array();
        $id = $this->input->post('id');
        $this->mdl_whatsappbulk->campDelete($id);
        $data['status'] = 'success';
        $data['message'] = 'Successfully Deleted !!';

        echo json_encode($data);
    }

}
