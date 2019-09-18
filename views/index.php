<!DOCTYPE html>
<html lang="en">
<head>
  <title>หน้าสำหรับเพิ่มข้อมูล</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>เพิ่มข้อมูลข่าวสารและคลังความรู้</h2>
  <form action="insert.php" method="post">
    <div class="form-group">
      <label for="main_name">Main Name</label>
      <input type="text" class="form-control" id="main_name"  name="main_name">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title"  name="title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" id="description"  name="description">
    </div>
    <div class="form-group">
      <label for="url_link">Url Link</label>
      <input type="text" class="form-control" id="url_link"  name="url_link">
    </div>
    <div class="form-group">
      <label for="url_image">Url Image</label>
      <input type="text" class="form-control" id="url_image"  name="url_image">
    </div>
    <button type="submit" class="btn btn-default">บันทึก</button>
  </form>
  <br />
  <br />
  
  <p>ตารางแสดงข้อมูล</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="1" style="text-align:center">mainname</th>
        <th colspan="1" style="text-align:center">title</th>
        <th colspan="3" style="text-align:center">description</th>
        <th colspan="1" style="text-align:center">urllink</th>
        <th colspan="1" style="text-align:center">urlimage</th>
        <th colspan="2" style="text-align:center">ดำเนินงาน</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "connectdb.php";
    $query = "SELECT * FROM admin_log"; 
    $result = pg_query($dbconn, $query); 
      while($row = pg_fetch_array($result)){
        echo "<tr>  
                    <td colspan=\"1\">".$row['main_name']."</td>
                    <td colspan=\"1\">".$row['title']."</td>
                    <td colspan=\"3\">".$row['description']."</td>
                    <td colspan=\"1\">".$row['url_link']."</td>
                    <td colspan=\"1\">".$row['url_image']."</td>
                    <td colspan=\"1\" ><a href=\"edit.php?main_id=".$row['main_id']."\"><button type=\"button\" class=\"btn btn-warning\">แก้ไขข้อมูล</button></a></td>
                    <td colspan=\"1\"><a href=\"delete.php?main_id=".$row['main_id']."\"><button type=\"button\" class=\"btn btn-danger\">ลบข้อมูล</button></a></td>
                    </tr>";
      }
    ?>
      
     
    </tbody>
  </table>
</div>
<!--

<h2>input knowledge</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Main : </li><li><input type="text" name="main_name" /></li>
<li>Title : </li><li><input type="text" name="title" /></li>
<li>Description : </li><li><input type="text" name="description" /></li>
<li>url_link : </li><li><input type="text" name="url_link" /></li>
<li>url_image : </li><li><input type="text" name="url_image" /></li>
<li><input type="submit" /></li>
</form>
-->
<!--<h2>Enter data into book table</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li>Book Name:</li><li><input type="text" name="book_name" /></li>
<li>Price (USD):</li><li><input type="text" name="price" /></li>
<li><input type="submit" /></li>
</form>
</ul>-->
<div style="width:700px; margin:0 auto;">

<h3>Demo Create and Consume Simple REST API in PHP</h3>   
<form action="" method="POST">
<label>Enter Order ID:</label><br />
<input type="text" name="order_id" placeholder="Enter Order ID" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>    
<br>

</ul>
</body>
</html>
<?php

#--------------------------------------------------------------------------------------------------------------------#
// Attempt select query execution
/*
$querylog = "SELECT * FROM line_log WHERE userid = 'Udac6e87952f7ba83e230875996a1107f'";
            $resultlog = pg_query($dbconn, $querylog);
            $rowlog = pg_fetch_array($resultlog);
            $plan_category = $rowlog['plan_category'];
            //$ddisplayName = $rowlog['displayName'];
            $address = $rowlog['address'];
            //$ppictureUrl = $rowlog['pictureUrl'];
            echo $plan_category."\n" ;
            //echo $displayName ."\n";
            echo $address ."\n";
            //echo $pictureUrl ."\n";
/////////////////////////
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
*/
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
$channelAccessToken = 'YhqOTnlfJE6/yjWpkPRNR03ryOXTb7R8QaOVBkVL1Q5zAEhV8xJaMKBgGoLRZcVfA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vyxnO+4kUs2EpOJtHjNpnb9ED5kGu9OFa3G17TukVvILQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '83255aed1b77104d01142b5542945438';


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
$uid        = $arrayJson['events'][0]['source']['userId'];
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
$pictureUrl    = $de_profile['pictureUrl'];
if(empty($pictureUrl)){
    $pictureUrl = 'https://raw.githubusercontent.com/dekliangkae7941/botchaokaset/master/logo.png';
};
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
    $msg_title = 'ตำแหน่งที่อยู่ของคุณ คือ ';
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
elseif ($type == 'follow' || $command == "แก้ไขแปลงเพาะปลูก") {
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
                    $urisubtype = "https://chaokaset.openservice.in.th/index.php/Location/scan";
                    $response = Unirest\Request::get("$urisubtype");
                    $json = json_decode($response->raw_body, true);
                    $resultasn = $json[1]['subtype_name'];
                    $resultasid = $json[1]['subtype_id'];
                    $resultatid = $json[1]['type_id'];
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
                      
                      $uurl_image = $row['url_image'];
											$datacountrowtype = 0;
											$url = $row['url_link'];
											$array = get_headers($url);
											$string = $array[0];
											if(strpos($string,"200")){
													$uurl_link = $row['url_link'];
											}else{
												$uurl_link = 'https://scontent.cdninstagram.com/vp/b3249111d14ee7ead8f672680a255ffc/5DD3CD05/t51.2885-15/e35/s480x480/66881617_365323837467302_8265523363007935424_n.jpg?_nc_ht=scontent-lax3-1.cdninstagram.com';
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
