<?php

        /*elseif($command == 'แมว'){
            //$ct = 1;
            $uri = "https://chaokaset.openservice.in.th/index.php/priceservices/getsubType/1";
            $response = Unirest\Request::get("$uri");
            $json = json_decode($response->raw_body, true);
            $resultsid = $json['subtype_id'];
            $resultasname = $json['subtype_name'];
            $resultatid = $json['type_id'];
            $text .= " เลขที่ชนิด : " . $resultsid . "\n";
            $text .= " ชื่อชนิด : " . $resultasname . "\n";
            $text .= " เลขที่กลุ่ม : " . $resultatid;
            $mreply = array(
                'replyToken' => $replyToken,
                'messages' => array(
                    array(
                        /*'type' => 'location',
                        'title' => $msg_title,
                        'address' => $msg_address,
                        'latitude' => $msg_latitude,
                        'longitude' => $msg_longitude
                    ),            array(
                        'type' => 'text',
                        'text' => $text
                    )
                )
            );
    }*/
    if ($command == 'ราคาผัก') {
        $categoryid = 1;
        //$type_id = 0;
    }
    elseif ($command == 'ราคาผลไม้') {
        $categoryid = 2;
        ///$type_id = 0;
    }
    elseif ($command == 'ราคาสัตว์น้ำ') {
        $categoryid = 3;
        //$type_id = 0;
    }
    elseif ($command == 'ราคาปศุสัตว์') {
        $categoryid = 4;
        //$type_id = 0;
    }
    elseif ($command == 'ราคาข้าว') {
        $categoryid = 5;
        //$type_id = 0;
    }
    elseif ($command == 'ราคาพืชเศรษฐกิจ') {
        $categoryid = 6;
        //$type_id = 0;
    }
    elseif ($command == 'ราคาดอกไม้') {
        $categoryid = 7;
        //$type_id = 0;
    }
    
    /////////////////////////////////
        $querymarket = "SELECT * FROM line_type WHERE category_id = '$categoryid'";
        if($resultmarket = pg_query($dbconn, $querymarket)){
            if(pg_num_rows($resultmarket) > 0){
                $arrayPostData['replyToken'] = $replyToken;
                //$arrayPostData['to'] = $uid;
                $arrayPostData['messages'][0]['type'] = "flex";
                $arrayPostData['messages'][0]['altText'] = "$command";
                $arrayPostData['messages'][0]['contents']['type'] = "bubble";
                
                $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "$command";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

                $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "กรุณาเลือกประเภทของ$command ";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;
                $datacountrowmarket = 0;
                while($rowmarket = pg_fetch_array($resultmarket)){
                    $datacountrowmarket += 1;
                    $type_id = $rowmarket['type_id'];
                    $type_name = $rowmarket['type_name'];
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['type'] = "button";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['style'] = "secondary";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['type'] = "message";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['label'] = "$type_name";
                    $arrayPostData['messages'][0]['contents']['body']['contents'][$datacountrowmarket]['action']['text'] = "ราคา$type_name";
            
                }
                pg_free_result($resultmarket);
                $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
                $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
                replyMsg($arrayHeader,$arrayPostData);
                        }
            }
            
            /*$command = $c;
            if ($command == $c) {
                $typename = $type_name;
            }
            $querytype = "SELECT line_subtype.type_id,line_type.type_id,line_type.type_name,line_subtype.subtype_name , line_subtype.subtype_id FROM line_subtype RIGHT JOIN line_type ON line_subtype.type_id = line_type.type_id
            WHERE line_type.type_name = '$typename'";
                //$querytype = "SELECT * FROM line_subtype WHERE type_id = '$typeid'";
                if($resulttype = pg_query($dbconn, $querytype)){
                    if(pg_num_rows($resulttype) > 0){
                        
                        */
                        
                        //}       
                    //}
    ////////////////////////////
    elseif ($command == "ราคากระเทียม") {
        $typeid = 1;
    }
    elseif ($command == "ราคากล้วย") {
        $typeid = 2;
    }
    elseif ($command == "ราคากุ้ง") {
        $typeid = 3;
    }
    elseif ($command == "ราคาไก่") {
        $typeid = 4;
    }
    elseif ($command == "ราคาข้าวเปลือกเจ้า") {
        $typeid = 5;  
    }
    elseif ($command == "ราคาข้าวเปลือกเหนียว") {
        $typeid = 6; 
    }
    elseif ($command == "ราคาข้าวโพดฝักอ่อน") {
        $typeid = 7;
    }
    elseif ($command == "ราคาข้าวโพด") {
        $typeid = 8;
    }
    elseif ($command == "ราคาไข่") {
        $typeid = 9;
    }
    elseif ($command == "ราคาเงาะ") {
        $typeid = 10;
    }
    elseif ($command == "ราคาดอกรัก") {
        $typeid = 11;  
    }
    elseif ($command == "ราคาดาวเรือง") {
        $typeid = 12; 
    }
    elseif ($command == "ราคาถั่วเขียว") {
        $typeid = 13;
    }
    elseif ($command == "ราคาถั่วฝักยาว") {
        $typeid = 14;
    }
    elseif ($command == "ราคาถั่วเหลือง") {
        $typeid = 15;
    }
    elseif ($command == "ราคาทุเรียน") {
        $typeid = 16;
    }
    elseif ($command == "ราคาปลา") {
        $typeid = 17;  
    }
    elseif ($command == "ราคาปาล์มน้ำมัน") {
        $typeid = 18; 
    }
    elseif ($command == "ราคาเป็ด") {
        $typeid = 19;
    }
    elseif ($command == "ราคาผักชี") {
        $typeid = 20;
    }
    elseif ($command == "ราคามะนาว") {
        $typeid = 21;
    }
    elseif ($command == "ราคามะพร้าว") {
        $typeid = 22;
    }
    elseif ($command == "ราคามะละกอ") {
        $typeid = 23;  
    }
    elseif ($command == "ราคามะลิ") {
        $typeid = 24; 
    }
    elseif ($command == "ราคามังคุด") {
        $typeid = 25;
    }
    elseif ($command == "ราคามันสำปะหลัง") {
        $typeid = 26;
    }
    elseif ($command == "ราคายางพารา") {
        $typeid = 27;
    }
    elseif ($command == "ราคาลองกอง") {
        $typeid = 28;
    }
    elseif ($command == "ราคาสัปะรด") {
        $typeid = 29;  
    }
    elseif ($command == "ราคาสุกร") {
        $typeid = 30; 
    }
    elseif ($command == "ราคาหน่อไม้ฝรั่ง") {
        $typeid = 31;
    }
    elseif ($command == "ราคาหอมแดง") {
        $typeid = 32;
    }
    elseif ($command == "ราคาเห็ด") {
        $typeid = 33;
    }
    elseif ($command == "ราคาเบญจมาศ") {
        $typeid = 34;
    }
        $querytype = "SELECT * FROM line_subtype WHERE type_id = '$typeid'";
        if($resulttype = pg_query($dbconn, $querytype)){
            if(pg_num_rows($resulttype) > 0){
                $querylog = "SELECT * FROM line_log WHERE userid = '$userId'";
                $resultlog = pg_query($dbconn, $querylog);
                $rowlog = pg_fetch_array($resultlog);
                $latitude = $rowlog['latitude'];
                $longitude = $rowlog['longitude'];
                
                if($latitude == NULL && $longitude == NULL){
                    $text = "กรุณาอนุญาตการเข้าถึงที่อยู่ตำแหน่งของคุณ โดยการกดปุ่มระบุตำแหน่งด้านล่าง เพื่อบันทึกที่อยู่ของท่าน";
                    $mreply = array(
                        'replyToken' => $replyToken,
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $text,
                                'quickReply' => array(
                                    'items' => array(
                                        array(
                                        'type' => 'action',
                                        'action' => array(
                                            'type' => 'location',
                                            'label' => 'กดเพื่อระบุตำแหน่งของท่าน'
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    ); 
                }else{
                $arrayPostData['replyToken'] = $replyToken;
                //$arrayPostData['to'] = $uid;
                $arrayPostData['messages'][0]['type'] = "flex";
                $arrayPostData['messages'][0]['altText'] = "$command";
                $arrayPostData['messages'][0]['contents']['type'] = "carousel";

                $datacountrowtype1 = 0;
                $datacountrowtype2 = 0;
                $datacountrowtype3 = 2;

                
                while($rowtype = pg_fetch_array($resulttype)){
                    //$datacountrowtype2 += 1;
                    //$datacountrowtype3 += 1;
                    
                    $subtype_id = $rowtype['subtype_id'];
                    $subtype_name = $rowtype['subtype_name'];
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['type'] = "bubble";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['text'] = "$subtype_name";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['weight'] = "bold";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['color'] = "#ffffff";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['wrap'] = true;
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['styles']['header']['backgroundColor'] = "#cb4335";
                
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['spacing'] = "md";

                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['layout'] = "vertical";
                $querystype = "SELECT DISTINCT location_name,  * ,ABS(coord_longitude-$longitude)as lo ,ABS(coord_latitude-$latitude)as la FROM line_subtype_all
                WHERE subtype_id = '$subtype_id' 
                ORDER BY lo,la
                LIMIT 3";
                ///ถ้าผู้ใช้มีlocationให้เลือกพื้นที่ใกล้ที่สุดมา3อัน แต่ถ้าไม่มีโลเคชันบอทจะเลือกข้อมูลที่ราคาแพงสุดมา3อัน || หรือวนไปให้ส่งโลเคชัน ???
                $resultstype = pg_query($dbconn, $querystype);
                $datacountrowtype = 0;
                    while($rowstype = pg_fetch_array($resultstype)){
                        $location_name = $rowstype['location_name'];
                        $province_name = $rowstype['province_name'];
                        $unit_name = $rowstype['unit_name'];
                        $reference_name = $rowstype['reference_name'];
                        $product_price = $rowstype['product_price'];
                        $lastupdate = $rowstype['lastupdate'];
                        $clatitude = $rowstype['coord_latitude'];
                        $clongitude = $rowstype['coord_longitude'];
                                
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "สถานที่ : $location_name ";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "sm";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                        $datacountrowtype += 1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "จังหวัด $province_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "sm";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                        $datacountrowtype += 1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "ราคา $product_price $unit_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "sm";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['weight'] = "bold";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
                        $datacountrowtype += 1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "อัปเดตล่าสุด : $lastupdate";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "xxs";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
                        $datacountrowtype += 1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "แหล่งที่มา : $reference_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "xxs";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
                        $datacountrowtype += 1;
                        
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "--------------------------------------------------";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "sm";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                        $datacountrowtype += 1;
                        
                    }
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['size'] = "xs";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['wrap'] = true;
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['align'] = "center";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "line://nv/location";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
                $datacountrowtype1 += 1;    
                }
            
                pg_free_result($resulttype);
                replyMsg($arrayHeader,$arrayPostData);
            }
            }
        }       
    /////////////////////////
    elseif($command == "ข่าวสารและคลังความรู้"){
      $query = "SELECT * FROM admin_log";
      if($result = pg_query($dbconn, $query)){
          if(pg_num_rows($result) > 0){
              $arrayPostData['replyToken'] = $replyToken;
              //$arrayPostData['to'] = $uid;
              $arrayPostData['messages'][0]['type'] = "flex";
              $arrayPostData['messages'][0]['altText'] = "$command";
              $arrayPostData['messages'][0]['contents']['type'] = "carousel";

              $datacountrowtype1 = 0;
              $datacountrowtype = 0;
              while($row = pg_fetch_array($result)){
                  $main_name = $row['main_name'];
                  $ttitle = $row['title'];
                  $ddescription = $row['description'];
                  $uurl_link = $row['url_link'];
                                        $datacountrowtype = 0;

                                        $url = $row['url_image'];
                                        $array = get_headers($url);
                                        $string = $array[0];
                                        if(strpos($string,"200")){
                                                $uurl_image = $url;
                                        }else{
                                            $uurl_image = 'https://scontent.fbkk5-1.fna.fbcdn.net/v/t1.0-9/44431968_311787679611478_8778612801666023424_n.jpg?_nc_cat=109&_nc_oc=AQmbNFVapwCey9afytGHOPceLn2L2bET_BpnWL3bUwPboAUzUDgZd1kXBVPHXuzNFeo&_nc_ht=scontent.fbkk5-1.fna&oh=15d4474eee49d78be44847332b6846b2&oe=5DF5DBCA';
                                        }

              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['type'] = "bubble";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['type'] = "image";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['url'] = "$uurl_image";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['size'] = "full";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['aspectRatio'] = "20:13";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['aspectMode'] = "cover";

              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['type'] = "box";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['layout'] = "vertical";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['spacing'] = "md";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['type'] = "box";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['layout'] = "vertical";                       
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['type'] = "text";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['text'] = "$main_name";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['flex'] = $datacountrowtype1;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['size'] = "xl";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['weight'] = "bold";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['wrap'] = true;
              $datacountrowtype += 1;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['type'] = "text";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['text'] = "$ttitle";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['flex'] = $datacountrowtype1;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['size'] = "sm";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['weight'] = "bold";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['wrap'] = true;
              $datacountrowtype += 1;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][2]['type'] = "text";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][2]['text'] = "$ddescription";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][2]['flex'] = $datacountrowtype1;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][2]['size'] = "xxs";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][2]['wrap'] = true;
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['type'] = "box";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['layout'] = "vertical";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['type'] = "button";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['type'] = "uri";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['label'] = "กดเพื่อดาวน์โหลด";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "$uurl_link";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
              $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['type'] = "spacer";
              //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "line://nv/location";
              //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
              $datacountrowtype1 += 1;    
              }
              pg_free_result($result);
              replyMsg($arrayHeader,$arrayPostData);
          }
        }
    }
    elseif($command == "เตือนภัย"){
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array (
            array (
                'type' => 'flex',
                'altText' => 'Flex Message',
                'contents' => 
                array (
                  'type' => 'bubble',
                  'direction' => 'ltr',
                  'header' => 
                  array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'text',
                        'text' => 'กรุณาเลือกประเภทแปลงเพาะปลูก',
                        'size' => 'md',
                        'align' => 'start',
                        'wrap' => true,
                      ),
                    ),
                  ),
                  'body' => 
                  array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'button',
                        'action' => 
                        array (
                          'type' => 'message',
                          'label' => 'พืชไร่',
                          'text' => 'เตือนภัยพืชไร่',
                        ),
                        'color' => '#DC9B3A',
                        'style' => 'primary',
                      ),
                      1 => 
                      array (
                        'type' => 'separator',
                        'margin' => 'sm',
                      ),
                      2 => 
                      array (
                        'type' => 'button',
                        'action' => 
                        array (
                          'type' => 'message',
                          'label' => 'พืชสวน',
                          'text' => 'เตือนภัยพืชสวน',
                        ),
                        'color' => '#4ED946',
                        'style' => 'primary',
                      ),
                      3 => 
                      array (
                        'type' => 'separator',
                        'margin' => 'sm',
                      ),
                      4 => 
                      array (
                        'type' => 'button',
                        'action' => 
                        array (
                          'type' => 'message',
                          'label' => 'ปศุสัตว์',
                          'text' => 'เตือนภัยปศุสัตว์',
                        ),
                        'color' => '#E75959',
                        'style' => 'primary',
                      ),
                      5 => 
                      array (
                        'type' => 'separator',
                        'margin' => 'sm',
                      ),
                      6 => 
                      array (
                        'type' => 'button',
                        'action' => 
                        array (
                          'type' => 'message',
                          'label' => 'ประมง',
                          'text' => 'เตือนภัยประมง',
                        ),
                        'color' => '#3E79C9',
                        'style' => 'primary',
                      ),
                    ),
                  ),
                  'footer' => 
                  array (
                    'type' => 'box',
                    'layout' => 'horizontal',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'text',
                        'text' => 'ข้อมูลจาก Chaokaset Mobile',
                        'align' => 'center',
                        'color' => '#CBC5C5',
                      ),
                    ),
                  ),
                ),
              )
          )
      );
    }
    elseif($command == "ราคาน้ำมัน"){
        $client = new SoapClient("http://www.pttplc.com/webservice/pttinfo.asmx?WSDL",
                array(
                    "trace"      => 1,		// enable trace to view what is happening
                    "exceptions" => 0,		// disable exceptions
                    "cache_wsdl" => 0) 		// disable any caching on the wsdl, encase you alter the wsdl server
                );
                    $params = array(
                        'Language' => "en",
                        'DD' => date('d'),
                        'MM' => date('m'),
                        'YYYY' => date('Y')
                    );
            $data = $client->GetOilPrice($params);
            $ob = $data->GetOilPriceResult;
            $xml = new SimpleXMLElement($ob);
            // PRICE_DATE , PRODUCT ,PRICE
            foreach ($xml  as  $key=>$val) {  
                if($val->PRODUCT != ''){
                    echo $val->PRODUCT .'  '.$val->PRICE.' บาท<br>';
                }
            }
    
    }
    elseif($command == "เทส"){
        $t2 = 2;
        $uri2 = "https://chaokaset.openservice.in.th/index.php/priceservices/getSubtype/".$t2;
        $response = Unirest\Request::get("$uri2");
        $json = json_decode($response->raw_body, true);
        $resultasn = $json[1]['subtype_name'];
        $resultasid = $json[1]['subtype_id'];
        $resultatid = $json[1]['type_id'];
        $mreply = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'flex',
                    'altText' => 'Flex Message',
                    'contents' => 
                    array (
                      'type' => 'bubble',
                      'direction' => 'ltr',
                      'header' => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => 'สภาพอากาศวันนี้',
                            'size' => 'lg',
                            'align' => 'start',
                            'wrap' => true,
                          ),
                        ),
                      ),
                      'hero' => 
                      array (
                        'type' => 'image',
                        'url' => 'https://wi-images.condecdn.net/image/doEYpG6Xd87/crop/2040/f/weather.jpg',
                        'size' => 'full',
                        'aspectRatio' => '1.51:1',
                        'aspectMode' => 'fit',
                      ),
                      'body' => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => "sname : $resultasn",
                            'size' => 'md',
                          ),
                          1 => 
                          array (
                            'type' => 'text',
                            'text' => "sid : $resultasid",
                            'size' => 'md',
                          ),
                          2 => 
                          array (
                            'type' => 'text',
                            'text' => "tid : $resultatid",
                            'size' => 'md',
                          ),
                        ),
                      ),
                      'footer' => 
                      array (
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => 'ข้อมูลจาก api.openweathermap',
                            'size' => 'sm',
                            'align' => 'center',
                            'color' => '#CBC5C5',
                          ),
                        ),
                      ),
                    ),
                  )
            )
        );


    }
    elseif($command == "เทส2"){
        $t2 = 2;
        $uri2 = "https://chaokaset.openservice.in.th/index.php/priceservices/getmarket";
        $response = Unirest\Request::post("$uri2");
        $json = json_decode($response->raw_body, true);
        $resulta = $json['name'];
        $resultb = $json['weather'][0]['main'];
        $resultc = $json['weather'][0]['description'];
        $resultd = $json['main']['temp'];
        $resulte = $json['coord']['lon'];
        $resultasn = $json['data'];
        $resultasid = $json[1]['subtype_id'];
        $resultatid = $json[1]['type_id'];
        $mreply = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
                    'type' => 'flex',
                    'altText' => 'Flex Message',
                    'contents' => 
                    array (
                      'type' => 'bubble',
                      'direction' => 'ltr',
                      'header' => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => 'สภาพอากาศวันนี้',
                            'size' => 'lg',
                            'align' => 'start',
                            'wrap' => true,
                          ),
                        ),
                      ),
                      'hero' => 
                      array (
                        'type' => 'image',
                        'url' => 'https://wi-images.condecdn.net/image/doEYpG6Xd87/crop/2040/f/weather.jpg',
                        'size' => 'full',
                        'aspectRatio' => '1.51:1',
                        'aspectMode' => 'fit',
                      ),
                      'body' => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => "sname : $resultasn",
                            'size' => 'md',
                          ),
                          1 => 
                          array (
                            'type' => 'text',
                            'text' => "sid : $resultasid",
                            'size' => 'md',
                          ),
                          2 => 
                          array (
                            'type' => 'text',
                            'text' => "tid : $resultatid",
                            'size' => 'md',
                          ),
                        ),
                      ),
                      'footer' => 
                      array (
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'text',
                            'text' => 'ข้อมูลจาก api.openweathermap',
                            'size' => 'sm',
                            'align' => 'center',
                            'color' => '#CBC5C5',
                          ),
                        ),
                      ),
                    ),
                  )
            )
        );


    }
    #ตัวอย่าง Message Type "Text + Sticker" https://chaokaset.openservice.in.th/index.php/priceservices/getSubtype/2
    elseif($command == "ข้อมูลผู้ใช้"){
        $querylog = "SELECT * FROM line_log WHERE userid = '$userId'";
        $resultlog = pg_query($dbconn, $querylog);
        $rowlog = pg_fetch_array($resultlog);
        $plan_category = $rowlog['plan_category'];
        $address = $rowlog['address'];
        if($plan_category == NULL){
            $plan_category = 'คุณยังไม่มีแปลงเพาะปลูกที่สนใจ';
        }if($address == NULL){
            $address = 'คุณยังไม่ได้เพิ่มที่อยู่';
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       $mreply = array(
            'replyToken' => $replyToken,
            'messages' => array(
            array (
                'type' => 'flex',
                'altText' => 'ข้อมูลผู้ใช้',
                'contents' => 
                array (
                  'type' => 'bubble',
                  'header' => 
                  array (
                    'type' => 'box',
                    'layout' => 'horizontal',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'text',
                        'text' => 'ข้อมูลผู้ใช้',
                        'size' => 'lg',
                        'align' => 'start',
                        'weight' => 'bold',
                        'color' => '#423B3B',
                      ),
                    ),
                  ),
                  'hero' => 
                  array (
                    'type' => 'image',
                    'url' => $pictureUrl,
                    'align' => 'center',
                    'size' => 'full',
                    'aspectRatio' => '20:13',
                    'aspectMode' => 'cover'
                  ),
                  'body' => 
                  array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'spacing' => 'md',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'text',
                        'text' => "ชื่อผู้ใช้ : $displayName",
                        'size' => 'md',
                        'align' => 'start',
                        'gravity' => 'top',
                        'weight' => 'bold',
                        'wrap' => true,
                      ),
                      1 => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'flex' => 2,
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'box',
                            'layout' => 'vertical',
                            'contents' => 
                            array (
                              0 => 
                              array (
                                'type' => 'text',
                                'text' => 'ประเภทแปลงเพาะปลูกที่สนใจ : ',
                                'size' => 'md',
                                'gravity' => 'center',
                                'weight' => 'bold',
                                'wrap' => true,
                              ),
                              1 => 
                              array (
                                'type' => 'text',
                                'text' => "$plan_category",
                                'size' => 'md',
                                'align' => 'start',
                                'gravity' => 'center',
                                'weight' => 'regular',
                                'wrap' => true,
                              )
                            ),
                          ),
                          1 => 
                          array (
                            'type' => 'text',
                            'text' => 'ที่อยู่ของฉัน :',
                            'size' => 'md',
                            'gravity' => 'center',
                            'weight' => 'bold',
                            'wrap' => true,
                          ),
                          2 => 
                          array (
                            'type' => 'text',
                            'text' => $address,
                            'size' => 'md',
                            'gravity' => 'center',
                            'weight' => 'regular',
                            'wrap' => true,
                          ),
                        ),
                      ),
                    ),
                  ),
                  'footer' => 
                  array (
                    'type' => 'box',
                    'layout' => 'vertical',
                    'contents' => 
                    array (
                      0 => 
                      array (
                        'type' => 'box',
                        'layout' => 'horizontal',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'button',
                            'action' => 
                            array (
                              'type' => 'message',
                              'label' => 'แก้ไขแปลง',
                              'text' => 'แก้ไขแปลงเพาะปลูก',
                            ),
                            'color' => '#35BF64',
                            'style' => 'primary',
                          ),
                          1 => 
                          array (
                            'type' => 'separator',
                            'margin' => 'md',
                          ),
                          2 => 
                          array (
                            'type' => 'button',
                            'action' => 
                            array (
                              'type' => 'message',
                              'label' => 'แก้ไขที่อยู่',
                              'text' => 'แก้ไขที่อยู่',
                            ),
                            'color' => '#487EB7',
                            'style' => 'primary',
                          ),
                        ),
                      ),
                      1 => 
                      array (
                        'type' => 'box',
                        'layout' => 'vertical',
                        'contents' => 
                        array (
                          0 => 
                          array (
                            'type' => 'spacer',
                          ),
                        ),
                      ),
                    ),
                  ),
                ),
              )
            )
            );
    }
    /*elseif($command == "นับ1-10"){
        for($i=1;$i<=10;$i++){
        $arrayPostData['replyToken'] = $replyToken;
        //$arrayPostData['to'] = $uid;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $i;
        replyMsg($arrayHeader,$arrayPostData);
        }
    }*/
    /////////////
?>