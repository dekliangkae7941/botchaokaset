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
        $queryp = "SELECT * FROM line_plant";
        $resultp = pg_query($dbconn, $queryp);
        $row = pg_fetch_array($resultp);
        $plan_category_name = $row['plan_category_name'];
        $plan_typedb = $row['plan_type'];


        if($plan_typedb == $plant_type){
            $query = "SELECT * FROM line_log";
            if($resultlog = pg_query($dbconn, $query)){
                if(pg_num_rows($resultlog) > 0){
                    while($rowlog = pg_fetch_array($resultlog)){
                    $row = pg_fetch_array($result);
                    $userid = $rowlog['userid'];
                    $plan_category = $rowlog['plan_category'];
                    $rowuserid = 0;
                    
                    if($plan_category_name == $plan_category){
                    //$arrayPostData['replyToken'] = $replyToken;
                    $arrayPostData['to'][$rowuserid] = $userid;
                    $arrayPostData['messages'][0]['type'] = "flex";
                    $arrayPostData['messages'][0]['altText'] = "เตือนภัยเกษตร";
                    $arrayPostData['messages'][0]['contents']['type'] = "bubble";
                    
                    $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "เตือนภัยเกษตร $plan_category";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
                    $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

                    $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "เตือนภัย $plant_type";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;
                    // while($rowmarket = pg_fetch_array($resultmarket)){
                    //     $datacountrowmarket += 1;
                    //     $type_id = $rowmarket['type_id'];
                    //     $type_name = $rowmarket['type_name'];
                    //     $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['type'] = "button";
                    //     $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['style'] = "secondary";
                    //     $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['type'] = "message";
                    //     $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['label'] = "$type_name";
                    //     $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['text'] = "ราคา$type_name";
                
                    // }
                    // pg_free_result($resultmarket);
                    $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
                    $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
                    pushMsg($arrayHeader,$arrayPostData);
//}                
                    }
                    }
                    }
                }
            }
    }else{
        echo "not post";
    }
     //$respon =$mapi->insert_review();
     //echo $respon;       
?>