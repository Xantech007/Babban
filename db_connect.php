<?php
$servername = "sql200.infinityfree.com";
$username = "if0_39551586";
$password = "j7UGC8q0hi64";
$dbname = "if0_39551586_babban";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
