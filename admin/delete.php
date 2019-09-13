<?php
include "config.php";

$id = $_GET['id'];
// echo $id;
$sql = "DELETE FROM data_tent WHERE id=".$id;

if ($result = pg_query($querylog)) {
    echo "<center>ลบสำเร็จ</center>";
    header('refresh: 2; admin/index.php');
    exit(0);
} else {
    echo "<center>ไม่สามารถลบได้</center>";
    header('refresh: 2; admin/index.php');
    exit(0);
}

?>