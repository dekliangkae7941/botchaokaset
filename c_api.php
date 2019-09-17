<?php
include "config.php";
$querylocation = "SELECT * FROM line_log WHERE userid = '$userId'";
        $resultlocation= pg_query($dbconn, $querylocation);
        $rowlocation = pg_fetch_array($resultlocation);
        $userId = $rowlocation['userId'];
        $latitude = $rowlocation['latitude'];
        $longitude = $rowlocation['longitude'];
$myObj->userId = $_POST['userId'];;
$myObj->latitud = $_POST['latitud'];
$myObj->longitude = $_POST['longitude'];
$myJSON = json_encode($myObj);
echo $myJSON;

?>