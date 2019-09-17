<?php
include "config.php";
$myObj->userId = $_POST['userId'];;
$myObj->latitud = $_POST['latitud'];
$myObj->longitude = $_POST['longitude'];
$myJSON = json_encode($myObj);
echo $myJSON;

?>