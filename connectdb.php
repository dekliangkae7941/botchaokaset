<?php
$Setup_Server = 'localhost';
$Setup_User = 'dekliangkae';
$Setup_Pwd = '0967358315';
$Setup_Database = 'chatbot_chaokaset';
mysql_connect($Setup_Server,$Setup_User,$Setup_Pwd);
mysql_query("use $Setup_Database");
mysql_query("SET NAMES UTF8");
?>
