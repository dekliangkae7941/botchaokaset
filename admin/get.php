<?php
    include "connectdb.php";

  $table = "";
  $response = array(
    "status" => false,
    "sql" => "",
    "data" => null
  );
  if(isset($_GET["table"])){
    $table = $_GET["table"];
    $querylog = "SELECT * FROM ".$table;
    $response["sql"] = $querylog;
    if ($result = pg_query($querylog)) {
      $response["status"] = true;
      $response["data"] = array();
      while ($row = pg_fetch_assoc($result)) {
        array_push($response["data"], $row);
      }
    }
  }

  echo json_encode($response);
?>