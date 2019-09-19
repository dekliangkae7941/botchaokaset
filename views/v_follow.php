<?php
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
        ?>