<?php
#--------------------------------------------------------------------------------------------------------------------#
// Attempt select query execution

$querylog = "SELECT * FROM line_log WHERE userid = 'Udac6e87952f7ba83e230875996a1107f'";
            $resultlog = pg_query($dbconn, $querylog);
            $rowlog = pg_fetch_array($resultlog);
            $plan_category = $rowlog['plan_category'];
            //$ddisplayName = $rowlog['displayName'];
            $address = $rowlog['address'];
            $latitude = $rowlog['latitude'];
            $longitude = $rowlog['longitude'];
            //$ppictureUrl = $rowlog['pictureUrl'];
            echo $plan_category."\n" ;
            //echo $displayName ."\n";
            echo $address ."\n";
            //echo $pictureUrl ."\n";
/////////////////////////  
          echo $latitude." : ".$longitude."\n";
  //////////////////////////////////
  echo "12345678";


  /////////////////////////////////////////
  $limit = 10;
  //$uri = "https://chaokaset.openservice.in.th/index.php/priceservices/getmarket";
  $data = array('latitude' => $latitude, 'longitude' => $longitude,'limit' => $limit );
  $header = array('Accept' => 'application/json');
  $response1 = Unirest\Request::post('https://chaokaset.openservice.in.th/index.php/priceservices/getmarket',$header,json_encode($data));
  $json = json_decode($response1->raw_body, true);
  //echo json_encode($json);
  // $resultlo = $json['data']['list'][0]['location_name'];
  // $resultpn = $json['data']['list'][0]['province_name'];
  // $resultclot = $json['data']['list'][0]['coord_latitude'];
  // $resultclon = $json['data']['list'][0]['coord_longitude'];
  // $resultcdis = $json['data']['list'][0]['coord_distance'];
  // $resultcdis = $json['data']['list'][0]['coord_distance'];
  // echo $latitude." : ".$longitude;
  // echo $resultlo." : ".$resultpn;
  // echo $resultclot." : ".$resultclon;
  echo "12345678";
  echo $json["status"];
//echo "$latitude //$latitude ///$resultlo //$resultpn// $resultclot //$resultclon// $resultcdis";


$sql = "SELECT * FROM line_type WHERE category_id = '1'";
if($result = pg_query($dbconn, $sql)){
    if(pg_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>first_name</th>";
            echo "</tr>";
        while($row = pg_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['type_id'] . "</td>";
                echo "<td>" . $row['type_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        pg_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . pg_result_error($link);
}
?>
// Close connection