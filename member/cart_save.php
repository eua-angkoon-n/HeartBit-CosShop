<?php
session_start();
echo '<meta charset="utf-8">';
include("../condb.php");
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
// echo $_SESSION["strProductID"][$i]; 
// // echo $_SESSION["order_price_first"]; 

  $member_id = mysqli_real_escape_string($con,$_POST['member_id']);
  $order_name = mysqli_real_escape_string($con,$_POST['order_name']);
  $order_address = mysqli_real_escape_string($con,$_POST['order_address']);
  $order_tel = mysqli_real_escape_string($con,$_POST['order_tel']);
  $order_email = mysqli_real_escape_string($con,$_POST['order_email']);

  $date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$b_img = (isset($_POST['b_img']) ? $_POST['b_img'] : '');
	$upload=$_FILES['b_img']['name'];
	if($upload !='') { 
		$path="../member/b_img/";
		$type = strrchr($_FILES['b_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../b_img/".$newname;
		move_uploaded_file($_FILES['b_img']['tmp_name'],$path_copy); 
	}
// echo $_POST['b_img'];
// echo $new_image_name;
// exit();

  $sql = "INSERT INTO tbl_order 
  (member_id,
  order_name,
  order_email,
  order_tel,
  order_address,
  order_img1,
  order_img2,
  order_price_total,
  order_price_first,
  order_price_second,
  order_status)
	VALUES
	('$member_id',
    '$order_name',
    '$order_email',
    '$order_tel',
    '$order_address',
    '$newname',
    '0',
    '".$_SESSION["order_price_total"]."',
    '".$_SESSION["order_price_first"]."',
    '".$_SESSION["order_price_second"]."',
    '1') 
  ";


  mysqli_query($con,$sql);

  $order_id = mysqli_insert_id($con);
// echo $_SESSION["intLine"];
// exit();
  
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++){
	  if(($_SESSION["strProductID"][$i]) != "" ){
      $sql1 = "SELECT * FROM tbl_product WHERE p_id = '".$_SESSION["strProductID"][$i]."'";
      $result1 = mysqli_query($con,$sql1);
      $row1 = mysqli_fetch_array($result1);

      $price = $row1['p_price_total'];
      $price_f = $row1['p_deposit_first'];
      $price_s = $row1['p_deposit_second'];
      $total = $_SESSION["strQty"][$i] * $price;
      $total_f = $_SESSION["strQty"][$i] * $price_f;
      $total_s = $_SESSION["strQty"][$i] * $price_s;


      // echo $total;
      // exit();

      $sql2 = "INSERT INTO tbl_order_detail (
      order_id,
      p_id,
      member_id,
      detail_qty,
      order_detail_price,
      order_detail_price_f,
      order_detail_price_s,
      order_total,
      order_total_first,
      order_total_second
      )
      VALUES('$order_id',
      '".$_SESSION["strProductID"][$i]."',
      '$member_id',
      '".$_SESSION["strQty"][$i]."',
      '$price',
      '$price_f',
      '$price_s',
      '$total',
      '$total_f',
      '$total_s')
    ";


      mysqli_query($con, $sql2);
			
	  }
  }
  unset($_SESSION['intLine'],$_SESSION['strProductID']);


 
mysqli_close($con);

echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

echo '<script>
setTimeout(function() {
 swal({
     title: "ทำรายการสำเร็จ",
     text: "โปรดรอการตรวจสอบ",
     type: "success"
 }, function() {
     window.location = "track.php";
 });
}, 1000);
</script>';

?>
