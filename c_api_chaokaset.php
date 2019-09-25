<?php
    include("connectdb.php");
    #-------------------------[Include]-------------------------#
    require_once('./include/line_class.php');
    require_once('./unirest-php-master/src/Unirest.php');
    #-------------------------[Token]-------------------------#
    $channelAccessToken = 'YhqOTnlfJE6/yjWpkPRNR03ryOXTb7R8QaOVBkVL1Q5zAEhV8xJaMKBgGoLRZcVfA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vyxnO+4kUs2EpOJtHjNpnb9ED5kGu9OFa3G17TukVvILQdB04t89/1O/w1cDnyilFU='; 
    $channelSecret = '83255aed1b77104d01142b5542945438';


    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$channelAccessToken}";
    function pushMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/multicast";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
    $post = $_POST;
    //$status_login = 0;
    $environment =$post['environment']; //สภาพแวดล้อม
    $plant_type =$post['plant_type']; //ชนิดพืช
    $growth_phase =$post['growth_phase']; //ระยะการเจริญเติบโต
    $problem =$post['problem']; //ปัญหา
    $possible_symptoms =$post['possible_symptoms']; //อาการที่อาจพบ
    $prevention =$post['prevention']; //แนวทางป้องกัน
    // $data = array('environment' => "$environment", 'plant_type' => "$plant_type", 'growth_phase' => "$growth_phase",
    //               'problem' => "$problem", 'possible_symptoms' => "$possible_symptoms", 'prevention' => "$prevention" );
    // echo json_encode($data);
    if(isset($environment) && $environment!=''){
        echo "success";
        echo $environment;

    }else{
        echo "not post";
    }
     //$respon =$mapi->insert_review();
     //echo $respon;       
?>