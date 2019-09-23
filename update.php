<?php
    include "connectdb.php";
   //$query = "INSERT INTO book VALUES ('$_POST[bookid]','$_POST[book_name]',
   //'$_POST[price]')";
   //$result = pg_query($query);
   $main_id = $_GET['main_id'];
   $querylog = "UPDATE admin_log SET main_name = '$_POST[main_name]', title = '$_POST[title]', description = '$_POST[description]', 
   url_link = '$_POST[url_link]', url_image = '$_POST[url_image]' WHERE main_id = $main_id";
   //$result = pg_query($querylog);
    if ($result = pg_query($querylog)) {
      echo "<center>แก้ไขสำเร็จ</center>";
      header('refresh: 1; index.php');
      exit(0);
    } else {
        echo "<center>ไม่สามารถแก้ไขได้</center>";
        header('refresh: 1; index.php');
        exit(0);
    }
    //5. close connection
?>