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
$url = "https://bots.dialogflow.com/line/37d316a1-c0b5-46ca-9b85-e58789028d26/webhook";
$headers = getallheaders();
file_put_contents('headers.txt',json_encode($headers, JSON_PRETTY_PRINT));          
file_put_contents('body.txt',file_get_contents('php://input'));
$headers['Host'] = "bots.dialogflow.com";
$json_headers = array();
foreach($headers as $k=>$v){
    $json_headers[]=$k.":".$v;
}
  $inputJSON = file_get_contents('php://input');
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url);
  curl_setopt( $ch, CURLOPT_POST, 1);
  curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true);
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $inputJSON);
  curl_setopt( $ch, CURLOPT_HTTPHEADER, $json_headers);
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1); 
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $ch );
  curl_close( $ch );
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
//dfb33833ca384effa6b7d26c0145ecab//APIKEYข่าว
#--------------------------------------------------------------------------------------------------------------------#
  /*$LINEData = file_get_contents('php://input');
  $jsonData = json_decode($LINEData,true);
  $replyToken = $jsonData["events"][0]["replyToken"];
  $userID = $jsonData["events"][0]["source"]["userId"];
  $text = $jsonData["events"][0]["message"]["text"];
  $timestamp = $jsonData["events"][0]["timestamp"];
  $lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
  $lineData['AccessToken'] = "pZmLfAv73zYnio19mFJo2hudRTgr7y8FbMdAayR7VXep+rZyVt1NAAEL+ZcsjfbrA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vzhQPrIgSXQ3Uj23DnEpFiCa+MC60K2WexRcqsdgTDQ6gdB04t89/1O/w1cDnyilFU=";
  $replyJson["replyToken"] = $replyToken;
  $replyJson["messages"][0] = $replyText;
  $encodeJson = json_encode($replyJson);*/
?>