<?php
$serverName = 'localhost';
$usernameDB = 'root';
$passwordDB = 'root';
$database = 'fach_thrifting';
$port = 3306;

$conn = mysqli_connect($serverName, $usernameDB, $passwordDB, $database, $port);

// Check connection
if ($conn->connect_error) {
  die ("Connection failed: " . $conn->connect_error);
}

