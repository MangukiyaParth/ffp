<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('push_notification_by_status')) {
  function push_notification_by_status($mid, $title)
  {
    $message = "";
    $icone = "";
    $title = "";
    switch ($title) {
      case 'result_message':
        $message = '<font color="#ce0000">તમારા બાળક નું આ વર્ષ નું સ્કૂલ નું રિજલ્ટ માં કઈક ભૂલ આવી છે તો એના માટે તમને મેસેજ કરવામાં આવ્યો છે જેને જોવા માટે એપ્લિકેશન માં Student Result માં Message માં લખેલું છે.</font><br>';
        $icone = "";
        $title = '<font color="#ce0000">તમારા બાળક નું આ વર્ષ નું સ્કૂલ નું રિજલ્ટ માં કઈક ભૂલ આવી છે</font><br>';
        break;
      case 'result_accepted':
        $message = '<p><font color="#6ba54a">તમારા બાળક નું આ વર્ષ નું સ્કૂલ નું રિજલ્ટ સ્વીકારવામાં આવું છે.</font><br></p>';
        $icone = "";
        $title = '<p><font color="#6ba54a">તમારા બાળક નું આ વર્ષ નું સ્કૂલ નું રિજલ્ટ સ્વીકારવામાં આવું છે.</font><br></p>';
        break;
      case 'member_ads':
        $message = 'તમારા ધંધા ની Ads(એડવટાઈઝ) સ્વીકારવામાં આવી છે. અને વેબસાઈટ પર Display કરવામાં આવી છે.';
        $icone = "";
        $title = '<p><font color="#6ba54a">તમારા ધંધા ની Ads(એડવટાઈઝ) સ્વીકારવામાં આવી છે.</font><br></p>';
        break;
      case 'member_ads_status_A':/*member ads active*/
        $message = '<p>તમારા ધંધા ની Ads(એડવટાઈઝ) ને વેબસાઈટ પર Display કરવામાં આવી છે.<br></p>';
        $icone = "";
        $title = '<p>Ads(એડવટાઈઝ) Active.<br></p>';
        break;
      case 'member_ads_status_D':/*member ads deactive*/
        $message = '<p>તમારા ધંધા ની Ads(એડવટાઈઝ) ને વેબસાઈટ પર Display પર થી હટાવી દેવામાં આવી છે.<br></p>';
        $icone = "";
        $title = '<p><font color="#ce0000">Ads(એડવટાઈઝ) Deactive.</font><br></p>';
        break;
      case 'sponsorship':
        $message = '<font color="#6ba54a">તમારા ધંધા ની Sponsorship સ્વીકારવામાં આવી છે. અને ટૂક સમય માં તમારો કોંટેક્ટ કરવામાં આવશે.</font><br>';
        $icone = "";
        $title = '<font color="#6ba54a">તમારા ધંધા ની Sponsorship સ્વીકારવામાં આવી છે.</font>';
        break;
      case 'donor':
        $message = '<font color="#6ba54a">કાર્યક્રમ ના દાતાશ્રીઓ માટેનું તમારું દાન સ્વીકારવામાં આવું છે. તમારો ખૂબખૂબ આબાર.</font><br>';
        $icone = "";
        $title = '<font color="#6ba54a">કાર્યક્રમ ના દાતાશ્રીઓ માટેનું તમારું દાન સ્વીકારવામાં આવું છે.</font><br>';
        break;
      case 'notice_add':/*all ne send*/
        $message = '<font color="#6ba54a">હણોલ ગામ ના સ્નેહ મિલન માટે ની Notice જાહેર કરવામાં આવી છે. જેને જોવા માટે એપ્લિકેશન માં Notice Board મેનૂ પર ક્લિક કરો.</font><br>';
        $icone = "";
        $title = '<font color="#6ba54a">હણોલ ગામ ના સ્નેહ મિલન માટે ની Notice જાહેર કરવામાં આવી છે.</font><br>';
        break;
      case 'student_result_accepted_setting':/*option setting active / all ne send*/
        $message = '<p>હણોલ ગામ એપ્લિકેશન દ્વારા તમારા બાળક નું આ વર્ષ નું સ્કૂલ નું રિજલ્ટ&nbsp; નો ફોટો અને એના માર્કસ મોકલી આપો.</p><ul><li>Student મેનૂ માં વિધાર્થી ની માહિતી ફોટા સાથે ભરો.</li><li>Student Result મેનૂ માં વિધાર્થી ની માર્કશીટ નો ફોટો મોકલો.</li></ul><p><br></p><p><font color="#ce0000">નોંધ : તમામ માહિતી માર્કશીટ માં હોય તે જ આપવી. સાચી માહિતી હશે તો વિધાર્થી&nbsp; નું રિજલ્ટ સ્વીકારવામાં આવશે, અને તમારા મોબાઇલ માં મેસેજ આવી જશે, જો માહિતી ખોટી હશે તો સ્વીકારવામાં આવશે નહીં, એપ્લિકેશન માં મેસેજ આવશે, અને ફરી માહિતી સુધારી ને બીજી વાર મોકલી શકો.</font><br></p>';
        $icone = "";
        $title = '<p><font color="#6ba54a">સ્નેહ મિલન માટે વિધાર્થી ના સ્કૂલ ના રિજલ્ટ મોકલવાનો ટાઇમ આવી ગયો.</font></p>';
        break;
      case 'sponsor_accepted_setting':/*option setting active / all ne send*/
        $message = '<font color="#6ba54a">હણોલ ગામ ના સ્નેહ મિલન માટે તમારા ધંધા ની Sponsorship આપી શકો છો. Sponsorship આપવા માટે એપ્લિકેશન માં Sponsorship મેનૂ માં જઈને આપી શકશો. એને સ્વીકારવામાં આવશે એટલે તમને Notification આવી જશે ને, તરત તમારો કોંટેક્ટ કરવામાં આવશે.</font>';
        $icone = "";
        $title = '<font color="#6ba54a">હવે તમે&nbsp; હણોલ ગામ ના સ્નેહ મિલન માટે તમારા ધંધા ની Sponsorship આપી શકો છો.</font><br>';
        break;
      case 'donor_accepted_setting':/*option setting active / all ne send*/
        $message = 'હણોલ ગામ ના સ્નેહ મિલન માટે કાર્યક્રમ ના દાતાશ્રીઓ માટેનું તમારું દાન આપી શકો છો. દાન આપવા માટે એપ્લિકેશન માં Donor મેનૂ માં જઈને આપી શકશો. એને સ્વીકારવામાં આવશે એટલે તમને Notification આવી જશે ને, તરત તમારો કોંટેક્ટ કરવામાં આવશે.';
        $icone = "";
        $title = '<font color="#6ba54a">હણોલ ગામ ના સ્નેહ મિલન માટે કાર્યક્રમ ના દાતાશ્રીઓ માટેનું તમારું દાન આપી શકો છો.</font><br>';
        break;
      case 'people_accepted_setting':/*total member ketla avana che te / option setting active / all ne send*/
        $message = '<font color="#6ba54a">હણોલ ગામ ના સ્નેહ મિલન માટે નું આયોજન જાળવી રાખવા માટે તમને તમારા ઘરેથી કેટલા સભ્યો આ પ્રસંગ માં આવી શકે એમ છે તો એનો જવાબ તમે એપ્લિકેશન માં Member Accepted મેનૂ માં જઈને એમાં આવાના હોય એટલા સભ્યો ની સંખ્યા લખી Submit પર ક્લિક કરો.</font><br>';
        $icone = "";
        $title = '<font color="#ce0000">હણોલ ગામ ના સ્નેહ મિલન માં તમારા ઘરેથી કેટલા સભ્યો આ પ્રસંગ માં આવી શકે એમ છે?</font><br>';
        break;
      case 'help_desk':/* all ne send*/
        $message = '<font color="#6ba54a">Help મેનૂ માં કઈક નવું અપડેટ કરવામાં આવું છે. એને જોવા માટે Help મેનૂ પર ક્લિક કરો.</font><br>';
        $icone = "";
        $title = '<font color="#6ba54a">Help મેનૂ માં કઈક નવું અપડેટ કરવામાં આવું છે.</font><br>';
        break;

      default:
        $message = "";
        $icone = "";
        $title = "";
        break;
    }

    $dataa = array(
      'body' => $message,
      'icon' => $icone,
      'title' => $title,
      'ValueType' => ",",
    );
    push_notification_android($mid, $dataa);
  }
}

if (!function_exists('push_notification_test')) {
  function push_notification_test($message)
  {
    $tokens = array
    (
      "0" => "dNhuWnc3SUKkHz4DuRb71C:APA91bGPevdS_Yf3ucQUCiOHgdPrHT-IuE1iVsE6dQhlSAx6Oa3Q1HMZq7tswQ0knzpFveouD7_b5DFmLPgWjVj7RW9jG3yoM5bJcGEfHrBY-K5KFVUcr83e5QfDzYr1L2-UgJ-r15wj",
    );
    send_app_notification($tokens, $message);
    return $result;
  }
}


if (!function_exists('push_notification_android')) {
  function push_notification_android($message,$userFilter)
  {

      $result = array();
      $CI = &get_instance();

      /* only one device - testing */
      if($userFilter=="7"){
        $CI->db->select("token")->where("device_id","57b03281286bc5bc");
        $token = $CI->db->get('notification');
        $token_result = $token->row_array();

        $tokens = array
        (
          "0" => $token_result['token'],
        );
        $result = send_app_notification($tokens, $message);
      }else{

        $perPageLimit = 500;
        $totalCount = 0;
        $data = array();

        /* all user */
        if($userFilter==""){
          $CI->db->select("token")->from("notification")->where("token !=","");
          $totalCount = $CI->db->count_all_results();
        }

        /* Expried Trial - 5 --- Expried Paid - 6 --- Active Trial User - 3 ---- Active Paid User - 2   total free user -8 */
        if($userFilter=="5" || $userFilter=="6" || $userFilter=="3" || $userFilter=="2" || $userFilter=="8"){
          
          $CI->db->select("n.token");
          $CI->db->from("notification as n");
          $CI->db->join("admin as a","n.user_id=a.id","Left");
          $CI->db->where("n.user_id !=",0);
          $CI->db->where("n.token !=","");
          $CI->db->where("a.status",1);

          if($userFilter=="5"){
            $CI->db->where("a.ispaid",0);
            $CI->db->where("a.planStatus",1);
          }
          
          if($userFilter=="3"){
            $CI->db->where("a.ispaid",1);
            $CI->db->where("a.planStatus",1);
          }

          if($userFilter=="2"){
            $CI->db->where("a.ispaid",1);
            $CI->db->where("a.planStatus",2);
          }
          
          if($userFilter=="6"){
            $CI->db->where("a.ispaid",0);
            $CI->db->where("a.planStatus",2);
          }

          if($userFilter=="8"){
            $CI->db->where("a.ispaid",0);
            $CI->db->where("a.planStatus",null);
          }
          /* $res = $CI->db->get();
          echo $CI->db->last_query();
          $totalCountRe = $res->result_array(); */
          $totalCount = $CI->db->count_all_results();
        }
        /* print_r($totalCountRe);exit; */


        /* Without Logo - 4 */
        if($userFilter=="4"){
          $CI->db->select("n.token");
          $CI->db->from("notification as n");
          $CI->db->join("admin as a","n.user_id=a.id","Left");
          $CI->db->where("n.user_id !=",0);
          $CI->db->where("a.photo","");
          $CI->db->where("n.token !=","");

          $totalCount = $CI->db->count_all_results();

        }


        /* New User (Last 3 days user) - 1*/
        if($userFilter=="1"){

          $NewDate = Date('Y-m-d H:i:s', strtotime('-3 days'));

          $CI->db->select("n.token");
          $CI->db->from("notification as n");
          $CI->db->join("admin as a","n.user_id=a.id","Left");
          $CI->db->where("n.user_id !=",0);
          $CI->db->where('created_date >',$NewDate);
          $CI->db->where("n.token !=","");

          $totalCount = $CI->db->count_all_results();
        }

        $totalPage = ceil($totalCount / $perPageLimit);
        for ($i=0; $i < $totalPage; $i++) { 

            /* all user */
          if($userFilter==""){
            $CI->db->select("token")->from("notification")->where("token !=","");
          }


          /* Expried Trial - 5 --- Expried Paid - 6 --- Active Trial User - 3 ---- Active Paid User - 2   total free user -8 */
        if($userFilter=="5" || $userFilter=="6" || $userFilter=="3" || $userFilter=="2" || $userFilter=="8"){

            $CI->db->select("n.token");
            $CI->db->from("notification as n");
            $CI->db->join("admin as a","n.user_id=a.id","Left");
            $CI->db->where("n.user_id !=",0);
            $CI->db->where("n.token !=","");
            $CI->db->where("a.status",1);

            if($userFilter=="5"){
              $CI->db->where("a.ispaid",0);
              $CI->db->where("a.planStatus",1);
            }
            
            if($userFilter=="3"){
              $CI->db->where("a.ispaid",1);
              $CI->db->where("a.planStatus",1);
            }
            
            if($userFilter=="2"){
              $CI->db->where("a.ispaid",1);
              $CI->db->where("a.planStatus",2);
            }

            if($userFilter=="6"){
              $CI->db->where("a.ispaid",0);
              $CI->db->where("a.planStatus",2);
            }

            if($userFilter=="8"){
              $CI->db->where("a.ispaid",0);
              $CI->db->where("a.planStatus",null);
            }

          }


          /* Without Logo - 4 */
          if($userFilter=="4"){
            $CI->db->select("n.token");
            $CI->db->from("notification as n");
            $CI->db->join("admin as a","n.user_id=a.id","Left");
            $CI->db->where("n.user_id !=",0);
            $CI->db->where("a.photo","");
            $CI->db->where("n.token !=","");
          }


          /* New User (Last 3 days user) - 1*/
          if($userFilter=="1"){

            $NewDate = Date('Y-m-d H:i:s', strtotime('-3 days'));
            $CI->db->select("n.token");
            $CI->db->from("notification as n");
            $CI->db->join("admin as a","n.user_id=a.id","Left");
            $CI->db->where("n.user_id !=",0);
            $CI->db->where('created_date >',$NewDate);
            $CI->db->where("n.token !=","");

          }


          $CI->db->limit($perPageLimit, $i * $perPageLimit);
          
          $token = $CI->db->get();
          
          $token_result = $token->result_array();
          /* echo $CI->db->last_query(); */
          $tokens = array_column($token_result, 'token');
          /* print_r($tokens); */
          $result = send_app_notification($tokens, $message);
        }
      }
      return $result;
  }    
}

/* function notificationCount() {
  $CI = &get_instance();
  $CI->db->select("token")->where("token !=","");
  return $CI->db->count_all_results("notification");
} */

/*helper function*/
function send_app_notification($token, $message)
{
  $api_key = 'AAAAFNMpGdE:APA91bHpoEEUU4MHQWjYb6yTNJslLlegQhqaNnb90y4Yrtf9M9jYb8ErtwnjbT66xs4hbRbFZSkaP_j7cL9xFPz_ji2sOeyKMSoQxFzjtCjGjFImDypajPVoWyPUo144MNxNsIPuHypO';

  /*
  techbit7@ firebase key
  AAAAFNMpGdE:APA91bHpoEEUU4MHQWjYb6yTNJslLlegQhqaNnb90y4Yrtf9M9jYb8ErtwnjbT66xs4hbRbFZSkaP_j7cL9xFPz_ji2sOeyKMSoQxFzjtCjGjFImDypajPVoWyPUo144MNxNsIPuHypO	
 */

 /* moradiyasandip99 account firebase key 
 AAAAKA2jIow:APA91bF7MqLJps90ZIWphbf0OaZdvBTgSsZCihCdQxDQfaRQtV3ak-DXP9l5HH1-Qd0s7q3ihicDi9tk6ptd7nfUGEjkkSY3fU8Imtfn1BJM1WAPwIuwl62tUFbqcMQXYyMwS7hZQZFe
 */

  /* $fields = array(
    'registration_ids' => $token,
    'data' => json_encode($message),
  );

  $headers = array(
    'Content-Type:application/json',
    'Authorization:key=' . $api_key
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  $result = curl_exec($ch);
  if ($result === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
  }
  curl_close($ch); */
  /*  $msg = array(
    'message'   => 'here is a message. message',
    'title'    => 'This is a title. title',
    'subtitle'  => 'This is a subtitle. subtitle',
    'tickerText'  => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'  => 1,
    'sound'    => 1,
    'largeIcon'  => 'large_icon',
    'smallIcon'  => 'small_icon'
  ); */

  $notification = array(
    'body' => $message['body'],
    'title' => $message['title'],
  );

  $fields = array(
    'registration_ids' => $token,
    'data' => $message,
    'notification' => $notification,
    /* "click_action"=> "FLUTTER_NOTIFICATION_CLICK", */
  );

  $headers = array(
    'Authorization: key=' . $api_key,
    'Content-Type: application/json'
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  $result = curl_exec($ch);

  curl_close($ch);
  return $result;
}
