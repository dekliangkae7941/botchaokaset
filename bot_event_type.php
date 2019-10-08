<?php
// include "bot_header.php";
// include "admin/connectdb.php";
include "bot_header.php";
include "admin/connectdb.php";
include "index.php";
$$type = $_GET['type'];
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
                        'text' => 'ข้อมูลจาก Chaokaset Application',
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
if (isset($mreply)) {
    $result = json_encode($mreply);
    $client->replyMessage($mreply);
}
  file_put_contents('log.txt',file_get_contents('php://input'));
  pg_close($dbconn);
?>