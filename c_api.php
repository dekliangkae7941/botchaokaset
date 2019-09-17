<?php
include "connectdb.php";
$querylocation = "SELECT * FROM line_log WHERE userid = 'Udac6e87952f7ba83e230875996a1107f'";
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

?>