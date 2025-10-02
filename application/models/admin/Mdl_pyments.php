<?php
class Mdl_pyments extends CI_Model
{
    function __construct()
    {
        $this->column_order = array('created_at');
        $this->column_search = array('created_at');
    }


    private function _get_datatables_query($postData)
    {

        $this->db->from('payments');
        if ($this->input->post('start_date') && $this->input->post('start_date') != "") {
            $this->db->where('pdate >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date') && $this->input->post('end_date') != "") {
            $this->db->where('pdate <=', $this->input->post('end_date'));
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($postData['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
    }


    public function getDayWiseReportData($postData)
    {
        $this->db->select('pdate, count(pid) as total, pstatus, sum(pprice) as total_amount, pprice,pamount,packageid');
        /* $this->db->where('ref_status', 0); */
        $this->_get_datatables_query($postData);
        $this->db->group_by(array('pdate', 'pstatus'));
        $this->db->order_by('pdate', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getMonthWiseReportData()
    {
        $this->db->select('packageid,pdate, DATE_FORMAT(pdate, "%b %Y") as fortmate_date, count(pid) as total, pprice,pstatus, sum(pprice) as total_amount, pamount');
        $this->db->group_by(array('fortmate_date', 'packageid'));
        $this->db->order_by('pdate', 'DESC');
        $query = $this->db->get('payments');
        /* echo $this->db->last_query();exit; */
        $result = $query->result();
        return $result;
    }

    public function getpaymentlist()
    {
        $this->db->select("p.*,u.business_name,u.mobile,u.ispaid,u.expdate");
        $this->db->from("payments as p");
        $this->db->join("admin as u", "p.u_id=u.id", "LEFT");
        $this->db->where("p.pprice !=", 0);
        $this->db->where("u.isPaid", 1);
        $this->db->group_by("p.u_id");
        $this->db->order_by("p.pid", "desc");
        /* $this->db->limit(100); */
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getPaidButExpList()
    {
        $this->db->select("p.*,u.business_name,u.mobile,u.ispaid,u.expdate");
        $this->db->from("payments as p");
        $this->db->join("admin as u", "p.u_id=u.id", "LEFT");
        $this->db->where("p.pprice !=", 0);
        $this->db->where("u.isPaid", 0);
        $this->db->group_by("p.u_id");
        $this->db->order_by("p.pid", "desc");
        /* $this->db->limit(100); */
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getTrialpaymentlist()
    {
        $this->db->select("p.*,u.business_name,u.mobile,u.ispaid,u.expdate");
        $this->db->from("payments as p");
        $this->db->join("admin as u", "p.u_id=u.id", "LEFT");
        $this->db->where("p.pprice", 0);
        $this->db->where("u.isPaid", 0);
        $this->db->order_by("p.pid", "desc");
        /* $this->db->limit(100); */
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getUserList()
    {
        $this->db->select('*');
        $this->db->from('admin')->where("ispaid !=", "1");
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getPackageList()
    {
        $this->db->select('*');
        /* $this->db->where("status", 1); */
        $list = $this->db->get("subscriptionPlan");
        return $list->result_array();
    }
    public function insertUserSubPayment($data)
    {
        $this->db->insert('payments', $data);
    }

    public function getListOfOtherNumPayment()
    {
        $this->db->select('*');
        $this->db->from('webhook_authorized');
        $this->db->order_by("web_auth_id", "desc");
        $list = $this->db->get();
        return $list->result_array();
    }
    public function getPaymentFaildList()
    {
        $this->db->select('*');
        $this->db->from('webhook_failed');
        $this->db->order_by("web_fail_id", "desc");
        $this->db->group_by('w_mobile');
        $list = $this->db->get();
        return $list->result_array();
    }

    public function updateById($id, $data)
    {
        $this->db->where('pid', $id);
        $this->db->update('payments', $data);
    }

    public function getRepeatList()
    {
        $this->db->select('p.u_id, count(p.pid) as total, p.pstatus,
        MIN(pdate) as firstDate,
        MAX(pdate) as lastDate,
         a.mobile, a.name');

         if ($this->input->post('pstatus') && $this->input->post('pstatus') != "") {
            $this->db->where('p.pstatus', $this->input->post('pstatus'));
        }

        $this->db->join('admin as a', 'p.u_id = a.id');
        $this->db->group_by(array('p.u_id', 'p.pstatus'));
        $this->db->having('total > 1');
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get('payments as p');
        $result = $query->result();
        return $result;
    }
}
