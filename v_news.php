<?php
include "connectdb.php";
include "index.php";
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