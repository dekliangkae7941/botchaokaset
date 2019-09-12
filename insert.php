
<?php
   //$query = "INSERT INTO book VALUES ('$_POST[bookid]','$_POST[book_name]',
   //'$_POST[price]')";
   //$result = pg_query($query);
   include "connectdb.php";

   //$keyword = $_POST['keyword'];
   //$intent = $_POST['intent'];
   $querylog = "INSERT INTO admin_log VALUES ('$_POST[main_name]','$_POST[title]','$_POST[description]','$_POST[url_link]','$_POST[url_image]')";
   //$result = pg_query($querylog);

   if ($result = pg_query($querylog)) {
       echo "<center>บันทึกสำเร็จ</center>";
       //header('refresh: 2; url=');
       exit(0);
   } else {
       echo "<center>ไม่สามารถบันทึกได้</center>";
       //header('refresh: 2; url=');
       exit(0);
   }
   
      $query = "SELECT * FROM admin_log"; 
    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
    $result = pg_query($dbconn, $query); 
    //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
    
    echo "<table border='1' align='center' width='500'>";
    //หัวข้อตาราง
    echo "<tr align='center'><td>main name</td><td>title</td><td>description</td><td>url_link</td><td>url_image</td><td>แก้ไข</td><td>ลบ</td></tr>";
    while($row = pg_fetch_array($result)) { 
      echo "<tr>";
      echo "<td>" .$row["main_name"] .  "</td> "; 
      echo "<td>" .$row["title"] .  "</td> ";  
      echo "<td>" .$row["description"] .  "</td> ";
      echo "<td>" .$row["url_link"] .  "</td> ";
      echo "<td>" .$row["url_image"] .  "</td> ";
      //แก้ไขข้อมูล
      echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
      
      //ลบข้อมูล
      echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
      echo "</tr>";
    }
    echo "</table>";
    //5. close connection

?>