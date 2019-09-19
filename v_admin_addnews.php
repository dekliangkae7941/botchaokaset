<!DOCTYPE html>
<html lang="en">
<head>
  <title>หน้าสำหรับเพิ่มข้อมูล</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>เพิ่มข้อมูลข่าวสารและคลังความรู้</h2>
  <form action="insert.php" method="post">
    <div class="form-group">
      <label for="main_name">Main Name</label>
      <input type="text" class="form-control" id="main_name"  name="main_name">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title"  name="title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" id="description"  name="description">
    </div>
    <div class="form-group">
      <label for="url_link">Url Link</label>
      <input type="text" class="form-control" id="url_link"  name="url_link">
    </div>
    <div class="form-group">
      <label for="url_image">Url Image</label>
      <input type="text" class="form-control" id="url_image"  name="url_image">
    </div>
    <button type="submit" class="btn btn-default">บันทึก</button>
  </form>
  <br />
  <br />
  
  <p>ตารางแสดงข้อมูล</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="1" style="text-align:center">mainname</th>
        <th colspan="1" style="text-align:center">title</th>
        <th colspan="3" style="text-align:center">description</th>
        <th colspan="1" style="text-align:center">urllink</th>
        <th colspan="1" style="text-align:center">urlimage</th>
        <th colspan="2" style="text-align:center">ดำเนินงาน</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "connectdb.php";
    $query = "SELECT * FROM admin_log"; 
    $result = pg_query($dbconn, $query); 
      while($row = pg_fetch_array($result)){
        echo "<tr>  
                    <td colspan=\"1\">".$row['main_name']."</td>
                    <td colspan=\"1\">".$row['title']."</td>
                    <td colspan=\"3\">".$row['description']."</td>
                    <td colspan=\"1\">".$row['url_link']."</td>
                    <td colspan=\"1\">".$row['url_image']."</td>
                    <td colspan=\"1\" ><a href=\"edit.php?main_id=".$row['main_id']."\"><button type=\"button\" class=\"btn btn-warning\">แก้ไขข้อมูล</button></a></td>
                    <td colspan=\"1\"><a href=\"delete.php?main_id=".$row['main_id']."\"><button type=\"button\" class=\"btn btn-danger\">ลบข้อมูล</button></a></td>
                    </tr>";
      }
    ?>
      
     
    </tbody>
  </table>
</div>
<!--

<h2>input knowledge</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Main : </li><li><input type="text" name="main_name" /></li>
<li>Title : </li><li><input type="text" name="title" /></li>
<li>Description : </li><li><input type="text" name="description" /></li>
<li>url_link : </li><li><input type="text" name="url_link" /></li>
<li>url_image : </li><li><input type="text" name="url_image" /></li>
<li><input type="submit" /></li>
</form>
-->
<!--<h2>Enter data into book table</h2>
<ul>
<form name="insert" action="insert.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li>Book Name:</li><li><input type="text" name="book_name" /></li>
<li>Price (USD):</li><li><input type="text" name="price" /></li>
<li><input type="submit" /></li>
</form>
</ul>-->
<div style="width:700px; margin:0 auto;">

<h3>Demo Create and Consume Simple REST API in PHP</h3>   
<form action="" method="POST">
<label>Enter Order ID:</label><br />
<input type="text" name="order_id" placeholder="Enter Order ID" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>    
<br>

</ul>
</body>
</html>
<?php

