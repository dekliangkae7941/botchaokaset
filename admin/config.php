<?php
$servername = "localhostchatbot";
$username = "dekliangkae";
$password = "0967358315";
$dbconnect = "chatbot_chaokaset";
$conn = new mysqli($servername, $username, $password, $dbconnect);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$conn->set_charset("utf8");
echo "Connected successfully";

?>


