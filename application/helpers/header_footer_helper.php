<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('searchForId'))
{
    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['m_id'] === $id) {
                return  1;
            }
        }
        return null;
    }
}

if ( ! function_exists('searchForadvId'))
{
    function searchForadvId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['ads_id'] === $id) {
                return  1;
            }
        }
        return null;
    }
}

if ( ! function_exists('getuseractive'))
{
    function getuseractive($id)
    {   
        $ci = get_instance();
        $ci->load->model('Mdl_login');
        $res = $ci->Mdl_login->getstatus($id);
        if($res) {
            $result = $ci->Mdl_login->getactive($id);
        } else  {
            $result=1;
        }
        return $result;
    }   
}

if ( ! function_exists('getOptionValue'))
{
    function getOptionValue($option)
    {
        $CI = get_instance();
        return $CI->mdl_setting->getValueByOption($option);
    }
}
if ( ! function_exists('changesetting'))
{
    function changesetting()
    {
        $CI = get_instance();
        $CI->mdl_setting->updaterow('otp_accepted',array('value'=>0));
        $CI->mdl_setting->updaterow('noti_accepted',array('value'=>0));
    }
}

function getOptionuserdata()
{       
    $CI =& get_instance();
    $CI->load->model('admin/mdl_users');
    $id = $CI->session->userdata('admin_user_id');
    $membres = $CI->mdl_users->getusersbyid($id);
    return $membres;      
}

if ( ! function_exists('getpermission'))
{
    function getpermission($modul){
        $CI =& get_instance();
        $CI->load->model('admin/mdl_users');
        $id = $CI->session->userdata('role');
        if($id==0) {
            return  1;
        } else {
            $membres = $CI->mdl_setting->getuserpermission($modul,$id);
        }
        return count($membres);
    }
}

if (!function_exists('getUserFullData'))
{
    function getUserFullData($user_id){
        $CI =& get_instance();
        $CI->load->model('admin/mdl_users');
        $membres = $CI->mdl_users->getusersbyid($user_id);
        if(!is_null($membres)){
            return $membres;
        }else{
            return false;
        }
    }
}

if (!function_exists('getUserFullDataByMobile'))
{
    function getUserFullDataByMobile($mobile){
        $CI =& get_instance();
        $mobile = $CI->db->where('mobile', $mobile)->limit(1)->get('admin');
        if($mobile->num_rows() > 0){
            return $mobile->row_array();
        }else{
            return false;
        }
    }
}
if (!function_exists('stringToSlug'))
{
    function stringToSlug($inputString) {
        $modifiedString = strtolower($inputString);
        $modifiedString = str_replace(' ', '_', $modifiedString);
        $modifiedString = preg_replace('/[^a-z0-9_]/', '_', $modifiedString);
        return $modifiedString;
    }
}
if (!function_exists('userPaidStatus'))
{
    function userPaidStatus($ispaid,$planStatus) {
        if($ispaid==1 && $planStatus==2){
            $paidStatus = "Paid";
        }elseif($ispaid==1 && $planStatus==1){
            $paidStatus = "Trial Active";
        }elseif($ispaid==0 && $planStatus==1){
            $paidStatus = "Trial Expired";
        }elseif($ispaid==0 && $planStatus==2){
            $paidStatus = "Paid Expired";
        }else{
            $paidStatus = "Free";
        }
        return $paidStatus;
    }
}
if (!function_exists('countHour'))
{
    function countHour($date) {
        // Your start and end dates as strings
        $startDateTime = $date;
        $endDateTime = date("Y-m-d H:i:s");

        // Create DateTime objects from the strings
        $start = new DateTime($startDateTime);
        $end = new DateTime($endDateTime);

        // Calculate the difference (interval) between the two DateTime objects
        $interval = $start->diff($end);

        // Get the total hours and minutes
        $totalHours = $interval->h + ($interval->days * 24);
        $minutes = $interval->i;
        $result = array();
        if($totalHours < 24){
            $result['time'] = $totalHours.":".$minutes;
            $result['status'] = true;
        }else{
            $result['time'] = 0;
            $result['status'] = false;
        }
        return $result;
    }
}