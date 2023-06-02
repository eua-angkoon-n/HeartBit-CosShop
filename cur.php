<?php 

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

echo $final_a;
?>