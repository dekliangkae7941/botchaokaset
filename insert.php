<?php
$dbconn = pg_connect("host=ec2-107-22-211-248.compute-1.amazonaws.com dbname=dant72mtqngrqg user=zzeiglpdbgcsup password=357b5ef3838e36150679d259aeb37a2c9d2ec1dafb8ae5c90e7669d040874a9e");
  if (!$dbconn){
  echo "<center><h1>Doesn't work =(</h1></center>";
  }else
   echo "<center><h1>Good connection</h1></center>";
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

    $query = "SELECT * FROM admin_log"; 
    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
    $resultt = pg_query($dbconn, $query); 
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