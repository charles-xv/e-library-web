<?php
$host = "fdb1034.awardspace.net"; // AwardSpace host
$user = "4696643_horizon";
$pass = "lu#Jwq+w1?Q(B0__";
$db = "4696643_horizon";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
