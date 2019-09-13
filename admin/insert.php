<?php
include "config.php";

$keyword = $_POST['keyword'];
$intent = $_POST['intent'];

$sql = "INSERT INTO data_intent (id,keyword, intent) VALUES ('','".$keyword."', '".$intent."')";
if ($result = pg_query($sql)) {
    echo "<center>บันทึกสำเร็จ</center>";
    header('refresh: 2; admin/index.php');
    exit(0);
} else {
    echo "<center>ไม่สามารถบันทึกได้</center>";
    header('refresh: 2; admin/index.php');
    exit(0);
}

?>