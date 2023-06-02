<?php
include('condb.php');

$m_user = $_POST['u'];
$m_password = $_POST['p'];
$m_email = $_POST['e'];


    $link = "https://heartbit-cs.in.th/index.php?act=verify&u=".$m_user."&p=".$password."&e=".$m_email;




            $sql2 = "UPDATE tbl_member SET m_level = 'member' WHERE m_email = '$m_email'";
            $result2=mysqli_query($con,$sql2);
            if($result2){
                echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
        
                echo '<script>
                setTimeout(function() {
                 swal({
                     title: "ยืนยันสำหรับ",
                     text: "ขอบคุณสำหรับการสมัครสมาชิก",
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
                     title: "เกิดข้อผิดพลาด",
                     text: "ไม่สามารถยืนยันการสมัครสมาชิกได้",
                     type: "error"
                 }, function() {
                     window.location = "'.$link.'";
                 });
             }, 1000);
         </script>';
            }

?>

