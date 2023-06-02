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

	$member_id = mysqli_real_escape_string($con,$_POST["member_id"]);
	$m_name = mysqli_real_escape_string($con,$_POST["m_name"]);
	$m_email = mysqli_real_escape_string($con,$_POST["m_email"]);
	$m_tel = mysqli_real_escape_string($con,$_POST["m_tel"]);
	$m_address = mysqli_real_escape_string($con,$_POST["m_address"]);		
	$m_img2 = mysqli_real_escape_string($con,$_POST["m_img2"]);


	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
	$upload=$_FILES['m_img']['name'];
	if($upload !='') { 

		$path="../m_img/";
		$type = strrchr($_FILES['m_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../m_img/".$newname;
		move_uploaded_file($_FILES['m_img']['tmp_name'],$path_copy);  
	}else{
		$newname=$m_img2;
	}

	$sql = "UPDATE tbl_member SET 
	m_name='$m_name',
	m_email='$m_email',
	m_tel='$m_tel',
	m_address='$m_address',
	m_img='$newname'
	WHERE member_id=$member_id
	 ";

	$result = mysqli_query($con, $sql);
	mysqli_close($con);
	
	echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

	echo '<script>
	setTimeout(function() {
 	swal({
     	title: "แก้ไขข้อมูลสำเร็จ",
     	text: "",
     	type: "success"
 	}, function() {
     	window.location = "member_profile.php";
 	});
	}, 1000);
	</script>';
?>