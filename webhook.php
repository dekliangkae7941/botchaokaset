<?php
#-------------------------[Include]-------------------------#
require_once('./include/line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
#-------------------------[Token]-------------------------#
$channelAccessToken = 'pZmLfAv73zYnio19mFJo2hudRTgr7y8FbMdAayR7VXep+rZyVt1NAAEL+ZcsjfbrA7VhuzmpTUfkkYIIkgjdfohQ5bf8XV781/5J/gIy5vzhQPrIgSXQ3Uj23DnEpFiCa+MC60K2WexRcqsdgTDQ6gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'ddfedb5ad9fad19c7c0bbe791cd28166';
#-------------------------[Events]-------------------------#
include('conectdb.php');
date_default_timezone_set("Asia/Bangkok");
$datef = date('Y-m-d');
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$queryText = $request["queryResult"]["queryText"];
$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];
$query = "INSERT INTO line_log(user_id,text,date_time) VALUE ('$userId','$queryText',NOW())";
$resource = mysql_query($query) or die ("error".mysql_error());
                          
                          
                          
                      
?>
