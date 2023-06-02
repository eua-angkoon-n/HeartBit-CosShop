<?php
include('../condb.php');
	$member_id  = $_POST["member_id"];
	$m_pass0 = $_POST["m_pass0"];
	$m_pass1  = $_POST["m_pass1"];
	$m_pass2  = $_POST["m_pass2"];

	$old_pass = md5($m_pass0);

	$sql_check = "SELECT * FROM tbl_member WHERE member_id = '$member_id'" ;
	$result_check = mysqli_query($con, $sql_check);
	$row = mysqli_fetch_array($result_check);
	

	if($old_pass != $row['m_pass']){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

			echo '<script>
			setTimeout(function() {
			 swal({
				 title: "Passwordไม่ถูกต้อง",
				 text: "กรุณาใส่รหัสผ่านเก่าให้ถูกต้อง",
				 type: "error"
			 }, function() {
				 window.location = "member_profile.php";
			 });
		 }, 1000);
	 </script>';
	}else if($m_pass1 != $m_pass2){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

			echo '<script>
			setTimeout(function() {
			 swal({
				 title: "Password ไม่ตรงกัน",
				 text: "กรุณาใส่รหัสผ่านใหม่อีกครั้ง ",
				 type: "error"
			 }, function() {
				 window.location = "member_profile.php";
			 });
		 }, 1000);
	 </script>';
	}else{
		$m_pass = md5($m_pass1);
	
		$sql = "UPDATE tbl_member SET 
		m_pass ='$m_pass'
		WHERE member_id=$member_id
		 ";
		$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

		echo '<script>
			setTimeout(function() {
 			swal({
     		title: "เปลี่ยนรหัสผ่านสำเร็จ",
     		text: "",
     		type: "success"
 			}, function() {
     			window.location = "member_profile.php";
 			});
			}, 1000);
			</script>';
	}
		mysqli_close($con);

	
?>