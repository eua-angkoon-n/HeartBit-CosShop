<?php
session_start();
echo '<meta charset="utf-8">';
include ('condb.php');

    $email = $_POST['email'];

    // echo $email;
    // echo 'kuay';    
    // exit();

    $sql = "SELECT * FROM tbl_member WHERE m_email = '$email'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    
    $m_id = $row['member_id'];
    $m_user = $row['m_user'];
    $m_password = $row['m_pass'];

    // echo $row['member_id'];
    // echo $row['m_user'];
    // echo $row['m_pass'];
    // exit();
    
    $link = "https://heartbit-cs.in.th/index.php?act=setpass&m=".$m_id."&u=".$m_user."&p=".$m_password;
    
    $web_email = "heartbit@heartbit-cs.in.th";
    
    $to = $email;
    
    $subject = "HeartBit CosShop ตั้งค่ารหัสผ่านใหม่";
    $message = "<h1>ลิงก์ตั้งค่ารหัสผ่านใหม่ :</h1> <br> ".$link;
    
    $header = "From :" .$web_email."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    
    $retval = mail($to,$subject,$message,$header);

    if($retval){
        echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
        setTimeout(function() {
         swal({
             title: "โปรดตรวจสอบอีเมล",
             text: "ส่ง Email สำเร็จ",
             type: "success"
         }, function() {
             window.location = "index.php?act=reg";
         });
     }, 1000);
    </script>';
    }else{
        echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        echo '<script>
        setTimeout(function() {
         swal({
             title: "โปรดตรวจสอบอีเมล",
             text: "ไม่สามารถส่ง Email ได้",
             type: "error"
         }, function() {
             window.location = "index.php?act=reset";
         });
     }, 1000);
    </script>';
    }



?>