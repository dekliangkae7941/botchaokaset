<?php
#-------------------------[include]-------------------------#
#--------------------------------------------------------------------------------------------------------------------#
include "bot_header.php";
include "admin/connectdb.php";
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
///////////
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
///////////////
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
///////////
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
//////////////
elseif ($type == 'follow' || $command == "แก้ไขแปลงเพาะปลูก") {
    $query = "INSERT INTO line_log (userid , displayName) VALUES ('$userId','$displayName')";
    $result = pg_query($query);
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
/////////////
elseif ($type == 'unfollow') {
    $sql = "DELETE FROM line_log WHERE userId = '$userId'";
    $result = pg_query($sql);
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
///////////
#-------------------------[MSG TYPE]-------------------------#
/*elseif ($msg_type == 'file') {
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
$fileurl = 'https://botphp2019.herokuapp.com' . $fileFullSavePath;
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
////////////////
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
$picurl = 'https://botphp2019.herokuapp.com' . $fileFullSavePath;
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
////////////////
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
$vidurl = 'https://botphp2019.herokuapp.com' . $fileFullSavePath;
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
////////////////
elseif ($msg_type == 'audio') {
  $url = 'https://api.line.me/v2/bot/message/' . $messageid . '/content';
$headers = array('Authorization: Bearer ' . $channelAccessToken);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
$ran = date("YmdHis");
$botDataUserFolder = './user/file/audio/' . $userId;
                    if(!file_exists($botDataUserFolder)) {
                        mkdir($botDataUserFolder, 0777, true);
                    } 
$fileFullSavePath = $botDataUserFolder . '/' . $ran . '.m4a';
$audurl = 'https://botphp2019.herokuapp.com' . $fileFullSavePath;
file_put_contents($fileFullSavePath,$result);
  $text = "บันทึกไฟล์เสียงเรียบร้อยแล้ว";
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            ),
            array(
                'type' => 'text',
                'text' => $audurl
            )
        )
    );
}
////////////////
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
}*/
///////////////////
elseif ($msg_type == 'location') {
    ////คือกดสภาพอากาศ แล้วส่งคำว่า lo...ไป เมื่อส่งไปให้ดึงข้อมูลละติ ลองจิ ของโลเคชันจากดาต้าเบสออกมาละส่งไปopenwเลย ส่วนโปรไฟล์จะมีให้แก้ไขที่อยู่ และแก้ไขแปลงผัก
    $query = "UPDATE line_log SET latitude = '$msg_latitude',longitude = '$msg_longitude', address = '$msg_address' WHERE userid = '$userId'";
    $result = pg_query($query);
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

}

#--------------------------------------[case]--------------------------------------------#
elseif ($command != '') {

    $query = "UPDATE line_log SET displayName = '$displayName' WHERE userid = '$userId'";
    $result = pg_query($query);
    if($command == 'Location' || $command == 'สภาพอากาศ'){
        $querylocation = "SELECT * FROM line_log WHERE userid = '$userId'";
        $resultlocation= pg_query($dbconn, $querylocation);
        $rowlocation = pg_fetch_array($resultlocation);
        $latitude = $rowlocation['latitude'];
        $longitude = $rowlocation['longitude'];
        $address = $rowlocation['address'];
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
    elseif($command == 'พืชไร่'||$command == 'พืชสวน'||$command == 'ประมง'||$command == 'ปศุสัตว์'){
        //$command = $plan_category;
        $queryplan = "UPDATE line_log SET plan_category = '$command' WHERE userid = '$userId'";
        $resultplan = pg_query($queryplan);
        $text1 = "ขอบคุณสำหรับการเลือกประเภทการเพาะปลูกเพื่อรับแจ้งเตือน";
        $text2 = "กรุณาอนุญาตการเข้าถึงที่อยู่ตำแหน่งของคุณ โดยการกดปุ่มระบุตำแหน่งด้านล่าง เพื่อบันทึกที่อยู่ของท่าน";
        $querylocation = "SELECT * FROM line_log WHERE userid = '$userId'";
        $resultlocation= pg_query($dbconn, $querylocation);
        $rowlocation = pg_fetch_array($resultlocation);
        $latitude = $rowlocation['latitude'];
        $longitude = $rowlocation['longitude'];
        $address = $rowlocation['address'];
        if($latitude == NULL || $longitude == NULL){
            $mreply = array(
                'replyToken' => $replyToken,
                'messages' => array(
                    array(
                        'type' => 'text',
                        'text' => $text1
                    ),array(
                        'type' => 'text',
                        'text' => $text2,
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
                        'text' => $text1
                    )
                )
            );
        }
        
    }elseif($command == "แก้ไขที่อยู่"){
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
    /////////////
    else {
        
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
                    //$arrayPostData['to'][0] = $uid;
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
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Application";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
                    $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
                    $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
                    replyMsg($arrayHeader,$arrayPostData);
                            }
                }
 //////////////////////// 
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
            // $querytype = "SELECT line_type.type_name, line_subtype.type_id, line_subtype.subtype_id,line_subtype.subtype_name,
            // line_subtype_all.location_name,line_subtype_all.product_price ,line_subtype_all.coord_latitude
            // FROM line_type
            // INNER JOIN line_subtype ON line_type.type_id=line_subtype.type_id
            // INNER JOIN line_subtype_all ON line_subtype.subtype_id=line_subtype_all.subtype_id 
            // where line_type.type_id = '$typeid'
            // order by line_subtype_all.product_price DESC";
            $querytype = "SELECT * FROM line_subtype WHERE type_id = '$typeid'";
            if($resulttype = pg_query($dbconn, $querytype)){
                if(pg_num_rows($resulttype) > 0){
                    $querylog = "SELECT * FROM line_log WHERE userid = '$userId'";
                    $resultlog = pg_query($dbconn, $querylog);
                    $rowlog = pg_fetch_array($resultlog);
                    $latitude = $rowlog['latitude'];
                    $longitude = $rowlog['longitude'];
                    // $headers = array('Accept' => 'application/json');
                    // $data = array('latitude' => "$latitude", 'longitude' => "$longitude" );
                    // $body = Unirest\Request\Body::json($data);
                    // $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$headers,$body);

                    // $json = json_decode($response1->raw_body, true);
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
                    $querylog = "SELECT * FROM line_log WHERE userid = '$userId'";
                    $resultlog = pg_query($dbconn, $querylog);
                    $rowlog = pg_fetch_array($resultlog);
                    $plan_category = $rowlog['plan_category'];
                    //$ddisplayName = $rowlog['displayName'];
                    $address = $rowlog['address'];
                    $latitude = $rowlog['latitude'];
                    $longitude = $rowlog['longitude'];
                    $headers = array('Accept' => 'application/json');
                    $data = array('latitude' => "$latitude", 'longitude' => "$longitude" );
                    $body = Unirest\Request\Body::json($data);
                    $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$headers,$body);
                    $json = json_decode($response1->raw_body, true);
                    //$uri = "https://chaokaset.openservice.in.th/index.php/priceservices/getmarket";    

                    $arrayPostData['replyToken'] = $replyToken;
                    //$arrayPostData['to'] = $uid;
                    $arrayPostData['messages'][0]['type'] = "flex";
                    $arrayPostData['messages'][0]['altText'] = "$command";
                    $arrayPostData['messages'][0]['contents']['type'] = "carousel";

                    $datacountrowtype1 = 0;
                    $datacountrowtype2 = 0;
                    $datacountrowtype3 = 2;
                    while($rowtype = pg_fetch_array($resulttype)){
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
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['styles']['header']['backgroundColor'] = "#25BAC8";
                    
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['layout'] = "vertical";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['spacing'] = "md";

                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['type'] = "box";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['layout'] = "vertical";
                      

                    $querystype = "SELECT * FROM line_subtype_all
                    WHERE subtype_id = '$subtype_id'";
                    ///ถ้าผู้ใช้มีlocationให้เลือกพื้นที่ใกล้ที่สุดมา3อัน แต่ถ้าไม่มีโลเคชันบอทจะเลือกข้อมูลที่ราคาแพงสุดมา3อัน || หรือวนไปให้ส่งโลเคชัน ???
                    $resultstype = pg_query($dbconn, $querystype);
                    //var_dump($json);
                    // while($rowstype = pg_fetch_array($resultstype)){
                    // $location_name = $rowstype['location_name'];

                    //echo json_encode($json);
                    
                    //var_dump($resultlo);
                    //var_dump($location_name);
                    //echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
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
                            $ssubtype_name = $rowstype['subtype_name'];
                            
                            // foreach($json['data']['list'] as $temp){
                            //   $resultlo = $temp['location_name'];
                            //   $resultpn = $temp['province_name'];
                            //   $resultclot = $temp['coord_latitude'];
                            //   $resultclon = $temp['coord_longitude'];
                            //   $resultcdis = $temp['coord_distance'];
                            //   $resultclen = $json['data']['lenght'];
          
                            //   $text1 = " พื้นที่ : " . $latitude." : ".$longitude. "\n";
                            //   $text2 = " สภาพอากาศ : " . $resultlo." : ".$resultpn . "//" .$resultcdis."\n";
                            //   $text3 = " รายละเอียด : " . $resultclot." : ".$resultclon . "//" .$resultclen."\n";
                            //echo json_encode($json);
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
                            $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "อัปเดตล่าสุด : $lastupdate";
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
                            // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "--------------------------------------------------";
                            // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                            // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "md";
                            // $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                            // $datacountrowtype += 1;
                            }
                            
                          } 
                        }                    
                      
                    /*
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['type'] = "button";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type'] = "action";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type']['action']['type'] = "location";
                    $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type']['action']['label'] = "กดที่นี่เพื่อหาร้านค้าใกล้ตัว";*/

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
                  
                    pg_free_result($resulttype);
                    replyMsg($arrayHeader,$arrayPostData);
                  }
                }
              }    
 
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
        if($command == "เตือนภัยเกษตรล่าสุด"){
          $uriw = "https://chaokaset.openservice.in.th/index.php/doaservices/notifysent";
            $response = Unirest\Request::get("$uriw");
            $json = json_decode($response->raw_body, true);
            $i = 0;

            
              /////////////////////////////////
  
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
              $name = $json[$i]['name'];
              $growing = $json[$i]['growing'];
              $weather = $json[$i]['weather'];
              $problem = $json[$i]['problem'];
              $warning = $json[$i]['detail']['warning'];
              $solution = $json[$i]['detail']['solution'];
              $date_start = $json[$i]['detail']['date_start'];
              $date_end = $json[$i]['detail']['date_end'];
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


            //   $mreply = array(
            //     'replyToken' => $replyToken,
            //     'messages' => array(
            //         array (
            //             'type' => 'flex',
            //             'altText' => 'เตือนภัยเกษตรล่าสุด',
            //             'contents' => 
            //             array (
            //               'type' => 'bubble',
            //               'direction' => 'ltr',
            //               'header' => 
            //               array (
            //                 'backgroundColor' => '#F460A6',
            //                 'type' => 'box',
            //                 'layout' => 'vertical',
            //                 'contents' => 
            //                 array (
            //                   0 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => 'เตือนภัยเกษตรล่าสุด',
            //                     'size' => 'lg',
            //                     'weight' => 'bold',
            //                     'align' => 'start',
            //                     'color' => '#ffffff',
            //                     'wrap' => true,
            //                   ),
            //                 ),
            //               ),
            //               // 'hero' => 
            //               // array (
            //               //   'type' => 'image',
            //               //   'url' => 'https://wi-images.condecdn.net/image/doEYpG6Xd87/crop/2040/f/weather.jpg',
            //               //   'size' => 'full',
            //               //   'aspectRatio' => '1.51:1',
            //               //   'aspectMode' => 'fit',
            //               // ),
            //               'body' => 
            //               array (
            //                 'type' => 'box',
            //                 'layout' => 'vertical',
            //                 'contents' => 
            //                 array (
            //                   0 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "$name",
            //                     'size' => 'xxl',
            //                     'weight' => 'bold',
            //                     'wrap' => true,
            //                   ),
            //                   1 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "ระยะเวลา : วันที่ $date_end",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                   2 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "สภาพแวดล้อม : $weather",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                   3 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "ระยะการเจริญเติบโต : $growing",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                   4 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "ปัญหาที่ควรระวัง : $problem",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                   5 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "อาการที่อาจพบ : $warning",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                   6 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => "แนวทางป้องกัน : $solution",
            //                     'size' => 'md',
            //                     'wrap' => true,
            //                   ),
            //                 ),
            //               ),
            //               'footer' => 
            //               array (
            //                 'type' => 'box',
            //                 'layout' => 'horizontal',
            //                 'contents' => 
            //                 array (
            //                   0 => 
            //                   array (
            //                     'type' => 'text',
            //                     'text' => 'ข้อมูลจาก Chaokaset Application',
            //                     'size' => 'sm',
            //                     'align' => 'center',
            //                     'color' => '#CBC5C5',
            //                   ),
            //                 ),
            //               ),
            //             ),
            //           )
            //     )
            // );          
          }
        

        if($command == "ราคาน้ำมัน"){
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
        elseif($command == "ท"){
          $querylog = "SELECT * FROM line_log WHERE userid = 'Udac6e87952f7ba83e230875996a1107f'";
          $resultlog = pg_query($dbconn, $querylog);
          $rowlog = pg_fetch_array($resultlog);
          $plan_category = $rowlog['plan_category'];
          //$ddisplayName = $rowlog['displayName'];
          $address = $rowlog['address'];
          $latitude = $rowlog['latitude'];
          $longitude = $rowlog['longitude'];
          //$ppictureUrl = $rowlog['pictureUrl'];
//           echo $plan_category."\n" ;
//           //echo $displayName ."\n";
//           echo $address ."\n";
//           //echo $pictureUrl ."\n";
// /////////////////////////  
//           echo $latitude." : ".$longitude."\n";
//   //////////////////////////////////
//           echo "123456788888888";
          
          /////////////////////////////////////////
          $limit = 10;
          $headers = array('Accept' => 'application/json');
          $data = array('latitude' => "$latitude", 'longitude' => "$longitude" );
          $body = Unirest\Request\Body::json($data);
          $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$headers,$body);
          $json = json_decode($response1->raw_body, true);
          //$uri = "https://chaokaset.openservice.in.th/index.php/priceservices/getmarket";
          $n = 1;
          $querystype = "SELECT * FROM line_subtype_all WHERE subtype_id = 1";
                  ///ถ้าผู้ใช้มีlocationให้เลือกพื้นที่ใกล้ที่สุดมา3อัน แต่ถ้าไม่มีโลเคชันบอทจะเลือกข้อมูลที่ราคาแพงสุดมา3อัน || หรือวนไปให้ส่งโลเคชัน ???
          $resultstype = pg_query($dbconn, $querystype);
          //var_dump($json);
        while($rowstype = pg_fetch_array($resultstype)){
          $location_name = $rowstype['location_name'];
          $subtype_name = $rowstype['subtype_name'];
        
          //echo json_encode($json);
            foreach($json['data']['list'] as $temp){
              $resultlo = $temp['location_name'];
              $resultpn = $temp['province_name'];
              $resultclot = $temp['coord_latitude'];
              $resultclon = $temp['coord_longitude'];
              $resultcdis = $temp['coord_distance'];
              $resultcdis = $temp['subtype_name'];
              $resultclen = $json['data']['lenght'];
          
              $text1 = " พื้นที่ : " . $latitude." : ".$longitude. "\n";
              $text2 = " สภาพอากาศ : " . $resultlo." : ".$resultpn . "//" .$resultcdis."\n";
              $text3 = " รายละเอียด : " . $resultclot." : ".$resultclon . "//" .$resultclen."\n";
              //var_dump($resultlo);
              //var_dump($location_name);
              //echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
              if($subtype_name == $subtype_name){
                // echo '5555555555';
                // echo $text1. "\n";
                // echo $text2. "\n";
                // echo $text3. "\n";
                $mreply = array(
                  'replyToken' => $replyToken,
                  'messages' => array(
                      array(
                          'type' => 'text',
                          'text' => "$text1\\$text2//$text3"
                      )
                  )
                );
                // $result = json_encode($mreply);
                // $client->replyMessage($mreply);
              }
              else{
                $mreply = array(
                  'replyToken' => $replyToken,
                  'messages' => array(
                      array(
                          'type' => 'text',
                          'text' => "$text1\\$text2//$text3"
                      )
                  )
                );
            }
            
          }
        }
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
        else {
                            
            /*$uri = "https://chaokaset.openservice.in.th/index.php/doaservices/notifysent";
            $response = Unirest\Request::get("$uri");
            $json = json_decode($response->raw_body, true);
            $resulta = $json['name'];
            $resultb = $json['weather'][0]['main'];
            $resultc = $json['weather'][0]['description'];
            $resultd = $json['main']['temp'];
            $resulte = $json['coord']['lon'];
            $text .= " พื้นที่ : " . $resulta . "\n";
            $text .= " สภาพอากาศ : " . $resultb . "\n";
            $text .= " รายละเอียด : " . $resultc . "\n";
            $text .= " อุณหภูมิ : " . $resultd;*/
            
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
        }
        /////////
    }
}
if (isset($mreply)) {
    $result = json_encode($mreply);
    $client->replyMessage($mreply);
}
  file_put_contents('log.txt',file_get_contents('php://input'));
  pg_close($dbconn);
?>