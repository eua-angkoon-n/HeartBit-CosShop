<?php

session_start();
include("../condb.php");
// print_r($_SESSSION);

// echo "<br>";
$member_id = $_SESSION['member_id'];
$m_name = $_SESSION['m_name'];
$m_level = $_SESSION['m_level'];
$m_img = $_SESSION['m_img'];

if ($m_level != 'member') {
    header("Location: ../logout.php");
}

$sql = "SELECT * FROM tbl_member WHERE member_id = $member_id";
$result = mysqli_query($con, $sql) or die("Error in query: $sql" . mysqli_error());
$row = mysqli_fetch_array($result);

$m_name = $row['m_name'];
$m_img = $row['m_img'];

// echo $sql;
// exit();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Heartbit CosShop</title>
    <link rel="icon"
    href="https://scontent.fkdt2-1.fna.fbcdn.net/v/t39.30808-6/305225771_455736483238619_3884675877641912098_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=oDFn8A0fICwAX-HE9L8&_nc_ht=scontent.fkdt2-1.fna&oh=00_AfBsAvM7wDyxLMOtqvptr4YWrMDgICcLDnpnhIOLWRzJ8g&oe=63D11D2A"
    type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

