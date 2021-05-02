<?php

$hostname = "us-cdbr-east-03.cleardb.com";
$database  = "heroku_60778271f37c57f";
$username = "b76be395b2bf68";
$password  = "b695d003";
$conn = mysqli_connect($hostname, $username, $password, $database)
	or die(mysqli_connect_error());



return $conn;
