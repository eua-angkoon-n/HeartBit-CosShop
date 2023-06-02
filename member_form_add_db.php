<?php
session_start();
echo '<meta charset="utf-8">';
include('condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

    $m_level = 'verify';
	$m_user = mysqli_real_escape_string($con,$_POST["m_user"]);
	$m_pass = mysqli_real_escape_string($con,$_POST["m_pass"]);
	$c_pass = mysqli_real_escape_string($con,$_POST["c_pass"]);
	$m_name = mysqli_real_escape_string($con,$_POST["m_name"]);
	$m_tel = mysqli_real_escape_string($con,$_POST["m_tel"]);
	$m_email = mysqli_real_escape_string($con,$_POST["m_email"]);
	$m_address = mysqli_real_escape_string($con,$_POST["m_address"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
	$upload=$_FILES['m_img']['name'];
	if($upload !='') { 
		$path="m_img/";
		$type = strrchr($_FILES['m_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="m_img/".$newname;
		move_uploaded_file($_FILES['m_img']['tmp_name'],$path_copy);  
	}

	if($m_pass != $c_pass){
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
			 window.location = "index.php?act=add";
		 });
	 }, 1000);
 	</script>';
	}

	$sql_check = "SELECT * FROM tbl_member WHERE m_user = '$m_user' OR m_email='$m_email' OR m_tel='$m_tel' ";
	$query_check = mysqli_query($con,$sql_check);
	$result_check = mysqli_fetch_assoc($query_check);

	if($result_check['m_user'] === $m_user){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

		echo '<script>
		setTimeout(function() {
		 swal({
			 title: "เกิดข้อผิดพลาด",
			 text: "Username นี้ถูกใช้งานแล้ว",
			 type: "error"
		 }, function() {
			 window.location = "index.php?act=add";
		 });
	 }, 1000);
 </script>';
	}elseif($result_check['m_email'] === $m_email){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

		echo '<script>
		setTimeout(function() {
		 swal({
			 title: "เกิดข้อผิดพลาด",
			 text: "Email นี้ถูกใช้งานแล้ว",
			 type: "error"
		 }, function() {
			 window.location = "index.php?act=add";
		 });
	 }, 1000);
 </script>';
	}elseif($result_check['m_tel'] === $m_tel){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

		echo '<script>
		setTimeout(function() {
		 swal({
			 title: "เกิดข้อผิดพลาด",
			 text: "เบอร์โทรศัพท์ นี้ถูกใช้งานแล้ว",
			 type: "error"
		 }, function() {
			 window.location = "index.php?act=add";
		 });
	 }, 1000);
 </script>';
	}else{
		$password = md5($m_pass);

		$link = "https://heartbit-cs.in.th/index.php?act=verify&u=".$m_user."&p=".$password."&e=".$m_email;

		$web_email = "heartbit@heartbit-cs.in.th";

		$to = $m_email;

		$subject = "HeartBit CosShop ยืนยันการสมัครสมาชิก";
		$message = "<h1>กดที่นี่เพื่อยืนยันการสมัครสมาชิก :</h1> <br> ".$link;

		$header = "From :" .$web_email."\r\n";
    	$header .= "MIME-Version: 1.0\r\n";
    	$header .= "Content-type: text/html\r\n";

		$retval = mail($to,$subject,$message,$header);

		$sql_insert_user = "INSERT INTO tbl_member (m_level, m_user, m_pass, m_name, m_img, m_tel,m_email,m_address) 
		VALUE('$m_level','$m_user','$password','$m_name','$newname','$m_tel','$m_email','$m_address')";
		
		if(mysqli_query($con,$sql_insert_user) && $retval){
			echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

			echo '<script>
			setTimeout(function() {
			 swal({
				 title: "สมัครสมาชิก",
				 text: "โปรดยืนยันการสมัครผ่านทางอีเมล์",
				 type: "success"
			 }, function() {
				 window.location = "index.php?act=reg";
			 });
		 }, 1000);
	 </script>';
		}
	}
	mysqli_close($con);
?>