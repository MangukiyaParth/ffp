<?php
class Complain extends CI_Controller
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
        $this->load->model('admin/mdl_complain');
        $this->load->helper('array_group_by');
        $this->load->helper('common');
    }

    public function index()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/complain/list';
        $this->load->view('admin/template', $data);
    }


    function getComplainList()
    {
    
        $data = array();
        $queryData = $this->mdl_complain->getList($_POST);
        $i = $_POST['start'];   

        foreach ($queryData as $key => $gData) {
            $i++;

            $statusText = '';
            if($gData->status == 0){
                $statusText .= '<span ><strong> Pending </strong> </span>';
            } else if($gData->status == 1){
                $statusText .= '<span class="text-info"><strong> On Progress </strong> </span>';
            } else if($gData->status == 2){
                $statusText .= '<span class="text-danger"><strong> Hold </strong> </span>';
            } else if($gData->status == 3){
                $statusText .= '<span class="text-success"><strong> Solved </strong> </span>';    
            }

            $action = '<a class="mb-xs mt-xs modal-sizes modal-with-zoom-anim replayModelShow" id="'.$gData->com_id.'"  replyVal="'.$gData->reply.'" statusVal="'.$gData->status.'"><button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button></a>';

            $data[] = array(
                'DT_RowId' => $gData->com_id,
                'com_id' => $gData->com_id,
                'name' => $gData->name . '<br/>' .$gData->mobile,
                'complain_id' => $gData->complain_id,
                'message' => $gData->message,
                'reply' => $gData->reply,
                'status' => $statusText,
                'created_at' => date('d-m-Y H:i A',strtotime($gData->created_at)),
                'action'=> $action
            );
        }

        $countData = $this->mdl_complain->countFiltered($_POST);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countData,
            "recordsFiltered" => $countData,
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function saveReply()
    {
        $updateData = array(
            'reply' => $this->input->post('reply'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $id = $this->input->post('id');
        $updatedResponse = $this->mdl_complain->update($id, $updateData);
        if ($updatedResponse == 1) {      
            $data['status'] = 'success';
            $data['message'] = 'Successfully Updated !!';
        } else {
            $data['status'] = 'failed';
            $data['message'] = 'Not updated !!';
        }

        echo json_encode($data);
    }

}
