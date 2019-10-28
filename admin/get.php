<?php
    include "connectdb.php";

  $table = "";
  $response = array(
    "status" => false,
    "$table" => $table,
    "data" => null
  );
  if(isset($_GET["table"])){
    $table = $_GET["table"];
    $response["table"] = $table;
    $querylog = "SELECT * FROM ".$table;
    if ($result = pg_query($querylog)) {
      $response["status"] = true;
      $response["data"] = array();
      while ($row = pg_fetch_row($result)) {
        array_push($response["data"], $row);
      }
    }
  }

  echo json_encode($response);
  exit(0);
?>