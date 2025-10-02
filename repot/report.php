<?php
if(!empty($_REQUEST["data"])){
    $request = $_REQUEST["data"]; 
    $jsonData = json_decode($request);
    $request_id = $jsonData->requestId;
    $details = $jsonData->numbers;
    $array = json_decode(json_encode($details), true);
    $link = mysqli_connect("localhost", "techbpku_busines", "v~RneT^7oFc5", "techbpku_business") or die("Error " . mysqli_error($link));
    /* foreach ($array as $number => $value) {
         $status = $value["status"];
            $reciever_number = $number;
             $desc = $value["desc"];
            $recieving_date = $value["date"];
            $query = "INSERT INTO sms_report (`request_id`,`date`,`receiver`,`status`,`description`) VALUES ('" . $request_id ."','" . $recieving_date . "','" . $reciever_number . "','" . $status . "','" . $desc . "')";
            $result = $link->query($query);
    } */
}
?>