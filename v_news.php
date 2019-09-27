<?php
include "connectdb.php";
include "index.php";
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
?>