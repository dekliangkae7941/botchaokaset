<?php
echo "555555";
#--------------------------------------------------------------------------------------------------------------------#
include "bot_header.php";
include "admin/connectdb.php";

$uriwww = "https://chaokaset.openservice.in.th/index.php/doaservices/notifysent";
            $response = Unirest\Request::get("$uriwww");
            $json = json_decode($response->raw_body, true);
            $i = 0;
            
              /////////////////////////////////
  
            $datacountrowtype = 0;
            $datacountrowtype1 = 0;
            $datacountrowtype2 = 0;
            for($i=0;$i<=4;$i++){
                //$datacountrowtype2 += 1;
                //$datacountrowtype3 += 1;
              $name = $json[$i]['name'];
              $growing = $json[$i]['growing'];
              $weather = $json[$i]['weather'];
              $problem = $json[$i]['problem'];
              $warning = $json[$i]['detail']['warning'];
              $solution = $json[$i]['detail']['solution'];
              $date_start = $json[$i]['detail']['date_start'];
              $date_end = $json[$i]['detail']['date_end'];
              
            }
              echo $name;
              echo $growing;
              echo $weather;
              echo $problem;
              echo $warning;
              echo $solution;
?>