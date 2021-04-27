<?php
$hostname = "127.0.0.1";
$database  = "webapp_database";
$username = "root";
$password  = "";
$conn = mysqli_connect($hostname, $username, $password, $database)
	or die(mysqli_connect_error());

// print_r($conn);
// echo nl2br("\n\n");

return $conn;
