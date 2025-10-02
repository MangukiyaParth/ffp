<?php
class Mdl_api extends CI_Model
{
    /* declare variable */
    public $defaultHomeCategory = array(

        "0" => array(
            "id" => 585,
            "title" => "Plan Paper for Custom Text",
            "icon" => "red",
        ),
        "1" => array(
            "id" => 4,
            "title" => "Motivation Thoughts",
            "icon" => "",
        ),
        "2" => array(
            "id" => 3,
            "title" => "Birthday Wish",
            "icon" => "",
        ),
        "3" => array(
            "id" => 2,
            "title" => "Good Thoughts",
            "icon" => "",
        ),
        "4" => array(
            "id" => 1,
            "title" => "Morning Thoughts",
            "icon" => "",
        ),
        "5" => array(
            "id" => 6,
            "title" => "Good Night Thoughts",
            "icon" => "",
        ),
        "6" => array(
            "id" => 9,
            "title" => "Anniversary",
            "icon" => "",
        ),
        "7" => array(
            "id" => 50,
            "title" => "Congratulations",
            "icon" => "",
        ),
        "8" => array(
            "id" => 51,
            "title" => "Baby Shower",
            "icon" => "",
        ),
        "9" => array(
            "id" => 52,
            "title" => "Engagement",
            "icon" => "",
        ),
        "10" => array(
            "id" => 98,
            "title" => "Back Soon",
            "icon" => "",
        ),
        "11" => array(
            "id" => 99,
            "title" => "Coming Soon",
            "icon" => "red",
        ),
        "12" => array(
            "id" => 100,
            "title" => "Temporarily Closed",
            "icon" => "red",
        ),
        "13" => array(
            "id" => 101,
            "title" => "Reopen",
            "icon" => "",
        ),
    );

    public function getAppMasterApList($token,$user_id)
    {
        $userStatus = '0';
        $userIsPaid = '0';
        $expdate = '';
        $user_token = '0';
        $userPlanActiveName = "";

        if ($token !="" && $user_id!="") {
            if ($this->checkToken($user_id, $token)) {
                $useris = $this->db->select('ispaid,expdate,status')->where('id', $user_id)->get("admin");
                $tampData = $useris->row_array();
                $expdate = $tampData['expdate'];
                $userStatus = $tampData['status'];
                if($expdate!="" && $expdate!="0000-00-00"){
                    if ($expdate >= ONLY_DATE){
                        $expdate = date("d/m/Y", strtotime($expdate));
                        $userIsPaid = $tampData['ispaid'];
                        
                         /* user no plan je active hoy te last record fetch krine package name get karavu */
                        $this->db->select('p.packageid,s.plan_name');
                        $this->db->from('payments as p');
                        $this->db->join('subscriptionPlan as s','p.packageid=s.plan_id','LEFT');
                        $this->db->where('p.u_id', $user_id);
                        $this->db->order_by('p.pid', "DESC");
                        $this->db->limit(1);
                        $data = $this->db->get();
                        /* echo $this->db->last_query();exit; */
                        $user_pack_id = $data->row_array();
                        $userPlanActiveName = $user_pack_id['plan_name'];
                        /* print_r($user_pack_id);*/

                    }else{
                        /* user date expire then update ispaid status */
                        $ispaidUpdate = array(
                            'ispaid' => '0',
                            /* 'expdate' => null,
                            'planStatus' => null, */
                        );
                        $this->db->where('id', $user_id);
                        $this->db->update('admin', $ispaidUpdate);
                    }
                }
                $user_token = '1';
            }
        }
        $result = array();
        /* $this->db->select('*');
        $this->db->where('status', '1');
        $data = $this->db->get('menu');
        $menu = $data->result_array(); 
        $result['menu'] = $menu;*/

        $allSettingData = $this->getAllSetting();

        $menustatic = array(
            "0"=>array(
                "menu_id"=> "1",
                "title"=> "Help & Support",
                "status"=> $allSettingData['help-support'],
            ),
            "1"=>array(
                "menu_id"=> "2",
                "title"=> "Feedback & Suggestion",
                "status"=> $allSettingData['feedback-suggestion'],
            ),
            "2"=>array(
                "menu_id"=> "3",
                "title"=> "Premium Subscription",
                "status"=> $allSettingData['premium-subscription'],
            ),
            "3"=>array(
                "menu_id"=> "4",
                "title"=> "Refer & Earn",
                "status"=> $allSettingData['refer-earn'],
            ),
            "4"=>array(
                "menu_id"=> "5",
                "title"=> "Complaint Menu",
                "status"=> $allSettingData['complaint_menu'],
            )
        );
        $result['menu'] = $menustatic;
        $result['callnumber'] = $allSettingData['support_call'];
        $result['whatsupnumber'] = $allSettingData['whatsappNumber'];
        $result['userstatus'] = $userStatus;
        $result['userIsPaid'] = $userIsPaid;
        $result['expirydate'] = $expdate;
        $result['userPlanActiveName'] = $userPlanActiveName;
        $result['user_token'] = $user_token;
        $result['forcefullyLogout'] = $allSettingData['forceFullyLogout'];
        $result['paymentTransactionKey1'] = $allSettingData['paymentTKey1'];
        $result['paymentTransactionKey2'] = $allSettingData['paymentTKey2'];
        $result['paymentTransactionSecretkey'] = $allSettingData['secretKey'];
        $result['aboutUs'] = $allSettingData['aboutUs'];
        $result['shareLink'] = $allSettingData['sharingLink'];
        $result['sharingBanner'] = ($allSettingData['sharingBanner']!="")?base_url('media/sharingBanner/').$allSettingData['sharingBanner']:"";
        $result['diffview'] = $allSettingData['diffview'];
        $result['currentDate'] = ONLY_DATE;

        $result['website'] = WEBSITE;
        $result['youtubeUrl'] = YOUTUBEURL;
        
        $date = strtotime(beforeDaysMakePost." day");
        $beforeDaysMakePost = date('Y-m-d', $date);
        $result['beforeDaysMakePost'] = $beforeDaysMakePost;
        
        $result['CustomFreeUserPostLimit'] = CustomFreeUserPostLimit;
        $result['CustomFreeUserVideoLimit'] = CustomFreeUserVideoLimit;
        $result['ratedailogday'] = RATEDAILOGDAY;

        return $result;
    }

    public function getAllSetting()
	{
		$this->db->select('id, option_name,value');
		$query = $this->db->get('setting');
		$qresult = $query->result();
		$result = [];
		foreach ($qresult as $key => $value) {
			$result[$value->option_name] = $value->value;
		}
		return $result;
	}

    public function checkToken($user_id, $token)
	{
		if ($user_id != "" && $token != "") {
			$total = $this->db->select('tid')->where('user_id', $user_id)->where('token', $token)->get("token");
			if ($total->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

    /* 8.makePostByUser_post */
    /* user check paid or not */
    public function userCheckPaidFree($user_id){
        $useris = $this->db->select('ispaid,expdate,status')->where('id', $user_id)->get("admin");
        $tampData = $useris->row_array();
        $expdate = $tampData['expdate'];
        $userStatus = $tampData['status'];
        $userStatus = false;
        if($expdate!="" && $expdate!="0000-00-00"){
            if ($expdate >= ONLY_DATE){
                $userStatus = true;
            }
        }
        return $userStatus;
    }

    public function getTamplateById($id)
    {
        $this->db->select("t.*,p.*");
        $this->db->from("tamplet as t");
        $this->db->join("position as p", 't.p_id=p.pid', 'left');
        $this->db->where("t.tid", $id);
        $list = $this->db->get();
        return $list->row_array();
    }

    public function addUserPost($userNewFileName, $userId, $tamplateId)
    {

        $query = $this->db->select("post")
            ->where('user_id', $userId)
            ->where('tamp_id', $tamplateId)
            ->get('makepost');

        if ($query->num_rows() > 0) {
            $res_post = $query->row_array();

            $filestring = PUBPATH . "media/upload/" . $res_post['post'];
            if (file_exists($filestring)) {
                unlink($filestring);
            }
            $isertData = array(
                "post" => $userNewFileName,
                "updated_at" => CURRENT_DATE,
            );
            $this->db->where('user_id', $userId)->where('tamp_id', $tamplateId)->update('makepost', $isertData);
        } else {
            $isertData = array(
                "user_id" => $userId,
                "tamp_id" => $tamplateId,
                "post" => $userNewFileName,
                "created_at" => ONLY_DATE,
                "updated_at" => CURRENT_DATE,
            );
            $this->db->insert('makepost', $isertData);
        }
    }

    /* 21.userRegisterInsert_post */
    public function addUser($type)
    {
        $this->db->insert('admin', $type);
        return $this->db->insert_id();
    }

    /* 23.5 userSubPaymentHistory_post */
    public function insertUserSubPayment($data)
    {
        $this->db->insert('payments', $data);
    }

    /* webhookPayment_post */
    public function doInsertSubscriptionPlanAutomatic($data)
    {
        $this->db->insert('webhook_authorized', $data);
        return $this->db->insert_id();
    }

    /* webhookPaymentFaild_post */
    public function doInsertSubscriptionPlanFailed($data)
    {
        $this->db->insert('webhook_failed', $data);
        return $this->db->insert_id();
    }

    /* faild payment vala e paid kryu hoy to emnu number delete krvo */
    public function paymentFailUserDeleteIfPaid(){

        $mydata = array();
        $this->db->select("f.web_fail_id ,f.transaction_id,p.ptransactionid");
        $this->db->from("webhook_failed as f");
        $this->db->join("payments as p", 'f.transaction_id=p.ptransactionid', 'INNER');
        $query = $this->db->get();

        $result = $query->result_array();

        $count=0;
        foreach ($result as $item) {
            $this->db->where('web_fail_id', $item['web_fail_id'])->delete('webhook_failed');
            $mydata['totalDelete'] = $count++;
        }
        return $mydata;
    }
}
