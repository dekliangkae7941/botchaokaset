<?php
//$LINEData = file_get_contents('php://input');
//$jsonData = json_decode($LINEData,true);
$channelAccessToken = 'Q7iFw3gqf6GdZddXqmtIq+ZKZTysCneP+EXORdA9Byn1+4KikApyDMAO6BO2gQuFP+yqUFRISOWRQS/lKk0qcwga9TsRBoA/TQEu8+UjPmdsH1ZR+KbNqOeFbJ8F6C5H1j9AW4LKRPVcDljMkjEdeQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '51bfdcadb784f36d0833dd7d6b2fb07c';
$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);
$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$channelAccessToken}";

$replyToken    = $jsonData["events"][0]["replyToken"];
$userID   	   = $jsonData["events"][0]["source"]["userId"];
//$text 		   = $jsonData["events"][0]["message"]["text"];
$timestamp 	   = $jsonData["events"][0]["timestamp"];
$post_data     = $jsonData["events"][0]['postback']['data'];

$messageid	   = $jsonData["events"][0]['message']['id'];
$msg_type      = $jsonData["events"][0]['message']['type'];
$msg_file      = $jsonData["events"][0]['message']['fileName'];
//$msg_message   = $jsonData["events"][0]['message']['text'];
$msg_title     = $jsonData["events"][0]['message']['title'];
$msg_address   = $jsonData["events"][0]['message']['address'];
$msg_latitude  = $jsonData["events"][0]['message']['latitude'];
$msg_longitude = $jsonData["events"][0]['message']['longitude'];

//$userId     = $client->parseEvents()[0]['source']['userId'];
//$groupId    = $client->parseEvents()[0]['source']['groupId'];
//$replyToken = $client->parseEvents()[0]['replyToken'];
//$timestamp  = $client->parseEvents()[0]['timestamp'];
$type       = $jsonData["events"][0]['type'];
$message    = $jsonData["events"][0]['message'];
// $profile    = $client->profil($userId);
// //$repro      = json_encode($profile);
// $en_profile = json_encode($profile, true);
// $de_profile = json_decode($en_profile, true);
// $displayName    = $de_profile['displayName'];
// $pictureUrl    = $de_profile['pictureUrl'];
// if(empty($pictureUrl)){
//     $pictureUrl = 'https://raw.githubusercontent.com/dekliangkae7941/botchaokaset/master/logo.png';
// };
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
////////connect_db//////////////
$servername = "masterdev.cf";
$username = "masterd1";
$password = "Benzjane1995_";
$dbname = "masterd1_line";
$mysql = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysql, "utf8");

if ($mysql->connect_error){
	$errorcode = $mysql->connect_error;
	print("MySQL(Connection)> ".$errorcode);
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
	function pushMsg($arrayHeader,$arrayPostData){
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
  	function sendMessage($replyJson, $sendInfo){
		$ch = curl_init($sendInfo["URL"]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
		$result = curl_exec($ch);
		curl_close($ch);
    return $result;
	}

	//$mysql->query("INSERT INTO `LOG`(`UserID`, `Text`, `Timestamp`) VALUES ('$userID','$text','$timestamp')");

	$getUser = $mysql->query("SELECT * FROM 'bot_tent' WHERE 'response_text'='$message'");
	$getuserNum = $getUser->num_rows;
	$replyText["type"] = "text";
	if ($getuserNum == "0"){
		$replyText["text"] = "สวัสดีคับบบบ";
	}else {
		while($row = $getUser->fetch_assoc()){
			$response_text = $row['response_text'];
			$response_id = $row['response_id'];
		}
	$replyText["text"] = "สวัสดีคุณ $response_text $response_id (#$userId)";
	}

	$lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
	$lineData['AccessToken'] = "Q7iFw3gqf6GdZddXqmtIq+ZKZTysCneP+EXORdA9Byn1+4KikApyDMAO6BO2gQuFP+yqUFRISOWRQS/lKk0qcwga9TsRBoA/TQEu8+UjPmdsH1ZR+KbNqOeFbJ8F6C5H1j9AW4LKRPVcDljMkjEdeQdB04t89/1O/w1cDnyilFU=";

	$replyJson["replyToken"] = $replyToken;
	$replyJson["messages"][0] = $replyText;

	$encodeJson = json_encode($replyJson);

	$results = sendMessage($encodeJson,$lineData);
	echo $results;
	http_response_code(200);