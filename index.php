
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



#-------------------------[Func]-------------------------#
function pushMsg($arrayHeader,$arrayPostData){
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
}
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
#-------------------------[Events]-------------------------#

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
//รับข้อความจากผู้ใช้
//$messages = $arrayJson['events'][0]['message']['text'];
//รับ id ของผู้ใช้
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
    $query = "INSERT INTO line_log VALUES ('$userId','$displayName')";
    $result = pg_query($query);
	    //$text = "เมื่อผู้ใช้กดติดตามบอท";
    $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => 'สวัสดีจ้าคุณ '.$displayName.' userId ของคุณคือ '.$userId
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
}
///////////////////
elseif ($msg_type == 'location') {

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
                'type' => 'location',
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

}
/////////////
else { 
    if ($command== 'myid') { 
        
    }
    //////////
    elseif ($command == 'ข้าว') {
        //$category = 5;
        $query = "SELECT * FROM line_type WHERE category_id = '5'";
        //$query = "SELECT rating, numofratings FROM menu where name = 'Pasta'";
        $result = pg_query($dbconn,$query);
        /*if (!$result) {
            echo "An error occurred.\n";
            exit;
        }*/
        $arrayPostData['to'] = $uid;
        $arrayPostData['messages'][0]['type'] = "flex";
        $arrayPostData['messages'][0]['altText'] = "text";
        $arrayPostData['messages'][0]['contents']['type'] = "bubble";
        
        $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
        $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
        $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
        $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "Testtt";
        $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
        $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";

        $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
        $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
        $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
        $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
        $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "Test";
        $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;
        
        $datacount = 0;
        
        while($row = pg_fetch_array($result)){
        //while($eventrow = pg_fetch_assoc($result)){
        //while($eventrow = $result->pg_fetch_assoc()){
            $datacount = $datacount + 1;
            $type_id = $row['type_id'];
            $type_name = $row['type_name'];

            $arrayPostData['messages'][0]['contents']['body']['contents'][$datacount]['type'] = "button";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$datacount]['style'] = "secondary";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$datacount]['action']['type'] = "message";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$datacount]['action']['label'] = "$datacount) $type_name";
            $arrayPostData['messages'][0]['contents']['body']['contents'][$datacount]['action']['text'] = "event,$type_id";
        }
        //pg_free_result($result);
        $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
        $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
        $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
        $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "Rwar";
        $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
        $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
        $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = true;
        replyMsg($arrayHeader,$arrayPostData);


    }
    /////////////////////////

    #ตัวอย่าง Message Type "Text + Sticker"
    elseif($command == "สวัสดี"){
        $arrayPostData['to'] = $uid;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้า";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "34";
        pushMsg($arrayHeader,$arrayPostData);
    }
    elseif($command == "นับ1-10"){
        for($i=1;$i<=10;$i++){
        $arrayPostData['to'] = $uid;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $i;
        pushMsg($arrayHeader,$arrayPostData);
        }
    }
    elseif($command == "นับ"){
        $sql = "SELECT * FROM line_type WHERE category_id = '1'";
        $datacount = 0;
        //while($eventrow = $result->pg_fetch_assoc()){
        $result = pg_query($dbconn, $sql);
            while($row = pg_fetch_array($result)){
                $datacount = $datacount + 1;
                $type_id = $row['type_id'];
                $type_name = $row['type_name'];
                
                $arrayPostData['to'] = $uid;
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "$datacount) $type_id $type_name";
                pushMsg($arrayHeader,$arrayPostData);
            }
            // Free result set
            //pg_free_result($result);
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
    ///////////////
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
    /////////////
    else {
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