<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
$con->query("set names utf8");
  date_default_timezone_set('Asia/Bangkok');
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>