<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['m_level']!='member'){
	Header("Location: index.php");
}

$order_id = mysqli_real_escape_string($con,$_POST["id"]);

$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$b_img2 = (isset($_POST['b_img2']) ? $_POST['b_img2'] : '');
	$upload=$_FILES['b_img2']['name'];
	if($upload !='') { 

		$path="../member/b_img/";
		$type = strrchr($_FILES['b_img2']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../member/b_img/".$newname;
		move_uploaded_file($_FILES['b_img2']['tmp_name'],$path_copy);  
	}

    $sql = "UPDATE tbl_order SET 
	order_img2='$newname',
    order_status = '1'
	WHERE order_id=$order_id
	 ";

$result = mysqli_query($con, $sql);
mysqli_close($con);

echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

echo '<script>
setTimeout(function() {
 swal({
     title: "บันทึกสำเร็จ",
     text: "บันทึกการชำระยอดคงเหลือสำเร็จโปรดรอการตรวจสอบ",
     type: "success"
 }, function() {
     window.location = "track.php";
 });
}, 1000);
</script>';
?>