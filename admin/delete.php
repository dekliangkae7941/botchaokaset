<?php
include "config.php";

$tent_id = $_GET['tent_id'];
// echo $id;
$sql = "DELETE FROM data_tent WHERE tent_id=".$tent_id;

if ($result = pg_query($sql)) {
    echo "<center>ลบสำเร็จ</center>";
    header('refresh: 2; index.php');
    exit(0);
} else {
    echo "<center>ไม่สามารถลบได้</center>";
    header('refresh: 2; index.php');
    exit(0);
}

?>