<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getvaluecheck')) {
    function editchk($id, $name, $where, $table)
    {
        $title = array_keys($where);
        $ids = array_keys($id);
        $data = array();
        $i = 0;
        $CI = get_instance();
        $rec = $CI->mdl_setting->geteditbyid($id, $table);
        $tot = $CI->mdl_setting->checkeditname($where, $table);

        if ($tot) {
            foreach ($tot as $key) {
                if ($key[$title[0]] == $rec[$title[0]]) {
                    if ($key[$ids[0]] == $rec[$ids[0]]) {
                        $n = 0;
                    } else {
                        $n = 0;
                    }
                } else {
                    $n = 1;
                }
            }
        } else {
            $n = 0;
        }
        return $n;
    }
}

if (!function_exists('search')) {
    function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, search($subarray, $key, $value));
            }
        }

        return $results;
    }
}

if (!function_exists('slug_string')) {
    function slug_string($string)
    {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}
if (!function_exists('clear_cache')) {
    function clear_cache()
    {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.freefestivalpost.in/v1/clear-cache',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "device_id":"7db51a46067b07b3"
    }',
    CURLOPT_HTTPHEADER => array(
        'DeviceDetails: { "osVersion":"23" }',
        'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    /* echo $response; */
    }
}
