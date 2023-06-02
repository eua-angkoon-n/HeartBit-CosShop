<?php 
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

$sql = "SELECT * FROM tbl_product 
ORDER BY p_id ASC";
$result = mysqli_query($con, $sql);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.apilayer.com/fixer/latest?symbols=THB&base=CNY",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: c4fJZaVFtyVWA3uVciXExqCxfG6ewybm"
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
));

$response = curl_exec($curl);

curl_close($curl);
$response=json_decode($response,true);
$final_a=$response['rates']['THB'];

$rate = "INSERT INTO tbl_currency (
currency_rate
)
VALUES (
$final_a
)";

$rate_result = mysqli_query($con, $rate);

foreach($result as $row_prd){

if($_SESSION['m_level']!='admin'){
	Header("Location: index.php");
}
		$p_id = $row_prd["p_id"];
		$p_price_cny = $row_prd["p_price_cny"];
		$p_price_fee = $row_prd["p_price_fee"];
		$p_deposit = $row_prd["p_deposit"];

		$amount = $p_price_cny;
		
			$p_price_thb = round($final_a*$amount); //ราคาแปลงไทย
			// $p_price_thb = 100;
	  
			
			$p_price_total = $p_price_thb + $p_price_fee; //ราคารวม

			$p_deposit_second = $p_price_total - ($p_deposit / 100 * ($p_price_total));
			$p_deposit_first = $p_price_total - $p_deposit_second;

			if($p_deposit_first == '0'){
				$p_deposit_first = $p_deposit_second;
				$p_deposit_second = '0';
			}

		

	$sql = "UPDATE tbl_product SET 
	p_price_thb='$p_price_thb',
	p_price_total='$p_price_total',
	p_deposit_first='$p_deposit_first',
	p_deposit_second='$p_deposit_second'
	WHERE p_id=$p_id
	 ";

	$result = mysqli_query($con, $sql);
	
	
	if($result){
		echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
	
		echo '<script>
		setTimeout(function() {
		swal({
		 title: "อัพเดตสำเร็จ",
		 text: "",
		 type: "success"
	 }, function() {
		 window.location = "product.php";
	 });
	}, 1000);
	</script>';
	}
}
mysqli_close($con);
?>