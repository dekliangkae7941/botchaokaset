<?php
    include "bot_header.php";
    include "admin/connectdb.php";

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
    if(isset($header) && $header!='' && $header!='' && $main!='' && $title!='' && $des!=''){
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
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "text";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['text'] = "$main";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['size'] = "xxl";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['weight'] = "bold";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['wrap'] = true;
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