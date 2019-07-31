<?php
$dbconn = pg_connect("host=ec2-107-22-211-248.compute-1.amazonaws.com dbname=dant72mtqngrqg user=zzeiglpdbgcsup password=357b5ef3838e36150679d259aeb37a2c9d2ec1dafb8ae5c90e7669d040874a9e");
  if (!$dbconn){
  echo "<center><h1>Doesn't work =(</h1></center>";
  }else
   echo "<center><h1>Good connection</h1></center>";
   $query = "INSERT INTO book VALUES ('$_POST[bookid]','$_POST[book_name]',
   '$_POST[price]')";
   $result = pg_query($query); 
?>