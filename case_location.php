<?php
#-------------------------[include]-------------------------#
#--------------------------------------------------------------------------------------------------------------------#
include "bot_header.php";
include "admin/connectdb.php";
include "index.php";
$command = $_GET['command'];
if($command == 'Location' || $command == 'สภาพอากาศ'){
// $command == 'Location' || $command == 'สภาพอากาศ';
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