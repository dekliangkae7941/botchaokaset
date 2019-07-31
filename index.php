<?php
  $LINEData = file_get_contents('php://input');
  $jsonData = json_decode($LINEData,true);
  $replyToken = $jsonData["events"][0]["replyToken"];
  $userID = $jsonData["events"][0]["source"]["userId"];
  $text = $jsonData["events"][0]["message"]["text"];
  $timestamp = $jsonData["events"][0]["timestamp"];
#--------------------------------------------------------------------------------------------------------------------#
  $dbconn = pg_connect("host=ec2-107-22-211-248.compute-1.amazonaws.com dbname=dant72mtqngrqg user=zzeiglpdbgcsup password=357b5ef3838e36150679d259aeb37a2c9d2ec1dafb8ae5c90e7669d040874a9e");
  if (!$dbconn){
  echo "<center><h1>Doesn't work =(</h1></center>";
  }else
   echo "<center><h1>Good connection</h1></center>";
  pg_close($dbconn);
#--------------------------------------------------------------------------------------------------------------------#
  function sendMessage($replyJson, $sendInfo){
          $ch = curl_init($sendInfo["URL"]);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLINFO_HEADER_OUT, true);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Content-Type: application/json',
              'Authorization: Bearer ' . $sendInfo["AccessToken"])
              );
          curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
          $result = curl_exec($ch);
          curl_close($ch);
    return $result;
  }
  $mysql->query("INSERT INTO 'LOG'('UserID', 'Text', 'Timestamp') VALUES ('$userID','$text','$timestamp')");
  $getUser = $mysql->query("SELECT * FROM 'Customer' WHERE 'UserID'='$userID'");
  $getuserNum = $getUser->num_rows;
  $replyText["type"] = "text";
  if ($getuserNum == "0"){
    $replyText["text"] = "vbvb";
  } else {
    while($row = $getUser->fetch_assoc()){
      $Name = $row['Name'];
      $Surname = $row['Surname'];
      $CustomerID = $row['CustomerID'];
    }
    $replyText["text"] = "สวัสดีคุณ $Name $Surname (#$CustomerID)";
  }
  $lineData['URL'] = "https://api.line.me/v2/bot/message/reply";
  $lineData['AccessToken'] = "pZmLfAv73zYnio19mFJo2hudRTgr7y8FbMdAayR7VXep+rZyVt1NAAEL+ZcsjfbrA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vzhQPrIgSXQ3Uj23DnEpFiCa+MC60K2WexRcqsdgTDQ6gdB04t89/1O/w1cDnyilFU=";
  $replyJson["replyToken"] = $replyToken;
  $replyJson["messages"][0] = $replyText;
  $encodeJson = json_encode($replyJson);
  $results = sendMessage($encodeJson,$lineData);
  echo $results;
  http_response_code(200);
#------------------------------------------------------------------------------------------------------------#

?>
