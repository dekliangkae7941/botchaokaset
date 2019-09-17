<?php
include "index.php";
if($command!=''){
$querylocation = "SELECT * FROM line_log WHERE userid = $_POST[userId]";
        $resultlocation= pg_query($dbconn, $querylocation);
        $rowlocation = pg_fetch_array($resultlocation);
        $userId = $rowlocation['userId'];
        $latitude = $rowlocation['latitude'];
        $longitude = $rowlocation['longitude'];
            $myObj->userId = $userId;
            $myObj->latitud = $latitude;
            $myObj->longitude = $longitude;
            $myJSON = json_encode($myObj);
            echo $myJSON;
}
?>