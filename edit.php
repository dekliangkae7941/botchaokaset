<?php
    include "connectdb.php";
    $main_id = $_GET['main_id'];
    // $main_name = $_GET['main_name'];
    // $title = $_GET['title'];
    // $description = $_GET['description'];
    // $url_link = $_GET['url_link'];
    // $url_image = $_GET['url_image'];
    $query = "SELECT * FROM admin_log WHERE main_id = $main_id"; 
    $result = pg_query($dbconn, $query); 
    $row = pg_fetch_array($result);
    $main_name = $row['main_name'];
    $title = $row['title'];
    $description = $row['description'];
    $url_link = $row['url_link'];
    $url_image = $row['url_image'];
    

?>
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
<h2>แก้ไขข้อมูลข่าวสารและคลังความรู้</h2>
  <form action="update.php" method="post">
    <div class="form-group">
      <label for="main_name">Main Name</label>
      <input type="text" class="form-control" id="main_name"  name="main_name" value="<?php $main_name; ?>">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title"  name="title" value="<?php $title; ?>">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" id="description"  name="description" value="<?php $description; ?>">
    </div>
    <div class="form-group">
      <label for="url_link">Url Link</label>
      <input type="text" class="form-control" id="url_link"  name="url_link" value="<?php $url_link; ?>">
    </div>
    <div class="form-group">
      <label for="url_image">Url Image</label>
      <input type="text" class="form-control" id="url_image"  name="url_image" value="<?php $url_image; ?>">
    </div>
    <button type="submit" class="btn btn-default">บันทึการแก้ไข</button>
  </form>
  <br />
  <br />
