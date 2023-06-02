<?php
include('condb.php');

$m_id = $_POST['m_id'];
$m_username = $_POST['u'];
$m_password = $_POST['p'];


if(isset($_POST['set_password'])){

    $link = "https://heartbit-cs.in.th/index.php?act=setpass&m=".$m_id."&u=".$m_username."&p=".$m_password;

    $sql = "SELECT * FROM tbl_member WHERE member_id = '$m_id' AND m_user = '$m_username' AND m_pass = '$m_password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    if(isset($_POST['set_password']) && $row['m_pass'] != $m_password){
        echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    
        echo '<script>
        setTimeout(function() {
         swal({
             title: "เกิดข้อผิดพลาด",
             text: "คุณใช้ลิงก์เปลี่ยนรหัสผ่านซํ้าโปรดกรอกอีเมล์ในหน้าลืมรหัสผ่านใหม่",
             type: "error"
         }, function() {
             window.location = "index.php?act=reset";
         });
     }, 1000);
    </script>';
    }

    if(mysqli_num_rows($result)){
        $new_password = mysqli_real_escape_string($con,$_POST['pass']);
        $c_password = mysqli_real_escape_string($con,$_POST['c_pass']);
        $passwordenc = md5($new_password);

        if($new_password != $c_password){
            echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    
            echo '<script>
            setTimeout(function() {
             swal({
                 title: "เกิดข้อผิดพลาด",
                 text: "รหัสผ่านยืนยันไม่ตรงกัน",
                 type: "error"
             }, function() {
                 window.location = "'.$link.'";
             });
         }, 1000);
     </script>';
        }else{
            $sql2 = "UPDATE tbl_member SET m_pass = '$passwordenc' WHERE member_id = '$m_id'";
            $result2=mysqli_query($con,$sql2);
            if($result2){
                echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
        
                echo '<script>
                setTimeout(function() {
                 swal({
                     title: "ตั้งค่ารหัสผ่านใหม่",
                     text: "บันทึกข้อมูลสำเร็จ",
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
                     text: "รหัสผ่านยืนยันไม่ตรงกัน",
                     type: "error"
                 }, function() {
                     window.location = "'.$link.'";
                 });
             }, 1000);
         </script>';
            }
        }
    }
}

?>