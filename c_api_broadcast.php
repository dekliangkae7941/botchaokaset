<?php
    $post = $_POST;
    //$status_login = 0;
    $header =$post['header']; //สภาพแวดล้อม
    $main  =$post['main']; //ระยะการเจริญเติบโต
    $title =$post['title']; //ชนิดพืช
    $des =$post['des']; //ระยะการเจริญเติบโต
    //$body2 =$post['body2']; //ปัญหา
    //แนวทางป้องกัน
    // $data = array('environment' => "$environment", 'plant_type' => "$plant_type", 'growth_phase' => "$growth_phase",
    //               'problem' => "$problem", 'possible_symptoms' => "$possible_symptoms", 'prevention' => "$prevention" );
    // echo json_encode($data);
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
    if(isset($header) && $header!='' && $header!='' && $main!='' && $title!='' && $des!=''){
        echo "success";
        echo $header;
        echo $main;
        echo $title;
        echo $des;
        $query = "SELECT * FROM bot_log WHERE user_id = 'Udac6e87952f7ba83e230875996a1107f' ";
        $result = $mysql->query($query);
        while($row = mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            echo $user_id;
            $arrayPostData['to'][0] = $user_id;
            $arrayPostData['messages'][0]['type'] = "flex";
            $arrayPostData['messages'][0]['altText'] = "broadcast";
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
            $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "$main";
            $arrayPostData['messages'][0]['contents']['body']['contents'][0]['size'] = "xxl";
            $arrayPostData['messages'][0]['contents']['body']['contents'][0]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$title";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "lg";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
            $rowtext += 1;
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$des";
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
            $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#9545E5";
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