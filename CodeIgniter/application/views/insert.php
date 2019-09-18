<?php
    include "connectdb.php";
   //$query = "INSERT INTO book VALUES ('$_POST[bookid]','$_POST[book_name]',
   //'$_POST[price]')";
   //$result = pg_query($query);
   $querylog = "INSERT INTO admin_log VALUES ('$_POST[main_name]','$_POST[title]','$_POST[description]','$_POST[url_link]','$_POST[url_image]')";
   //$result = pg_query($querylog);
    if ($result = pg_query($querylog)) {
      echo "<center>บันทึกสำเร็จ</center>";
      header('refresh: 2; index.php');
      exit(0);
    } else {
        echo "<center>ไม่สามารถบันทึกได้</center>";
        header('refresh: 2; index.php');
        exit(0);
    }
    //5. close connection
?>