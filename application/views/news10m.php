<?php
$url = 'https://newsapi.org/v2/top-headlines?country=th&apiKey=dfb33833ca384effa6b7d26c0145ecab';
    function get_contents($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36");
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    $contents = get_contents($url);
    
    file_put_contents('news.json', $contents);
?>