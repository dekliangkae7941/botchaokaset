<?php
    /*$Setup_Server = '127.0.0.1';
    $Setup_User = 'root';
    $Setup_Pwd = '79417941';
    $Setup_Database = 'chatbot';
    mysql_connect($Setup_Server,$Setup_User,$Setup_Pwd);
    mysql_query("chatbot $Setup_Database");
    mysql_query("SET NAMES UTF8");*/

    $hostname="127.0.0.1";
	$username="root";
	$password="0850212315";
	$dbname="chatbot";
	$usertable="person";
	$yourfield = "userId";
	
	mysql_connect($hostname,$username, $password) หรือเสียหาย ("html>script language='JavaScript'>alert('ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้! โปรดลองอีกครั้งในภายหลัง'),history.go(-1)/script>/html>");
	mysql_select_db($dbname);
	
	# ตรวจสอบว่ามีเรคคอร์ดอยู่หรือไม่
	
	$query = "SELECT * FROM $usertable";
	
	$result = mysql_query($query);
	
	if($result){
		while($row = mysql_fetch_array($result)){
			$name = $row["$yourfield"];
			echo "ชื่อ: ".$name."br/>";
		}
	}

?>
