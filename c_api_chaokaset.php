<?php
    $post = $_POST;
    //$status_login = 0;
    $environment =$post['environment']; //สภาพแวดล้อม
    $plant_type =$post['plant_type']; //ชนิดพืช
    $growth_phase =$post['growth_phase']; //ระยะการเจริญเติบโต
    $problem =$post['problem']; //ปัญหา
    $possible_symptoms =$post['possible_symptoms']; //อาการที่อาจพบ
    $prevention =$post['prevention']; //แนวทางป้องกัน
    $group =$post['group'];
 #-------------------------[Include]-------------------------#
 include "connectdb.php";
 require_once('./include/line_class.php');
 require_once('./unirest-php-master/src/Unirest.php');
 #-------------------------[Token]-------------------------#
 $channelAccessToken = 'SUmLfYZ8t8MIO/DqtQtGrt8cusyPvPDyjDcw6TG1mCOadegMAh+bPOF99IMRBIwDA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vxCtlvPx+4cV3zo9neI1msXvhbzz87r71YdIkPujGqNAgdB04t89/1O/w1cDnyilFU='; 
 $channelSecret = 'b80c29dab1824c3acfbc9d0fab03e95f';

 $content = file_get_contents('php://input');
 $arrayJson = json_decode($content, true);
 $arrayHeader = array();
 $arrayHeader[] = "Content-Type: application/json";
 $arrayHeader[] = "Authorization: Bearer {$channelAccessToken}";

 #-------------------------[Func]-------------------------#
 function pushbMsg($arrayHeader,$arrayPostData){
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
 if(isset($environment) && $environment!='' && $plant_type!='' && $growth_phase!='' && $problem!='' && $possible_symptoms!='' && $prevention!=''){
     echo "success";
     echo $header;
     echo $main;
     echo $title;
     echo $des;
     $query = "SELECT * FROM bot_log WHERE user_plant_category = '$group'";
     $result = $mysql->query($query);
     while($row = mysqli_fetch_assoc($result)){
         $user_id = $row['user_id'];
         echo $user_id;
            $user_id = $row['user_id'];
            $user_plant_category = $row['user_plant_category'];
            $rowtext = 0;
            //$arrayPostData['replyToken'] = $replyToken;
            $arrayPostData['to'][0] = $user_id;
            $arrayPostData['messages'][0]['type'] = "flex";
            $arrayPostData['messages'][0]['altText'] = "เตือนภัยเกษตร";
            $arrayPostData['messages'][0]['contents']['type'] = "bubble";
            
            $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
            $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
            $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "เตือนภัย$group";
            $arrayPostData['messages'][0]['contents']['header']['contents'][0]['color'] = "#ffffff";
            $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
            $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

            $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
            $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
            $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$plant_type";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "xxl";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "สภาพแวดล้อม : $environment";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
            //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "ระยะการเจริญเติบโต : $growth_phase";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
            //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "ปัญหาที่ควรระวัง : $problem";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
            //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "อาการที่อาจพบ : $possible_symptoms";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
            //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "แนวทางป้องกัน : $prevention";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
            //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
            $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
            $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
            $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
            $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
            $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
            $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#EA3535";
            //$rowuserid += 1;
            pushbMsg($arrayHeader,$arrayPostData);
//}                
        }
    }else{
        echo "not post";
    }
     //$respon =$mapi->insert_review();
     //echo $respon;       
?>