<?php
include "connectdb.php";

$response_id = $_GET['response_id'];
public function follow($response_id){
  if($response_id == 1){
    echo '5678';
  }
}

public function unfollow($response_id){
    if($response_id == 9){
        echo '5678';
    }
}
public function user_profile($response_id){
    if($response_id == 6){
        
        $query = "SELECT * FROM bot_log WHERE user_id = '1'";
        $result = $mysql->query($query);
        $row = mysqli_fetch_assoc($result);
          $plant_category = $row['user_plant_category'];
          $address = $row['user_address'];
          echo $plant_category;
          echo $address;
        
       
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
  }
  include "bot_header.php";

?>