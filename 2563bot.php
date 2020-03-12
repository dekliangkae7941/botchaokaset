<?php
#-------------------------[Include]-------------------------#
#-------------------------[include]-------------------------#
// echo "555555";
// $categoryid =1;
// $jsontype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getTypeAll');
//   $objtype = json_decode($jsontype);
//   $i =0;
//   //$rowtext = 1;
//   for($i=0;$i<=Count($objtype);$i++){
//     $category_id = $objtype[$i]->category_id;
//     $type_id = $objtype[$i]->type_id;
//     $type_name = $objtype[$i]->type_name;
//   //$category_id = 1;
//   echo '55555555555';
//   if($categoryid == $category_id){
//     echo $type_id;
//     echo $type_name;
//   }
// }
include "connectdb.php";

#-------------------------[Func]-------------------------#

    // $command = "ข้อมูลผู้ใช้";
    // $querytent = "SELECT * FROM bot_tent";
    // $resulttent = $mysql->query($querytent);
    // while($rowtent = mysqli_fetch_assoc($resulttent)){
    //   $response_id = $rowtent['response_id'];
    //   $response_text = $rowtent['response_text'];
    //   if($response_text == $command){
    //     // echo $response_id;
    //     // echo $response_text;
    //     follow($response_id);
    //     unfollow($response_id);
    //     user_profile($mysql,$response_id);
    //   }
    // }
    // function user_profile($mysql,$response_id){
    //   if($response_id == '6'){
    //     $query = "SELECT * FROM bot_log WHERE user_id = '1'";
    //     $result = $mysql->query($query);
    //     while($row = mysqli_fetch_assoc($result)){
    //       $plant_category = $row['user_plant_category'];
    //       $address = $row['user_address'];
    //       echo $plant_category;
    //       echo $address;
    //     }
    //   }
    // }
    // function follow($response_id){
    //   if($response_id == 1){
    //     echo '5678';
    //   }
    // }
    // function unfollow($response_id){
    //     if($response_id == 9){
    //         echo '5678';
    //     }
    // }





    include "bot_header.php";
#-------------------------[EVENT TYPE]-------------------------#
if ($type == 'memberJoined') {
    $text = "เมื่อมีผู้ใช้เข้ากลุ่ม";
        $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
elseif ($type == 'memberLeft') {
    $text = "เมื่อมีผู้ใช้ออกกลุ่ม";
        $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
elseif ($type == 'join') {
      $text = "เมื่อบอทถูกเชิญเข้าห้อง";
    $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
elseif ($type == 'leave') {
    $text = "เมื่อบอทถูกเตะออกจากห้อง";
        $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
elseif ($type == 'follow') {
    $sql = "INSERT INTO bot_log (user_id) VALUES ('$userId')";
    $result = $mysql->query($sql);
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
                      1 => 
                      array (
                        'type' => 'text',
                        'text' => 'ที่สนใจ เพื่อรับแจ้งเตือน',
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
                          'text' => 'พืชไร่',
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
                          'text' => 'พืชสวน',
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
                          'text' => 'ปศุสัตว์',
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
                          'text' => 'ประมง',
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
                        'text' => 'ข้อมูลจาก Chaokaset Application',
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
elseif ($type == 'unfollow') {
	$sql = "DELETE FROM bot_log WHERE user_id = '$userId'";
    $result = $result = $mysql->query($sql);
    $text = "เมื่อบอทถูกบล็อค";
        $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
#-------------------------[MSG TYPE]-------------------------#
elseif ($msg_type == 'file') {
$url = 'https://api.line.me/v2/bot/message/' . $messageid . '/content';
$headers = array('Authorization: Bearer ' . $channelAccessToken);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
$ran = date("YmdHis");
$botDataUserFolder = './user/file/file/' . $userId;
                    if(!file_exists($botDataUserFolder)) {
                        mkdir($botDataUserFolder, 0777, true);
                    } 
$fileFullSavePath = $botDataUserFolder . '/' . $ran . $msg_file;
$fileurl = 'https://phpabc2019.herokuapp.com' . $fileFullSavePath;
file_put_contents($fileFullSavePath,$result);
  $text = "บันทึกไฟล์เรียบร้อยแล้ว";
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            ),
            array(
                'type' => 'text',
                'text' => $fileurl
            )
        )
    );
}

elseif ($msg_type == 'image') {
$url = 'https://api.line.me/v2/bot/message/' . $messageid . '/content';
$headers = array('Authorization: Bearer ' . $channelAccessToken);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
$ran = date("YmdHis");
$botDataUserFolder = './user/file/image/' . $userId;
                    if(!file_exists($botDataUserFolder)) {
                        mkdir($botDataUserFolder, 0777, true);
                    } 
$fileFullSavePath = $botDataUserFolder . '/' . $ran . '.jpg';
$picurl = 'https://phpabc2019.herokuapp.com' . $fileFullSavePath;
file_put_contents($fileFullSavePath,$result);
  $text = "บันทึกไฟล์รูปภาพเรียบร้อยแล้ว";
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            ),
            array(
                'type' => 'text',
                'text' => $picurl
            )
        )
    );
}
elseif ($msg_type == 'video') {
  $url = 'https://api.line.me/v2/bot/message/' . $messageid . '/content';
$headers = array('Authorization: Bearer ' . $channelAccessToken);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
$ran = date("YmdHis");
$botDataUserFolder = './user/file/video/' . $userId;
                    if(!file_exists($botDataUserFolder)) {
                        mkdir($botDataUserFolder, 0777, true);
                    } 
$fileFullSavePath = $botDataUserFolder . '/' . $ran . '.mp4';
$vidurl = 'https://phpabc2019.herokuapp.com' . $fileFullSavePath;
file_put_contents($fileFullSavePath,$result);
  $text = "บันทึกไฟล์วิดีโอเรียบร้อยแล้ว";
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            ),
            array(
                'type' => 'text',
                'text' => $vidurl
            )
        )
    );
}
elseif ($msg_type == 'sticker') {
  $stickerurl = "https://stickershop.line-scdn.net/stickershop/v1/sticker/" . $stickerId . "/android/sticker.png";
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
          array(
                  'type' => 'flex',
                  'altText' => 'Sticker!!',
                  'contents' => array(
                  'type' => 'bubble',
                  'body' => array(
                    'type' => 'box',
                    'layout' => 'vertical',
                    'spacing' => 'md',
                    'contents' => array(
                      array(
                        'type' => 'text',
                    'align' => 'center',
                    'color' => '#049b1b',
                    'text' => 'USER : ' . $reline2
                ),
                      array(
                    'type' => 'image',
                    'size' => '5xl',
                    'align' => 'center',
                    'url' => $stickerurl
                )
                  )
                  )
                  )
                  )
              )
              );
}
elseif ($msg_type == 'location') {
  ////คือกดสภาพอากาศ แล้วส่งคำว่า lo...ไป เมื่อส่งไปให้ดึงข้อมูลละติ ลองจิ ของโลเคชันจากดาต้าเบสออกมาละส่งไปopenwเลย ส่วนโปรไฟล์จะมีให้แก้ไขที่อยู่ และแก้ไขแปลงผัก
  $query = "UPDATE bot_log SET user_latitude = '$msg_latitude', user_longitude = '$msg_longitude', user_address = '$msg_address' WHERE user_id = '$userId'";
  $result = $mysql->query($query);
  //"INSERT INTO line_log (userid latitude , longitude) VALUES ('$userId','$msg_latitude','$msg_longitude')";
  $text = "บอทได้บันทึกที่อยู่ของท่านเรียบร้อย ขอบคุณค่ะ";
  $mreply = array(
      'replyToken' => $replyToken,
      'messages' => array(
          array(
              'type' => 'text',
              'text' => $text
          )
      )
  );

}elseif ($command== 'myid') { 
	    $sql = "INSERT INTO bot_log (user_id) VALUES ('$userId')";
	    $result = $mysql->query($sql);
	  $mreply = array(
	        'replyToken' => $replyToken,
	        'messages' => array(
	            array(
	                'type' => 'text',
	                'text' => 'userId ของคุณคือ '.$userId,
                  'quickReply' => array(
                      'items' => array(
                      array(
                        'type' => 'action',
                        'action' => array(
                        'type' => 'postback',
                        'label' => 'Postback',
                        'data' => 'happy'
                        )
                      )
                      )
                    )
	            )
	        )
	    );
  }
  elseif($command == "เตือนภัย"){
    $mreply = array(
      'replyToken' => $replyToken,
      'messages' => array (
          array (
              'type' => 'flex',
              'altText' => 'เตือนภัย',
              'contents' => 
              array (
                'type' => 'bubble',
                'direction' => 'ltr',
                'header' => 
                array (
                  'backgroundColor' => '#D7D9D7',
                  'type' => 'box',
                  'layout' => 'vertical',
                  'contents' => 
                  array (
                    0 => 
                    array (
                      'type' => 'text',
                      'text' => 'ประเภทการเตือนภัย',
                      'size' => 'lg',
                      'weight' => 'bold',
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
                        'label' => 'เตือนภัยเกษตรล่าสุด',
                        'text' => 'เตือนภัยเกษตรล่าสุด',
                      ),
                      'color' => '#E56745',
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
                        'label' => 'เตือนภัยเกษตรใกล้ตัว',
                        'text' => 'เตือนภัยเกษตรใกล้ตัว',
                      ),
                      'color' => '#E7A83B',
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
                      'text' => 'ข้อมูลจาก Chaokaset Application',
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
  elseif($command == "เตือนภัยเกษตรใกล้ตัว"){
    $mreply = array(
      'replyToken' => $replyToken,
      'messages' => array(
          array(
              'type' => 'text',
              'text' => "ขออภัยค่ะ แจ้งเตือนภัยเกษตรใกล้ตัวกำลังอยู่ในช่วงพัฒนาค่ะ ขอบคุณค่ะ"
          )
      )
    );
  }
  elseif($command == "เตือนภัยเกษตรล่าสุด"){
      $json = file_get_contents('https://chaokaset.openservice.in.th/index.php/doaservices/notifysent');
      $obj = json_decode($json);
      $i =0;
      $arrayPostData['replyToken'] = $replyToken;
      //$arrayPostData['to'] = $uid;
      $arrayPostData['messages'][0]['type'] = "flex";
      $arrayPostData['messages'][0]['altText'] = "$command";
      $arrayPostData['messages'][0]['contents']['type'] = "carousel";
      $datacountrowtype = 0;
      $datacountrowtype1 = 0;
      $datacountrowtype2 = 0;
      for($i=0;$i<=4;$i++){
          //$datacountrowtype2 += 1;
          //$datacountrowtype3 += 1;
        $name = $obj[$i]->name;
        $growing = $obj[$i]->growing;
        $weather = $obj[$i]->weather;
        $problem = $obj[$i]->problem;
        $warning = $obj[$i]->detail->warning;
        $solution = $obj[$i]->detail->solution;
        $date_start = $obj[$i]->detail->date_start;
        $date_end = $obj[$i]->detail->date_end;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['type'] = "bubble";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['text'] = "$command";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['size'] = "lg";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['weight'] = "bold";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['color'] = "#ffffff";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['header']['contents'][0]['wrap'] = true;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['styles']['header']['backgroundColor'] = "#F460A6";
      
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['spacing'] = "md";

      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['layout'] = "vertical";

      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['text'] = "$name";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['size'] = "xl";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['weight'] = "bold";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][0]['wrap'] = true;
      $datacountrowtype += 1;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][1]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][1]['text'] = "สภาพแวดล้อม : $weather";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][1]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][1]['size'] = "md";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][1]['wrap'] = true;
      $datacountrowtype += 1;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][2]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][2]['text'] = "ระยะการเจริญเติบโต : $growing";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][2]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][2]['size'] = "md";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][2]['wrap'] = true;   
      $datacountrowtype += 1;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][3]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][3]['text'] = "ปัญหาที่ควรระวัง : $problem";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][3]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][3]['size'] = "md";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][3]['wrap'] = true;
      $datacountrowtype += 1;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][4]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][4]['text'] = "อาการที่อาจพบ : $warning";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][4]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][4]['size'] = "md";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][4]['wrap'] = true;   
      $datacountrowtype += 1;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][5]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][5]['text'] = "แนวทางป้องกัน : $solution";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][5]['flex'] = $i;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][5]['size'] = "md";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][5]['wrap'] = true;   
      $datacountrowtype += 1;
              
              // $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
              // $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "--------------------------------------------------";
              // $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $i;
              // $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
              // $arrayPostData['messages'][0]['contents']['contents'][$i]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
              // $datacountrowtype += 1;                 
        
      /*
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][1]['type'] = "button";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][1]['action']['type'] = "action";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][1]['action']['type']['action']['type'] = "location";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][1]['action']['type']['action']['label'] = "กดที่นี่เพื่อหาร้านค้าใกล้ตัว";*/

      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Application";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['size'] = "xs";
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['wrap'] = true;
      $arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['align'] = "center";
      //$arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['action']['uri'] = "line://nv/location";
      //$arrayPostData['messages'][0]['contents']['contents'][$i]['footer']['contents'][0]['style'] = "primary";
   //$datacountrowtype1 += 1;    
    
      }
      replyMsg($arrayHeader,$arrayPostData);
  }
	elseif ($command== 'qr' || $command== 'Qr' || $command== 'QR' || $command== 'Qrcode' || $command== 'QRcode' || $command== 'qrcode') { 
	      $url = 'https://chart.googleapis.com/chart?cht=qr&choe=UTF-8&chs=300x300&chl='.$options;
	      $mreply = array(
	        'replyToken' => $replyToken,
	        'messages' => array(
	            array(
	                'type' => 'image',
	                'originalContentUrl' => $url,
	                'previewImageUrl' => $url
	            )
	        )
	    );
  }
  elseif($command == "ข้อมูลผู้ใช้"){
    $querylog = "SELECT * FROM bot_log WHERE user_id = '$userId'";
    $resultlog = $mysql->query($querylog);
    $rowlog = mysqli_fetch_assoc($resultlog);
    $plant_category = $rowlog['user_plant_category'];
    $address = $rowlog['user_address'];
    if($plant_category == NULL){
        $plant_category = 'คุณยังไม่มีแปลงเพาะปลูกที่สนใจ';
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
                            'text' => "$plant_category",
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

////////////////////////
#--------------------------------------[case]--------------------------------------------#
elseif($command == 'พืชไร่'||$command == 'พืชสวน'||$command == 'ประมง'||$command == 'ปศุสัตว์'){
  $queryplan = "UPDATE bot_log SET user_plant_category = '$command' WHERE user_id = '$userId'";
  $resultplan = $mysql->query($queryplan);
  //"INSERT INTO line_log (userid latitude , longitude) VALUES ('$userId','$msg_latitude','$msg_longitude')";
  $text = "บอทได้บันทึกที่อยู่ของท่านเรียบร้อย ขอบคุณค่ะ";
  $mreply = array(
      'replyToken' => $replyToken,
      'messages' => array(
          array(
              'type' => 'text',
              'text' => $text
          )
      )
  );

  $querylocation = "SELECT * FROM bot_log WHERE user_id = '$userId'";
  $resultlocation = $mysql->query($querylocation);
  $rowlocation = mysqli_fetch_assoc($resultlocation);
  $latitude = $rowlocation['user_latitude'];
  $longitude = $rowlocation['user_longitude'];
  $address = $rowlocation['user_address'];
  if($latitude == NULL || $longitude == NULL ){
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
    $mreply = array(
      'replyToken' => $replyToken,
      'messages' => array(
          array(
              'type' => 'text',
              'text' => "ขอบคุณสำหรับการเลือกประเภทการเพาะปลูกเพื่อรับแจ้งเตือน"
          )
      )
  );
  }
}
elseif($command == "ข่าวสารและคลังความรู้"){
  $query = "SELECT * FROM bot_news";
  $result = $mysql->query($query);
          $arrayPostData['replyToken'] = $replyToken;
          //$arrayPostData['to'] = $uid;
          $arrayPostData['messages'][0]['type'] = "flex";
          $arrayPostData['messages'][0]['altText'] = "$command";
          $arrayPostData['messages'][0]['contents']['type'] = "carousel";

          $datacountrowtype1 = 0;
          $datacountrowtype = 0;
          while($row = mysqli_fetch_assoc($result)){
              $main_name = $row['main_name'];
              $ttitle = $row['title'];
              $ddescription = $row['description'];
              $uurl_link = $row['url_link'];
              //$uurl_image = $row['url_image'];
              $datacountrowtype = 0;
              $url = $row['url_image'];
              $array = get_headers($url);
              $string = $array[0];
              if(strpos($string,"200")){
                  $uurl_image = $url;
              }else{
                $uurl_image = 'https://i0.wp.com/www.redeyereloading.com/wp-content/uploads/2017/08/error-page-background-img.jpg?ssl=1';
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
          $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['label'] = "กดเพื่อดูเพิ่มเติม";
          $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "$uurl_link";
          $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
          $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['type'] = "spacer";
          //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "line://nv/location";
          //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
          $datacountrowtype1 += 1;    
          }
          replyMsg($arrayHeader,$arrayPostData);
}
elseif($command == 'Location' || $command == 'สภาพอากาศ' ){
    $querylocation = "SELECT * FROM bot_log WHERE user_id = '$userId'";
    $resultlocation = $mysql->query($querylocation);
    $rowlocation = mysqli_fetch_assoc($resultlocation);
    $latitude = $rowlocation['user_latitude'];
    $longitude = $rowlocation['user_longitude'];
    $address = $rowlocation['user_address'];
    if($latitude == NULL || $longitude == NULL ){
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
            $uri = "https://api.openweathermap.org/data/2.5/weather?lat=" . $latitude . "&lon=" . $longitude . "&lang=th&units=metric&appid=bb32ab343bb6e3326f9e1bbd4e4f5d31";
            $response = Unirest\Request::get("$uri");
            $json = json_decode($response->raw_body, true);
            $resulta = $json['name'];
            $resultb = $json['weather'][0]['main'];
            $resultc = $json['weather'][0]['description'];
            $resultd = $json['main']['temp'];
            $resulte = $json['coord']['lon'];
            $mreply = array(
                'replyToken' => $replyToken,
                'messages' => array(
                    array (
                        'type' => 'flex',
                        'altText' => 'สภาพอากาศ',
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
                                'text' => "พื้นที่ : $resulta",
                                'size' => 'md',
                              ),
                              1 => 
                              array (
                                'type' => 'text',
                                'text' => "สภาพอากาศ : $resultb",
                                'size' => 'md',
                              ),
                              2 => 
                              array (
                                'type' => 'text',
                                'text' => "รายละเอียด : $resultc",
                                'size' => 'md',
                              ),
                              3 => 
                              array (
                                'type' => 'text',
                                'text' => "อุณหภูมิ : $resultd",
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
    }
    elseif($command == "แก้ไขที่อยู่"){
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
    }
    elseif($command == "แมว"){
      $json = file_get_contents('https://chaokaset.openservice.in.th/index.php/doaservices/notifysent');
      $obj = json_decode($json);
      $text = $obj[0]->growing;
      $mreply = array(
          'replyToken' => $replyToken,
          'messages' => array(
              array(
                  'type' => 'text',
                  'text' => $text
              )
          )
      );
    }
    elseif ($command == "แก้ไขแปลงเพาะปลูก") {
      // $sql = "UPDATE bot_log SET user_plant_category = '$msg_latitude', user_longitude = '$msg_longitude', user_address = '$msg_address' WHERE user_id = '$userId'";
      // $result = $mysql->query($sql);
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
                        1 => 
                        array (
                          'type' => 'text',
                          'text' => 'ที่สนใจ เพื่อรับแจ้งเตือน',
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
                            'text' => 'พืชไร่',
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
                            'text' => 'พืชสวน',
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
                            'text' => 'ปศุสัตว์',
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
                            'text' => 'ประมง',
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
                          'text' => 'ข้อมูลจาก Chaokaset Application',
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
    elseif($command == "ราคาตลาด"){
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array (
            array (
              'type' => 'flex',
              'altText' => 'ราคาตลาดเกษตร',
              'contents' => 
              array (
                'type' => 'carousel',
                'contents' => 
                array (
                  0 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_rice.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดข้าว',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาข้าววันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาข้าว',
                          ),
                          'color' => '#D09F27',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  1 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_vegetable.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดผัก',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'flex' => 1,
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาผักวันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาผัก',
                          ),
                          'color' => '#25AA4D',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  2 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_fruit.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดผลไม้',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาผลไม้วันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาผลไม้',
                          ),
                          'color' => '#A562F0',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  3 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_agri.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดพืชเศรษฐกิจ',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาพืชเศรษฐกิจวันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาพืชเศรษฐกิจ',
                          ),
                          'color' => '#F7921E',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  4 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_flower.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดดอกไม้',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาดอกไม้วันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาดอกไม้',
                          ),
                          'color' => '#E8479A',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  5 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_livestock.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดปศุสัตว์',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาสัตว์วันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาปศุสัตว์',
                          ),
                          'color' => '#D04C27',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                  6 => 
                  array (
                    'type' => 'bubble',
                    'hero' => 
                    array (
                      'type' => 'image',
                      'url' => 'https://raw.githubusercontent.com/dekliangkae7941/chaobot2019/master/c_aquatic.png',
                      'size' => 'full',
                      'aspectRatio' => '20:13',
                      'aspectMode' => 'cover',
                    ),
                    'body' => 
                    array (
                      'type' => 'box',
                      'layout' => 'vertical',
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'text',
                          'text' => 'ตลาดสัตว์น้ำ',
                          'size' => 'xl',
                          'weight' => 'bold',
                          'wrap' => true,
                        ),
                        1 => 
                        array (
                          'type' => 'box',
                          'layout' => 'baseline',
                          'contents' => 
                          array (
                            0 => 
                            array (
                              'type' => 'text',
                              'text' => 'ข้อมูลราคาสัตว์น้ำวันนี้',
                              'flex' => 0,
                              'size' => 'sm',
                              'weight' => 'bold',
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
                      'spacing' => 'sm',
                      'contents' => 
                      array (
                        0 => 
                        array (
                          'type' => 'button',
                          'action' => 
                          array (
                            'type' => 'message',
                            'label' => 'เลือกเลย',
                            'text' => 'ราคาสัตว์น้ำ',
                          ),
                          'color' => '#276DD0',
                          'style' => 'primary',
                        ),
                      ),
                    ),
                  ),
                ),
              ),
            ),
        )
        );
  }
////////////////////////////


elseif ($post_data== 'happy') { 

  $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => 'Postback : happy',
                'quickReply' => array(
                    'items' => array(
                    array(
                      'type' => 'action',
                      'action' => array(
                      'type' => 'postback',
                      'label' => 'Postback',
                      'data' => 'happy'
                      )
                    )
                    )
                  )

            )
        )
    );
}
if($command == 'ราคาผัก' || $command == 'ราคาสัตว์น้ำ' || $command == 'ราคาปศุสัตว์' || $command == 'ราคาข้าว' || $command == 'ราคาผลไม้' || $command == 'ราคาพืชเศรษฐกิจ' || $command == 'ราคาดอกไม้'){
  if($command == "ราคาผัก"){
    $categoryid = 1;
  }elseif ($command == 'ราคาผลไม้') {
    $categoryid = 2;
  }
  elseif ($command == 'ราคาสัตว์น้ำ') {
      $categoryid = 3;
  }
  elseif ($command == 'ราคาปศุสัตว์') {
      $categoryid = 4;
  }
  elseif ($command == 'ราคาข้าว') {
      $categoryid = 5;
  }
  elseif ($command == 'ราคาพืชเศรษฐกิจ') {
      $categoryid = 6;
  }
  elseif ($command == 'ราคาดอกไม้') {
      $categoryid = 7;
  }
  $jsontype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getTypeAll');
  $objtype = json_decode($jsontype);
  $i =0;
  $rowtext = 1;
  for($i=0;$i<=Count($objtype);$i++){
    $category_id = $objtype[$i]->category_id;
    $type_id = $objtype[$i]->type_id;
    $type_name = $objtype[$i]->type_name;
  //$category_id = 1;
  if($categoryid == $category_id){
    $arrayPostData['replyToken'] = $replyToken;
    //$arrayPostData['to'][0] = $uid;
    //$arrayPostData['to'][0] = $user_id;
          $arrayPostData['messages'][0]['type'] = "flex";
          $arrayPostData['messages'][0]['altText'] = "broadcast";
          $arrayPostData['messages'][0]['contents']['type'] = "bubble";
          
          $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
          $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "$command";
          //$arrayPostData['messages'][0]['contents']['header']['contents'][0]['color'] = "#ffffff";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
          $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

          $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
          $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
          $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
          $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
          $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "กรุณาเลือกประเภทของ$command";
          $arrayPostData['messages'][0]['contents']['body']['contents'][0]['size'] = "md";
          //$arrayPostData['messages'][0]['contents']['body']['contents'][0]['weight'] = "bold";
          $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;

            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "button";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['style'] = "secondary";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['type'] = "message";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['label'] = "$type_name";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['text'] = "ราคา$type_name";
            $rowtext += 1; 
          
          $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
          $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
          $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
          $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
          $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
          $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
          $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
          $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
        }
      }
    replyMsg($arrayHeader,$arrayPostData);
    /////////////////////////////////////////////////////////
}
elseif($command == "ราคากระเทียม" || $command == "ราคากล้วย" || $command == "ราคากุ้ง" || $command == "ราคาไก่" || $command == "ราคาข้าวเปลือกเจ้า" || $command == "ราคาข้าวเปลือกเหนียว" ||
$command == "ราคาดาวเรือง" || $command == "ราคาดอกรัก" || $command == "ราคาเงาะ" || $command == "ราคาไข่" || $command == "ราคาข้าวโพด" || $command == "ราคาข้าวโพดฝักอ่อน" ||
$command == "ราคาถั่วเขียว" || $command == "ราคาถั่วฝักยาว" || $command == "ราคาถั่วเหลือง" || $command == "ราคาทุเรียน" || $command == "ราคาปลา" || $command == "ราคาปาล์มน้ำมัน" ||
$command == "ราคาเป็ด" || $command == "ราคาผักชี" || $command == "ราคามะนาว" || $command == "ราคามะพร้าว" || $command == "ราคามะละกอ" || $command == "ราคามะลิ" || 
$command == "ราคามังคุด" || $command == "ราคามันสำปะหลัง" || $command == "ราคายางพารา" || $command == "ราคาลองกอง" || $command == "ราคาสับปะรด" || $command == "ราคาสุกร" ||
$command == "ราคาหน่อไม้ฝรั่ง" || $command == "ราคาหอมแดง" || $command == "ราคาเห็ด" || $command == "ราคาเบญจมาศ"){
  if ($command == "ราคากระเทียม") {
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
  elseif ($command == "ราคาสับปะรด") {
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
  $querylocation = "SELECT * FROM bot_log WHERE user_id = '$userId'";
  $resultlocation = $mysql->query($querylocation);
  $rowlocation = mysqli_fetch_assoc($resultlocation);
  $latitude = $rowlocation['user_latitude'];
  $longitude = $rowlocation['user_longitude'];
  $address = $rowlocation['user_address'];
  if($latitude == NULL || $longitude == NULL ){
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
  }
  else{
    $querylocation = "SELECT * FROM bot_log WHERE user_id = '$userId'";
    $resultlocation = $mysql->query($querylocation);
    $rowlocation = mysqli_fetch_assoc($resultlocation);
    $latitude = $rowlocation['user_latitude'];
    $longitude = $rowlocation['user_longitude'];
    $address = $rowlocation['user_address'];
    $headers = array('Accept' => 'application/json');
    $data = array('latitude' => "$latitude", 'longitude' => "$longitude" );
    $body = Unirest\Request\Body::json($data);
    $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$headers,$body);
    $json = json_decode($response1->raw_body, true);

    $jsonsubtype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getSubtype/'.$typeid);
    $objsubtype = json_decode($jsonsubtype);
    $i =0;
    $rowtext = 1;
    $datacountrowtype1 = 0;

    $datacountrowtype3 = 2;
 
    //$rowtext = 1;
    $arrayPostData['replyToken'] = $replyToken;
    //$arrayPostData['to'] = $uid;
    $arrayPostData['messages'][0]['type'] = "flex";
    $arrayPostData['messages'][0]['altText'] = "$command";
    $arrayPostData['messages'][0]['contents']['type'] = "carousel";
    for($i=0;$i<=Count($objsubtype);$i++){
      $type_id = $objsubtype[$i]->type_id;
      $subtype_id = $objsubtype[$i]->subtype_id;
      $subtype_name = $objsubtype[$i]->subtype_name;
    //$category_id = 1;
    if($typeid == $type_id){
    // $headers = array('Accept' => 'application/json');
    // $data = array('latitude' => "$latitude", 'longitude' => "$longitude" );
    // $body = Unirest\Request\Body::json($data);
    // $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$headers,$body);
    // $json = json_decode($response1->raw_body, true);
    //$uri = "https://chaokaset.openservice.in.th/index.php/priceservices/getmarket";    



      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['type'] = "bubble";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['text'] = "$subtype_name";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['size'] = "lg";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['weight'] = "bold";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['color'] = "#ffffff";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['wrap'] = true;
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['styles']['header']['backgroundColor'] = "#25BAC8";
      
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['spacing'] = "md";

      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['layout'] = "vertical";
      

      $jsonsubtypeall = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getLastUpdate');
      $objsubtypeall = json_decode($jsonsubtypeall);
      $datacountrowtype = 0;
      $j= 0;
      //$datacountrowtype2 = 0;
      for($j=0;$j<=Count($objsubtypeall);$j++){
          //$type_id = $objsubtypeall[$j]->type_id;
          $ssubtype_id = $objsubtypeall[$j]->subtype_id;
          $ssubtype_name = $objsubtypeall[$j]->subtype_name;
          $location_name = $objsubtypeall[$j]->location_name;
          $province_name = $objsubtypeall[$j]->province_name;
          $unit_name = $objsubtypeall[$j]->unit_name;
          $reference_name = $objsubtypeall[$j]->reference_name;
          $product_price = $objsubtypeall[$j]->product_price;
          $lastUpdate = $objsubtypeall[$j]->lastUpdate;
          $coord_longitude = $objsubtypeall[$j]->coord_longitude;
          $coord_latitude = $objsubtypeall[$j]->coord_latitude;
        if($subtype_id == $ssubtype_id && $location_name != '' ){
          foreach($json['data']['list'] as $temp){ 
            $resultlo = $temp['location_name'];
            $resultpn = $temp['province_name'];
            $resultcsbt = $temp['subtype_name'];
            $resultclot = $temp['coord_latitude'];
            $resultclon = $temp['coord_longitude'];
            $resultcdis = $temp['coord_distance'];
            $resultclen = $json['data']['lenght'];
            //echo $number;
            $resultresultcdis = round($resultcdis,2);
            // echo $result;

          if($location_name == $resultlo && $ssubtype_name == $resultcsbt){

            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "สถานที่ใกล้ตัว : $location_name ";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
            $datacountrowtype += 1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "จังหวัด $province_name";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
            $datacountrowtype += 1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "ราคา $product_price $unit_name";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "lg";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['weight'] = "bold";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
            $datacountrowtype += 1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "ระยะทาง $resultresultcdis กิโลเมตร";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
            $datacountrowtype += 1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "อัปเดตล่าสุด : $lastUpdate";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
            $datacountrowtype += 1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "แหล่งที่มา : $reference_name";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
            $datacountrowtype += 1;
          // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
          // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "--------------------------";
          // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
          // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
          // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;   
          // $datacountrowtype += 1;
          }
        }
        }
      }
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['type'] = "box";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['layout'] = "vertical";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['type'] = "text";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Application";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['size'] = "xs";
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['wrap'] = true;
      $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['align'] = "center";
      //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['action']['uri'] = "line://nv/location";
      //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][0]['style'] = "primary";
      $datacountrowtype1 += 1;    
              }
      }

      replyMsg($arrayHeader,$arrayPostData);

  }

}
if (isset($mreply)) {
    $result = json_encode($mreply);
    $client->replyMessage($mreply);
}  
   // file_put_contents('log.txt',file_get_contents('php://input'));
?>