<?php
include "config.php";

$sql = "INSERT INTO data_intent VALUES ('$_POST[keyword]','$_POST[intent]')";
if ($result = pg_query($sql)) {
    echo "<center>บันทึกสำเร็จ</center>";
    header('refresh: 2; index.php');
    exit(0);
} else {
    echo "<center>ไม่สามารถบันทึกได้</center>";
    header('refresh: 2; index.php');
    exit(0);
}

?>