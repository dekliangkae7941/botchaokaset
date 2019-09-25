<?php
     $post = $_POST;
     //$status_login = 0;
     $environment =$post['environment']; //สภาพแวดล้อม
     $plant_type =$post['plant_type']; //ชนิดพืช
     $growth_phase =$post['growth_phase']; //ระยะการเจริญเติบโต
     $problem =$post['problem']; //ปัญหา
     $possible_symptoms =$post['possible_symptoms']; //อาการที่อาจพบ
     $prevention =$post['prevention']; //แนวทางป้องกัน
    $data = array('environment' => "$environment", 'plant_type' => "$plant_type", 'growth_phase' => "$growth_phase",
                  'problem ' => "$problem ", 'possible_symptoms' => "$possible_symptoms", 'prevention' => "$prevention" );
        echo json_encode($data);
     //$respon =$mapi->insert_review();
     //echo $respon;
       
?>