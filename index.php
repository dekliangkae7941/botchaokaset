
<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h2>Enter data into book table</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li>Book Name:</li><li><input type="text" name="book_name" /></li>
<li>Price (USD):</li><li><input type="text" name="price" /></li>
<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>
<?php

$dbconn = pg_connect("host=ec2-107-22-211-248.compute-1.amazonaws.com dbname=dant72mtqngrqg user=zzeiglpdbgcsup password=357b5ef3838e36150679d259aeb37a2c9d2ec1dafb8ae5c90e7669d040874a9e");
if (!$dbconn){
echo "<center><h1>Doesn't work =(</h1></center>";
}else
 echo "<center><h1>Good connection</h1></center>";

#--------------------------------------------------------------------------------------------------------------------#
// Attempt select query execution
$querylog = "SELECT * FROM line_log ";
                $resultlog = pg_query($dbconn, $querylog);
                $rowlog = pg_fetch_array($resultlog);
                $latitude = $rowlog['latitude'];
                $longitude = $rowlog['longitude'];
                echo "$latitude : $longitude";
$sql = "SELECT * FROM line_type WHERE category_id = '1'";
if($result = pg_query($dbconn, $sql)){
    if(pg_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>first_name</th>";
            echo "</tr>";
        while($row = pg_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['type_id'] . "</td>";
                echo "<td>" . $row['type_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        pg_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . pg_result_error($link);
}
// Close connection
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
#--------------------------------------------------------------------------------------------------------------------#

#------------------------------------------------------------------------------------------------------------#
#-------------------------[Include]-------------------------#
require_once('./include/line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
#-------------------------[Token]-------------------------#
$channelAccessToken = 'pZmLfAv73zYnio19mFJo2hudRTgr7y8FbMdAayR7VXep+rZyVt1NAAEL+ZcsjfbrA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vzhQPrIgSXQ3Uj23DnEpFiCa+MC60K2WexRcqsdgTDQ6gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'ddfedb5ad9fad19c7c0bbe791cd28166';


$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$channelAccessToken}";

#------------------------------------------------------------------------#
#-------------------------[Events]-------------------------#

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
//รับข้อความจากผู้ใช้
//$messages = $arrayJson['events'][0]['message']['text'];
//รับ id ของผู้ใช
$uid = $arrayJson['events'][0]['source']['userId'];
$userId     = $client->parseEvents()[0]['source']['userId'];
$groupId    = $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp  = $client->parseEvents()[0]['timestamp'];
$type       = $client->parseEvents()[0]['type'];
$message    = $client->parseEvents()[0]['message'];
$profile    = $client->profil($userId);
//$repro      = json_encode($profile);
$en_profile = json_encode($profile, true);
$de_profile = json_decode($en_profile, true);
$displayName    = $de_profile['displayName'];
$messageid  = $client->parseEvents()[0]['message']['id'];
$msg_type      = $client->parseEvents()[0]['message']['type'];

$post_data      = $client->parseEvents()[0]['postback']['data'];

$msg_file      = $client->parseEvents()[0]['message']['fileName'];
$msg_message   = $client->parseEvents()[0]['message']['text'];
$msg_title     = $client->parseEvents()[0]['message']['title'];
$msg_address   = $client->parseEvents()[0]['message']['address'];
$msg_latitude  = $client->parseEvents()[0]['message']['latitude'];
$msg_longitude = $client->parseEvents()[0]['message']['longitude'];
#----Check title empty----#
if (empty($msg_title)) {
    $msg_title = 'ตำแหน่งของคุณ คือ ';
}
#----command option----#
$usertext = explode(" ", $message['text']);
$command = $usertext[0];
$options = $usertext[1];
if (count($usertext) > 2) {
    for ($i = 2; $i < count($usertext); $i++) {
        $options .= '+';
        $options .= $explode[$i];
    }
}
#----command option----#
$remsg = json_encode($message, true);
$remsg1 = json_decode($remsg, true);
$remsg2 = $remsg1['text'];
$stickerId = $remsg1['stickerId'];
$reline = json_encode($profile, true);
$reline1 = json_decode($reline, true);
$reline2 = $reline1['displayName'];
#-------------------------[Func]-------------------------#
function replyMsg($arrayHeader,$arrayPostData){
    $strUrl = "https://api.line.me/v2/bot/message/reply";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close ($ch);
}
/*function pushMsg($arrayHeader,$arrayPostData){
    $strUrl = "https://api.line.me/v2/bot/message/push";
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
}*/
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
elseif ($type == 'follow') {
    $query = "INSERT INTO line_log (userid , displayName) VALUES ('$userId','$displayName')";
    $result = pg_query($query);
	    //$text = "เมื่อผู้ใช้กดติดตามบอท";
    /*$mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => 'สวัสดีจ้าคุณ '.$displayName.' userId ของคุณคือ '.$userId
            )
        )
    );*/
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
            'styles' => 
            array (
              'header' => 
              array (
                'backgroundColor' => '#FCFA7E',
              ),
            ),
            'header' => 
            array (
              'type' => 'box',
              'layout' => 'vertical',
              'contents' => 
              array (
                0 => 
                array (
                  'type' => 'text',
                  'text' => 'กรุณาเลือกชนิดการเพาะปลูก  เพื่อรับแจ้งเตือน',
                  'size' => 'lg',
                  'weight' => 'bold',
                  'color' => '#000000',
                  'wrap' => true,
                ),
                1 => 
                array (
                  'type' => 'text',
                  'text' => '*คุณจะไม่สามารถแก้ไขชนิดการเพาะปลูกได้',
                  'size' => 'xxs',
                  'weight' => 'bold',
                  'color' => '#F33232',
                  'wrap' => true,
                ),
              ),
            ),
            'body' => 
            array (
              'type' => 'box',
              'layout' => 'horizontal',
              'spacing' => 'md',
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
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'ข้าว',
                        'text' => 'ข้าว',
                      ),
                      'color' => '#DA7D40',
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
                        'label' => 'ข้าวโพด',
                        'text' => 'ข้าวโพด',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    3 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    4 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'ถั่วเหลือง',
                        'text' => 'ถั่วเหลือง',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    5 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    6 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'ถั่วเขียว',
                        'text' => 'ถั่วเขียว',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    7 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    8 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'ลำไย',
                        'text' => 'ลำไย',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    9 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    10 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'คะน้า',
                        'text' => 'คะน้า',
                      ),
                      'color' => '#DA7D40',
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
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'ตะไคร้หอม',
                        'text' => 'ตะไคร้หอม',
                      ),
                      'color' => '#DA7D40',
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
                        'label' => 'เห็ด',
                        'text' => 'เห็ด',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    3 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    4 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'กาแฟ',
                        'text' => 'กาแฟ',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    5 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    6 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'มันสำปะหลัง',
                        'text' => 'มันสำปะหลัง',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    7 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    8 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'มะเขือเทศ',
                        'text' => 'มะเขือเทศ',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                    9 => 
                    array (
                      'type' => 'separator',
                      'margin' => 'md',
                    ),
                    10 => 
                    array (
                      'type' => 'button',
                      'action' => 
                      array (
                        'type' => 'message',
                        'label' => 'กำหนดเอง',
                        'text' => 'กำหนดเอง',
                      ),
                      'color' => '#DA7D40',
                      'style' => 'primary',
                    ),
                  ),
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
                  'size' => 'xs',
                  'align' => 'center',
                )
              )
            )
          )
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
    $query = "UPDATE line_log SET latitude = '$msg_latitude',longitude = '$msg_longitude' WHERE userid = '$userId'";
    //"INSERT INTO line_log (userid latitude , longitude) VALUES ('$userId','$msg_latitude','$msg_longitude')";
    $result = pg_query($query);
    $uri = "https://api.openweathermap.org/data/2.5/weather?lat=" . $msg_latitude . "&lon=" . $msg_longitude . "&lang=th&units=metric&appid=bb32ab343bb6e3326f9e1bbd4e4f5d31";
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
    $text .= " อุณหภูมิ : " . $resultd;
    $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                /*'type' => 'location',
                'title' => $msg_title,
                'address' => $msg_address,
                'latitude' => $msg_latitude,
                'longitude' => $msg_longitude
            ),            array(*/
                'type' => 'text',
                'text' => $text
            )
        )
    );

}
elseif($command == 'ข้าว'||$command == 'ข้าวโพด'||$command == 'ถั่วเหลือง'||$command == 'ถั่วเขียว'||$command == 'ลำไย'||$command == 'คะน้า'|| $command == 'ตะไคร้หอม'||$command == 'เห็ด'||$command == 'กาแฟ'||$command == 'มันสำปะหลัง'||$command == 'มะเขือเทศ'||$command == 'กำหนดเอง'){
    //$command = $plat_name;
    $query = "UPDATE line_log SET plat_name = '$command' WHERE userid = '$userId'";
    $result = pg_query($query);
    $text = "ขอบคุณสำหรับการเลือกชนิดการเพาะปลูกเพื่อรับแจ้งเตือน";
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
/////////////
else {
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
                $arrayPostData['messages'][0]['altText'] = "ราคาตลาด$command";
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
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['text'] = "$command";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['weight'] = "bold";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['header']['contents'][0]['color'] = "#ffffff";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['styles']['header']['backgroundColor'] = "#cb4335";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['type'] = "image";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['url'] = "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_5_carousel.png";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['size'] = "full";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['aspectRatio'] = "20:13";
                //$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['hero']['aspectMode'] = "cover";
                
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['spacing'] = "md";

                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['type'] = "box";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['text'] = "$subtype_name";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['flex'] = $datacountrowtype1;
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['weight'] = "bold";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][0]['wrap'] = true;
                
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['text'] = "_____________________";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['flex'] = $datacountrowtype1;
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['weight'] = "bold";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][1]['wrap'] = true;
                //$datacountrowtype += 1;

                $querylog = "SELECT * FROM line_log WHERE userid = '$userId'";
                $resultlog = pg_query($dbconn, $querylog);
                $rowlog = pg_fetch_array($resultlog);
                $latitude = $rowlog['latitude'];
                $longitude = $rowlog['longitude'];
//echo "$latitude : $longitude";
                $querystype = "SELECT DISTINCT location_name, * ,ABS(coord_longitude-$longitude)as lo ,ABS(coord_latitude-$latitude)as la FROM line_subtype_all
                WHERE subtype_id = '$subtype_id' 
                ORDER BY lo,la";
                 


/*

SELECT DISTINCT location_name, * FROM line_subtype_all
FULL OUTER JOIN line_log
ON table1.column_name = table2.column_name
WHERE condition;
                    SELECT * FROM ( <= SELECT ชั้นนอกใช้เพื่อเรียงลำดับผลลัท์ตาม id
                    SELECT id,field_name,ABS(id-5) AS p
                    FROM table_name
                    WHERE id!=5 <= ไม่รวมรายการที่ต้องการ
                    ORDER BY p <= เรียงลำดับตาม ABS()
                    LIMIT 4
                    ) AS Q ORDER BY id

                "SELECT *FROM line_subtype
                RIGHT JOIN line_subtype_all
                ON line_subtype.subtype_id = line_subtype_all.subtype_id
                WHERE line_subtype.subtype_id = '$subtype_id'";
                $sql = "SELECT * FROM booking WHERE month = '04' ";
                */
                $resultstype = pg_query($dbconn, $querystype);
                $datacountrowtype = 2;
                    while($rowstype = pg_fetch_array($resultstype)){
                        $location_name = $rowstype['location_name'];
                        $province_name = $rowstype['province_name'];
                        $unit_name = $rowstype['unit_name'];
                        $reference_name = $rowstype['reference_name'];
                        $product_price = $rowstype['product_price'];
                        $lastupdate = $rowstype['lastupdate'];
                        $clatitude = $rowstype['coord_latitude'];
                        $clongitude = $rowstype['coord_longitude'];
                    function thaidate($lastupdate) //แปลงวันที่เป็นวันที่ไทย
                    {
                        $y = substr($lastupdate, 0, 4) + 543;
                        $m = substr($lastupdate, 5, 2);
                        $d = substr($lastupdate, 8, 9);
                        if ($lastupdate == "")
                        {
                            return "";
                        } else
                        {
                            return $d . "/" . $m . "/" . $y;
                        }
                    }

               /* $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "$subtype_name";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['weight'] = "bold";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                $datacountrowtype += 1;*/
                                
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "Location : $location_name ";
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
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "อัปเดตล่าสุด : $d $m $y";
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
                        /*$arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['type'] = "box";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['layout'] = "vertical";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['contents'][$datacountrowtype2]['type'] = "button";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['contents'][$datacountrowtype2]['style'] = "secondary";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['contents'][$datacountrowtype2]['action']['type'] = "message";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['contents'][$datacountrowtype2]['action']['label'] = "$location_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][1]['contents'][$datacountrowtype2]['action']['text'] = "$location_name";
                        $datacountrowtype2 += 1;
                        
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "button";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['style'] = "secondary";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['action']['type'] = "location";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['action']['title']= "$location_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['action']['address']= "$province_name";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['action']['latitude']= "$latitude";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['action']['longitude']= "$longitude";

                                                                                                                                                    
                        $datacountrowtype += 1;*/
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['type'] = "text";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['text'] = "--------------------------------------------------";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['flex'] = $datacountrowtype1;
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['size'] = "sm";
                        $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['body']['contents'][0]['contents'][$datacountrowtype]['wrap'] = true;
                        $datacountrowtype += 1;
                        
                    }    
                /*
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type'] = "action";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type']['action']['type'] = "location";
                $arrayPostData['messages'][0]['contents']['contents'][$datacountrowtype1]['footer']['contents'][1]['action']['type']['action']['label'] = "กดที่นี่เพื่อหาร้านค้าใกล้ตัว";*/

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
    /////////////////////////
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
            foreach ($xml  as  $key =>$val) {  
                if($val->PRODUCT != ' '){
                    echo $val->PRODUCT .'  '.$val->PRICE.' บาท<br>';
                }
            }
    
    }
    #ตัวอย่าง Message Type "Text + Sticker"
    elseif($command == "ข่าววันนี้"){
        //$arrayPostData['messages'][0]['type'] = "text";
        //$arrayPostData['messages'][0]['text'] = "สวัสดีจ้า";
        //$arrayPostData['messages'][1]['type'] = "sticker";
        //$arrayPostData['messages'][1]['packageId'] = "2";
        //$arrayPostData['messages'][1]['stickerId'] = "34";
        
        ///////////////////////////////////////
#-------------------------[Include]-------------------------#
        $urinews1 = file_get_contents('./news/news.json');
            $jsonnews1 = json_decode($urinews1, true);
            $resultnews11 = $jsonnews1['articles'][0]['title'];
            $resultnews12 = $jsonnews1['articles'][0]['description'];
            $resultnews13x = $jsonnews1['articles'][0]['url'];
            $resultnews13 = str_ireplace('http:','https:',$resultnews13x);
            $resultnews14x = $jsonnews1['articles'][0]['urlToImage'];
            $resultnews14 = str_ireplace('http:','https:',$resultnews14x);
        $urinews2 = file_get_contents('./news/news.json');
            $jsonnews2 = json_decode($urinews2, true);
            $resultnews21 = $jsonnews2['articles'][1]['title'];
            $resultnews22 = $jsonnews2['articles'][1]['description'];
            $resultnews23x = $jsonnews2['articles'][1]['url'];
            $resultnews23 = str_ireplace('http:','https:',$resultnews23x);
            $resultnews24x = $jsonnews2['articles'][1]['urlToImage'];
            $resultnews24 = str_ireplace('http:','https:',$resultnews24x);
        $urinews3 = file_get_contents('./news/news.json');
            $jsonnews3 = json_decode($urinews3, true);
            $resultnews31 = $jsonnews3['articles'][2]['title'];
            $resultnews32 = $jsonnews3['articles'][2]['description'];
            $resultnews33x = $jsonnews3['articles'][2]['url'];
            $resultnews33 = str_ireplace('http:','https:',$resultnews33x);
            $resultnews34x = $jsonnews3['articles'][2]['urlToImage'];
            $resultnews34 = str_ireplace('http:','https:',$resultnews34x);
        $urinews4 = file_get_contents('./news/news.json');
            $jsonnews4 = json_decode($urinews4, true);
            $resultnews41 = $jsonnews4['articles'][3]['title'];
            $resultnews42 = $jsonnews4['articles'][3]['description'];
            $resultnews43x = $jsonnews4['articles'][3]['url'];
            $resultnews43 = str_ireplace('http:','https:',$resultnews43x);
            $resultnews44x = $jsonnews4['articles'][3]['urlToImage'];
            $resultnews44 = str_ireplace('http:','https:',$resultnews44x);
        $urinews5 = file_get_contents('./news/news.json');
            $jsonnews5 = json_decode($urinews5, true);
            $resultnews51 = $jsonnews5['articles'][4]['title'];
            $resultnews52 = $jsonnews5['articles'][4]['description'];
            $resultnews53x = $jsonnews5['articles'][4]['url'];
            $resultnews53 = str_ireplace('http:','https:',$resultnews53x);
            $resultnews54x = $jsonnews5['articles'][4]['urlToImage'];
            $resultnews54 = str_ireplace('http:','https:',$resultnews54x);
        $urinews6 = file_get_contents('./news/news.json');
            $jsonnews6 = json_decode($urinews6, true);
            $resultnews61 = $jsonnews6['articles'][5]['title'];
            $resultnews62 = $jsonnews6['articles'][5]['description'];
            $resultnews63x = $jsonnews6['articles'][5]['url'];
            $resultnews63 = str_ireplace('http:','https:',$resultnews63x);
            $resultnews64x = $jsonnews6['articles'][5]['urlToImage'];
            $resultnews64 = str_ireplace('http:','https:',$resultnews64x);
        $urinews7 = file_get_contents('./news/news.json');
            $jsonnews7 = json_decode($urinews7, true);
            $resultnews71 = $jsonnews7['articles'][6]['title'];
            $resultnews72 = $jsonnews7['articles'][6]['description'];
            $resultnews73x = $jsonnews7['articles'][6]['url'];
            $resultnews73 = str_ireplace('http:','https:',$resultnews73x);
            $resultnews74x = $jsonnews7['articles'][6]['urlToImage'];
            $resultnews74 = str_ireplace('http:','https:',$resultnews74x);
        $urinews8 = file_get_contents('./news/news.json');
            $jsonnews8 = json_decode($urinews8, true);
            $resultnews81 = $jsonnews8['articles'][7]['title'];
            $resultnews82 = $jsonnews8['articles'][7]['description'];
            $resultnews83x = $jsonnews8['articles'][7]['url'];
            $resultnews83 = str_ireplace('http:','https:',$resultnews83x);
            $resultnews84x = $jsonnews8['articles'][7]['urlToImage'];
            $resultnews84 = str_ireplace('http:','https:',$resultnews84x);
        $urinews9 = file_get_contents('./news/news.json');
            $jsonnews9 = json_decode($urinews9, true);
            $resultnews91 = $jsonnews9['articles'][8]['title'];
            $resultnews92 = $jsonnews9['articles'][8]['description'];
            $resultnews93x = $jsonnews9['articles'][8]['url'];
            $resultnews93 = str_ireplace('http:','https:',$resultnews93x);
            $resultnews94x = $jsonnews9['articles'][8]['urlToImage'];
            $resultnews94 = str_ireplace('http:','https:',$resultnews94x);
        $urinews0 = file_get_contents('./news/news.json');
            $jsonnews0 = json_decode($urinews0, true);
            $resultnews01 = $jsonnews0['articles'][9]['title'];
            $resultnews02 = $jsonnews0['articles'][9]['description'];
            $resultnews03x = $jsonnews0['articles'][9]['url'];
            $resultnews03 = str_ireplace('http:','https:',$resultnews03x);
            $resultnews04x = $jsonnews0['articles'][9]['urlToImage'];
            $resultnews04 = str_ireplace('http:','https:',$resultnews04x);
            if(preg_replace('/[^ก-ฮ]/u','',$resultnews14)){
        $resultnews14ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews14 == NULL || $resultnews14 == '{{image}}'){
        $resultnews14ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews14ok = $resultnews14;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews24)){
        $resultnews24ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews24 == NULL || $resultnews24 == '{{image}}'){
        $resultnews24ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews24ok = $resultnews24;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews34)){
        $resultnews34ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews34 == NULL || $resultnews34 == '{{image}}'){
        $resultnews34ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews34ok = $resultnews34;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews44)){
        $resultnews44ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews44 == NULL || $resultnews44 == '{{image}}'){
        $resultnews44ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews44ok = $resultnews44;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews54)){
        $resultnews54ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews54 == NULL || $resultnews54 == '{{image}}'){
        $resultnews54ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews54ok = $resultnews54;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews64)){
        $resultnews64ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews64 == NULL || $resultnews64 == '{{image}}'){
        $resultnews64ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews64ok = $resultnews64;
        }    if(preg_replace('/[^ก-ฮ]/u','',$resultnews74)){
        $resultnews74ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews74 == NULL || $resultnews74 == '{{image}}'){
        $resultnews74ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews74ok = $resultnews74;
        }
            if(preg_replace('/[^ก-ฮ]/u','',$resultnews84)){
        $resultnews84ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews84 == NULL || $resultnews84 == '{{image}}'){
        $resultnews84ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews84ok = $resultnews84;
        }
            if(preg_replace('/[^ก-ฮ]/u','',$resultnews94)){
        $resultnews94ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews94 == NULL || $resultnews94 == '{{image}}'){
        $resultnews94ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews94ok = $resultnews94;
        }
            if(preg_replace('/[^ก-ฮ]/u','',$resultnews04)){
        $resultnews04ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';
        }elseif($resultnews04 == NULL || $resultnews04 == '{{image}}'){
        $resultnews04ok = 'https://cdn.pixabay.com/photo/2016/05/25/09/25/news-1414325_960_720.jpg';  
        }else{
        $resultnews04ok = $resultnews04;
        }
        if($resultnews12 == NULL){
        $resultnews12ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews12ok = $resultnews12;
        }
        if($resultnews22 == NULL){
        $resultnews22ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews22ok = $resultnews22;
        }
        if($resultnews32 == NULL){
        $resultnews32ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews32ok = $resultnews32;
        }
        if($resultnews42 == NULL){
        $resultnews42ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews42ok = $resultnews42;
        }
        if($resultnews52 == NULL){
        $resultnews52ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews52ok = $resultnews52;
        }
        if($resultnews62 == NULL){
        $resultnews62ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews62ok = $resultnews62;
        }
        if($resultnews72 == NULL){
        $resultnews72ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews72ok = $resultnews72;
        }
        if($resultnews82 == NULL){
        $resultnews82ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews82ok = $resultnews82;
        }
        if($resultnews92 == NULL){
        $resultnews92ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews92ok = $resultnews92;
        }
        if($resultnews02 == NULL){
        $resultnews02ok = 'ไม่มีเนื้อหาข่าวให้แสดง กรุณากดอ่านเพิ่มเติม'; 
        }else{
        $resultnews02ok = $resultnews02;
        }
            $mreply = array(
                'messages' => array( 
                array(  
                'type' => 'flex',
                'altText' => 'ข่าวทันเหตุการณ์',
                'contents' => array(
                'type' => 'carousel',
                'contents' => array(
        array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews14ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews11,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews12ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews13
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews24ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews21,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews22ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews23
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews34ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews31,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews32ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews33
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews44ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews41,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews42ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews43
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews54ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews51,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews52ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews53
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews64ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews61,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews62ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews63
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews74ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews71,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews72ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews73
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews84ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews81,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews82ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews83
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews94ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews91,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews92ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews93
                    )
                )
                )
            )
            ),
            array(
            'type' => 'bubble',
            'hero' => array(
                'type' => 'image',
                'size' => 'full',
                'aspectRatio' => '20:10',
                'aspectMode' => 'cover',
                'url' => $resultnews04ok
            ),
            'body' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'text',
                    'text' => $resultnews01,
                    'wrap' => true,
                    'weight' => 'bold',
                    'size' => 'sm'
                ),
                array(
                    'type' => 'box',
                    'layout' => 'baseline',
                    'contents' => array(
                    array(
                        'type' => 'text',
                        'text' => $resultnews02ok,
                        'wrap' => true,
                        'weight' => 'regular',
                        'size' => 'xs',
                        'flex' => 0
                    )
                    )
                )
                )
            ),
            'footer' => array(
                'type' => 'box',
                'layout' => 'vertical',
                'spacing' => 'sm',
                'contents' => array(
                array(
                    'type' => 'button',
                    'style' => 'primary',
                    'action' => array(
                    'type' => 'uri',
                    'label' => 'อ่านเพิ่มเติม',
                    'uri' => $resultnews03
                    )
                )
                )
            )
            )
        
                )
                )
            )
            )
            );
            //replyMsg($arrayHeader,$arrayPostData);
            $url = 'https://api.line.me/v2/bot/message/reply';
            
            $post = json_encode($mreply);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $channelAccessToken);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);

    }
    elseif($command == "นับ1-10"){
        for($i=1;$i<=10;$i++){
        $arrayPostData['replyToken'] = $replyToken;
        //$arrayPostData['to'] = $uid;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $i;
        replyMsg($arrayHeader,$arrayPostData);
        }
    }/*
    elseif($command == "เ"){
        //$sql = "SELECT * FROM line_type WHERE category_id = '1'";
                $arrayPostData['replyToken'] = $replyToken;
                //$arrayPostData['to'] = $uid;
                $arrayPostData['messages'][0]['type'] = "flex";
                $arrayPostData['messages'][0]['altText'] = "ราคาตลาด$command";
                $arrayPostData['messages'][0]['contents']['type'] = "bubble";
                
                $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "กรุณาเลือกชนิดการเพาะปลูก";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
                $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

                $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";

                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['action']['label'] = "ข้าว";
                $arrayPostData['messages'][0]['contents']['body']['contents'][0]['action']['text'] = "เตือนภัยข้าว";

                $arrayPostData['messages'][0]['contents']['body']['contents'][1]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][1]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][1]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][1]['action']['label'] = "ข้าวโพด";
                $arrayPostData['messages'][0]['contents']['body']['contents'][1]['action']['text'] = "เตือนภัยข้าวโพด";

                $arrayPostData['messages'][0]['contents']['body']['contents'][2]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][2]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][2]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][2]['action']['label'] = "ถั่วเหลือง";
                $arrayPostData['messages'][0]['contents']['body']['contents'][2]['action']['text'] = "เตือนภัยถั่วเหลือง";

                $arrayPostData['messages'][0]['contents']['body']['contents'][3]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][3]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][3]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][3]['action']['label'] = "ถั่วเขียว";
                $arrayPostData['messages'][0]['contents']['body']['contents'][3]['action']['text'] = "เตือนภัยถั่วเขียว";

                $arrayPostData['messages'][0]['contents']['body']['contents'][4]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][4]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][4]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][4]['action']['label'] = "ลำไย";
                $arrayPostData['messages'][0]['contents']['body']['contents'][4]['action']['text'] = "เตือนภัยลำไย";

                $arrayPostData['messages'][0]['contents']['body']['contents'][5]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][5]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][5]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][5]['action']['label'] = "คะน้า";
                $arrayPostData['messages'][0]['contents']['body']['contents'][5]['action']['text'] = "เตือนภัยคะน้า";

                $arrayPostData['messages'][0]['contents']['body']['contents'][6]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][6]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][6]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][6]['action']['label'] = "ตะไคร้หอม";
                $arrayPostData['messages'][0]['contents']['body']['contents'][6]['action']['text'] = "เตือนภัยตะไคร้หอม";

                $arrayPostData['messages'][0]['contents']['body']['contents'][7]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][7]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][7]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][7]['action']['label'] = "เห็ดนางรม-นางฟ้า";
                $arrayPostData['messages'][0]['contents']['body']['contents'][7]['action']['text'] = "เตือนภัยเห็ดนางรม-นางฟ้า";

                $arrayPostData['messages'][0]['contents']['body']['contents'][8]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][8]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][8]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][8]['action']['label'] = "กาแฟ";
                $arrayPostData['messages'][0]['contents']['body']['contents'][8]['action']['text'] = "เตือนภัยกาแฟ";

                $arrayPostData['messages'][0]['contents']['body']['contents'][9]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][9]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][9]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][9]['action']['label'] = "มันสำปะหลัง";
                $arrayPostData['messages'][0]['contents']['body']['contents'][9]['action']['text'] = "เตือนภัยมันสำปะหลัง";

                $arrayPostData['messages'][0]['contents']['body']['contents'][10]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][10]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][10]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][10]['action']['label'] = "กำหนดเอง";
                $arrayPostData['messages'][0]['contents']['body']['contents'][10]['action']['text'] = "เตือนภัยกำหนดเอง";

                $arrayPostData['messages'][0]['contents']['body']['contents'][11]['type'] = "button";
                $arrayPostData['messages'][0]['contents']['body']['contents'][11]['style'] = "secondary";
                $arrayPostData['messages'][0]['contents']['body']['contents'][11]['action']['type'] = "message";
                $arrayPostData['messages'][0]['contents']['body']['contents'][11]['action']['label'] = "มะเขือเทศ";
                $arrayPostData['messages'][0]['contents']['body']['contents'][11]['action']['text'] = "เตือนภัยมะเขือเทศ";

                $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
                $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
                $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
                $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
                replyMsg($arrayHeader,$arrayPostData);
            // Free result set
            //pg_free_result($result);
    }*/
    ////////////////
    /*elseif ($command== 'qr' || $command== 'Qr' || $command== 'QR' || $command== 'Qrcode' || $command== 'QRcode' || $command== 'qrcode') { 
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
    ///////////////
    elseif ($post_data == 'happy') { 

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
if (isset($mreply)) {
    $result = json_encode($mreply);
    $client->replyMessage($mreply);
}
    file_put_contents('log.txt',file_get_contents('php://input'));
  pg_close($dbconn);
?>