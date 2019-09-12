<?php
$userId=$_GET[userId];
if($userId == ''){
    exit();
}

$dbconn = pg_connect("host=ec2-107-22-211-248.compute-1.amazonaws.com dbname=dant72mtqngrqg user=zzeiglpdbgcsup password=357b5ef3838e36150679d259aeb37a2c9d2ec1dafb8ae5c90e7669d040874a9e");
if (!$dbconn){
echo "<center><h1>Doesn't work =(</h1></center>";
}else
 echo "<center><h1>Good connection</h1></center>";

//ดึงข้อมูล ID มาจาก Databases
    $querylog = "SELECT * FROM line_log ";
        $resultlog = pg_query($dbconn, $querylog);
        $rowlog = pg_fetch_array($resultlog);
        $latitude = $rowlog['latitude'];
        $longitude = $rowlog['longitude'];
        //echo json_encode($rowlog);


        // Create a curl handle
        // ตัวเลขไอดี เราใช้ตัวแปรมาแทน ได้น่ะครับ 
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,"https://botphp2019.herokuapp.com/connectdb.php?userid=Udac6e87952f7ba83e230875996a1107f");
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);
        // แปลงข้อมูลที่รับมาในรูป json มาเป็น array จะได้ใช้ง่าย ๆ
        $DATA= json_decode($result, true);
        // //dump ข้อมูลออกมาดู
        print_r($DATA);
        // ลองดึงออกทีล่ะค่า
        echo "<hr>";
        echo $DATA['userid']; echo "<br>";

//$objQuery = mysql_query(“SELECT * FROM TB_STD where ID_STD =’$ID’ “) or die(mysql_error());
//$objResult = mysql_fetch_array($objQuery);
//นำเอาตัวแปร มาแปลงเป็น json แล้วส่งออก
echo json_encode($rowlog);
?>
