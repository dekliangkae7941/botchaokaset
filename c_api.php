<?php
include "connectdb.php";
        $querylocation = "SELECT * FROM line_log WHERE userid = 'Udac6e87952f7ba83e230875996a1107f'";
        $resultlocation= pg_query($dbconn, $querylocation);
        $rowlocation = pg_fetch_array($resultlocation);
        $userId = $rowlocation['userid'];
        $displayName = $rowlocation['displayname'];
        $latitude = $rowlocation['latitude'];
        $longitude = $rowlocation['longitude'];
        $address = $rowlocation['address'];
            $myObj->userId = $userId;
            $myObj->displayName = $displayName;
            $myObj->latitud = $latitude;
            $myObj->longitude = $longitude;
            $myObj->address = $address;
            $myJSON = json_encode($myObj);
            echo $myJSON;

?>