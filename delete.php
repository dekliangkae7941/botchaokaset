<?php
include "connectdb.php";

$main_id = $_GET['main_id'];
// echo $id;
$sql = "DELETE FROM admin_log WHERE main_id=".$main_id;
if ($result = pg_query($sql)) {
    echo "<center>ลบสำเร็จ</center>";
    exit(0);
  } else {
      echo "<center>ไม่สามารถลบได้</center>";
      exit(0);
  }

?>