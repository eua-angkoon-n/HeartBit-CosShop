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

	$p_name = mysqli_real_escape_string($con,$_POST["p_name"]);
	$type_id = mysqli_real_escape_string($con,$_POST["type_id"]);
	$p_detail = mysqli_real_escape_string($con,$_POST["p_detail"]);
	$p_price_cny = mysqli_real_escape_string($con,$_POST["p_price_cny"]);

	$p_price_fee = mysqli_real_escape_string($con,$_POST["p_price_fee"]);
	$p_deposit = mysqli_real_escape_string($con,$_POST["p_deposit"]);
	$p_status = mysqli_real_escape_string($con,$_POST["p_status"]);
	
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
	$upload=$_FILES['p_img']['name'];
	if($upload !='') { 
		$path="../p_img/";
		$type = strrchr($_FILES['p_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../p_img/".$newname;
		move_uploaded_file($_FILES['p_img']['tmp_name'],$path_copy); 
	}

		$amount = $_POST['p_price_cny'];
		$cur = 'THB';
		
		$curl = curl_init();
				
		  curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=$cur&from=CNY&amount=$amount",
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
			$final_a=$response['info']['rate'];
			$p_price_thb = round($final_a*$amount); //ราคาแปลงไทย

	  
			$p_price_fee = $_POST['p_price_fee']; //ค่านำเข้า
			$p_price_total = $p_price_thb + $p_price_fee; //ราคารวม

			$p_deposit_second = $p_price_total - ($p_deposit / 100 * ($p_price_total));
			$p_deposit_first = $p_price_total - $p_deposit_second;

			if($p_deposit_first == '0'){
				$p_deposit_first = $p_deposit_second;
				$p_deposit_second = '0';
			}
	  

	$sql = "INSERT INTO tbl_product
	(
	p_name,
	type_id,
	p_detail,
	p_price_cny,
	p_price_thb,
	p_price_fee,
	p_price_total,
	p_deposit,
	p_deposit_first,
	p_deposit_second,
	p_status,
	p_img
	)
	VALUES
	(
	'$p_name',
	'$type_id',
	'$p_detail',
	'$p_price_cny',
	'$p_price_thb',
	'$p_price_fee',
	'$p_price_total',
	'$p_deposit',
	'$p_deposit_first',
	'$p_deposit_second',
	'$p_status',
	'$newname'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='product.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>