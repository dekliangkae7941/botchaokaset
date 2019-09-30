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
    $group =$post['group'];
    // $data = array('environment' => "$environment", 'plant_type' => "$plant_type", 'growth_phase' => "$growth_phase",
    //               'problem' => "$problem", 'possible_symptoms' => "$possible_symptoms", 'prevention' => "$prevention" );
    // echo json_encode($data);
    if(isset($environment) && $environment!='' && $plant_type!='' && $growth_phase!='' && $problem!='' && $possible_symptoms!='' && $prevention!=''){
        echo "success";
        //$queryp = "SELECT * FROM line_plant WHERE plant_type = '$plant_type' ";
       // $resultp = pg_query($dbconn, $queryp);
        //$row = pg_fetch_array($resultp);
        //while($row = pg_fetch_array($resultp)){
        //$plant_category_name = $row['plant_category_name'];
        $query = "SELECT * FROM line_log WHERE plan_category = '$group'";
            if($resultlog = pg_query($dbconn, $query)){
                if(pg_num_rows($resultlog) > 0){
                    while($rowlog = pg_fetch_array($resultlog)){
                    //$row = pg_fetch_array($result);plan_category = '$plan_category_name' and 
                    $userid = $rowlog['userid'];
                    $plan_category = $rowlog['plan_category'];
                    $rowtext = 0;
                    //$arrayPostData['replyToken'] = $replyToken;
                    $arrayPostData['to'][0] = $userid;
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
                    pushMsg($arrayHeader,$arrayPostData);
//}                
                    }
                  
                
            }
        }
    }else{
        echo "not post";
    }
     //$respon =$mapi->insert_review();
     //echo $respon;       
?>