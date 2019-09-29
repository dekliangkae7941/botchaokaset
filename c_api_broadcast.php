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
    $post = $_POST;
    //$status_login = 0;
    $header =$post['header']; //สภาพแวดล้อม
    $main  =$post['main']; //ระยะการเจริญเติบโต
    $title =$post['title']; //ชนิดพืช
    $body1 =$post['body1']; //ระยะการเจริญเติบโต
    $body2 =$post['body2']; //ปัญหา
    //แนวทางป้องกัน
    // $data = array('environment' => "$environment", 'plant_type' => "$plant_type", 'growth_phase' => "$growth_phase",
    //               'problem' => "$problem", 'possible_symptoms' => "$possible_symptoms", 'prevention' => "$prevention" );
    // echo json_encode($data);
    if(isset($header) && $header!=''){
        echo "success";
        $query = "SELECT * FROM line_log";
            if($resultlog = pg_query($dbconn, $query)){
                if(pg_num_rows($resultlog) > 0){
                    while($rowlog = pg_fetch_array($resultlog)){
                    //$row = pg_fetch_array($result);plan_category = '$plan_category_name' and 
                    $userid = $rowlog['userid'];
                    $rowtext = 0;
                    //$arrayPostData['replyToken'] = $replyToken;
                    $arrayPostData['to'][0] = $userid;
                    $arrayPostData['messages'][0]['type'] = "flex";
                    $arrayPostData['messages'][0]['altText'] = "เตือนภัยเกษตร";
                    $arrayPostData['messages'][0]['contents']['type'] = "bubble";
                    
                    $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "$header";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['color'] = "#ffffff";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

                    $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$main";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "xxl";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
                    $rowtext += 1;
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$title";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
                    //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
                    $rowtext += 1;
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$body1";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "md";
                    //$arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
                    $rowtext += 1;
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$body2";
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
                    $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#7725C8";
                    //$rowuserid += 1;
                    pushbMsg($arrayHeader,$arrayPostData);
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