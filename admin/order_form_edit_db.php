<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['m_level']!='admin'){
	Header("Location: index.php");
}
    $order_id = mysqli_real_escape_string($con,$_POST["order_id"]);
	$order_status = mysqli_real_escape_string($con,$_POST["order_status"]);
	$order_deliver = mysqli_real_escape_string($con,$_POST["order_deliver"]);
	$order_parcel = mysqli_real_escape_string($con,$_POST["order_parcel"]);
	



     if($order_status == '4'){
        $sql_sec = "UPDATE tbl_order_detail SET
        order_total_second = '0'
        WHERE order_id = $order_id
        ";
         $result_sec = mysqli_query($con, $sql_sec);


        $sql_status = "UPDATE tbl_order SET 
        order_price_second='0'
        WHERE order_id=$order_id
         ";
         $result_status = mysqli_query($con, $sql_status);
     }

	$sql = "UPDATE tbl_order SET 
	order_status='$order_status',
	order_deliver='$order_deliver',
	order_parcel='$order_parcel'
	WHERE order_id=$order_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
    swal({
     title: "บันทึกสำเร็จ",
     text: "",
     type: "success"
 }, function() {
     window.location = "order.php";
 });
}, 1000);
</script>';

?>