<?php
$categoryid =1;
echo '55555555';

$jsontype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getTypeAll');
  $objtype = json_decode($jsontype);
  $i =0;
  //$rowtext = 1;
  for($i=0;$i<=Count($objtype);$i++){
    $category_id = $objtype[$i]->category_id;
    $type_id = $objtype[$i]->type_id;
    $type_name = $objtype[$i]->type_name;
  //$category_id = 1;
  //echo '55555555555';
  if($categoryid == $category_id){
    echo $type_id;
    echo $type_name;
  }
}


$typeid = 3;
    $jsonsubtype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getSubtype/'.$typeid);
    $objsubtype = json_decode($jsonsubtype);
    $ii =0;
    //$rowtext2 = 0;
    for($ii=0;$ii<=Count($objsubtype);$ii++){
      $type_id = $objsubtype[$ii]->type_id;
      $subtype_id = $objsubtype[$ii]->subtype_id;
      $subtype_name = $objsubtype[$ii]->subtype_name;
    //$category_id = 1;
    if($typeid == $type_id){
    echo $subtype_id;
    echo $subtype_name;
        $jsonsubtypeall = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getLastUpdate');
      $objsubtypeall = json_decode($jsonsubtypeall);

      for($j=0;$j<=Count($objsubtypeall);$j++){
          //$type_id = $objsubtypeall[$j]->type_id;
          $ssubtype_id = $objsubtypeall[$j]->subtype_id;
          $ssubtype_name = $objsubtypeall[$j]->subtype_name;
          $location_name = $objsubtypeall[$j]->location_name;
          $province_name = $objsubtypeall[$j]->province_name;
          $unit_name = $objsubtypeall[$j]->unit_name;
          $reference_name = $objsubtypeall[$j]->reference_name;
          $product_price = $objsubtypeall[$j]->product_price;
          $lastupdate = $objsubtypeall[$j]->lastupdate;
          $coord_longitude = $objsubtypeall[$j]->coord_longitude;
          $coord_latitude = $objsubtypeall[$j]->coord_latitude;
          if($subtype_id == $ssubtype_id){
           echo $location_name;
          }
        }

    }
    }

    // $jsonsubtype = file_get_contents('https://chaokaset.openservice.in.th/index.php/priceservices/getSubtype/'.$typeid);
    // $objsubtype = json_decode($jsonsubtype);
    // $i =0;
    // $rowtext = 1;
    // for($i=0;$i<=Count($objsubtype);$i++){
    //   $type_id = $objsubtype[$i]->type_id;
    //   $subtype_id = $objsubtype[$i]->subtype_id;
    //   $subtype_name = $objsubtype[$i]->subtype_name;
    // //$category_id = 1;
    // if($typeid == $type_id){
    //   $arrayPostData['replyToken'] = $replyToken;
    //   //$arrayPostData['to'][0] = $uid;
    //   //$arrayPostData['to'][0] = $user_id;
    //         $arrayPostData['messages'][0]['type'] = "flex";
    //         $arrayPostData['messages'][0]['altText'] = "broadcast";
    //         $arrayPostData['messages'][0]['contents']['type'] = "bubble";
            
    //         $arrayPostData['messages'][0]['contents']['header']['type'] = "box";
    //         $arrayPostData['messages'][0]['contents']['header']['layout'] = "vertical";
    //         $arrayPostData['messages'][0]['contents']['header']['contents'][0]['type'] = "text";
    //         $arrayPostData['messages'][0]['contents']['header']['contents'][0]['text'] = "$command";
    //         //$arrayPostData['messages'][0]['contents']['header']['contents'][0]['color'] = "#ffffff";
    //         $arrayPostData['messages'][0]['contents']['header']['contents'][0]['size'] = "lg";
    //         $arrayPostData['messages'][0]['contents']['header']['contents'][0]['weight'] = "bold";
  
    //         $arrayPostData['messages'][0]['contents']['body']['type'] = "box";
    //         $arrayPostData['messages'][0]['contents']['body']['layout'] = "vertical";
    //         $arrayPostData['messages'][0]['contents']['body']['spacing'] = "md";
    //         $arrayPostData['messages'][0]['contents']['body']['contents'][0]['type'] = "text";
    //         $arrayPostData['messages'][0]['contents']['body']['contents'][0]['text'] = "กรุณาเลือกประเภทของ$command";
    //         $arrayPostData['messages'][0]['contents']['body']['contents'][0]['size'] = "md";
    //         //$arrayPostData['messages'][0]['contents']['body']['contents'][0]['weight'] = "bold";
    //         $arrayPostData['messages'][0]['contents']['body']['contents'][0]['wrap'] = true;
  
    //           $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['type'] = "button";
    //           $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['style'] = "secondary";
    //           $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['type'] = "message";
    //           $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['label'] = "$subtype_name";
    //           $arrayPostData['messages'][0]['contents']['body']['contents'][$rowtext]['action']['text'] = "ราคา$subtype_name";
    //           $rowtext += 1; 
            
    //         $arrayPostData['messages'][0]['contents']['footer']['type'] = "box";
    //         $arrayPostData['messages'][0]['contents']['footer']['layout'] = "vertical";
    //         $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['type'] = "text";
    //         $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['text'] = "ข้อมูลจาก Chaokaset Mobile";
    //         $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['size'] = "xs";
    //         $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['wrap'] = true;
    //         $arrayPostData['messages'][0]['contents']['footer']['contents'][0]['align'] = "center";
    //         $arrayPostData['messages'][0]['contents']['styles']['header']['backgroundColor'] = "#f4ee42";
    //       }
    //     }
    //   replyMsg($arrayHeader,$arrayPostData);

?>