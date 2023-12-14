<?php
include 'db.php';

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://currency-conversion-and-exchange-rates.p.rapidapi.com/timeseries?start_date=2019-01-01&end_date=2019-12-31&base=TRY",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: currency-conversion-and-exchange-rates.p.rapidapi.com",
		"X-RapidAPI-Key: f38de7106bmshbe54baa75cc34fcp151a6bjsnf1ef100d094a"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$json = json_decode($response,true);
    // rates içindeki data içinde gez
    foreach ($json['rates'] as $date => $value) {


        
        // data column ismi tarih
        $date = date("Y-m-d", strtotime($date));
        
        $usd = $value['USD'] ?? 0;
        $eur = $value['EUR'] ?? 0;
        $cad = $value['CAD'] ?? 0;
        $jpy = $value['JPY'] ?? 0;
        $gbp = $value['GBP'] ?? 0;
        $chf = $value['CHF'] ?? 0;



        $data = [
            'USD' => round(1 / $usd, 2),
            'EUR' => round(1 / $eur, 2),
            'CAD' => round(1 / $cad, 2),
            'JPY' => round(1 / $jpy, 2),
            'GBP' => round(1 / $gbp, 2),
            'CHF' => round(1 / $chf, 2),
        ];
        
        $jsonData = json_encode($data);
        insertExchange($jsonData, $date);
        echo $date . " eklendi<br>";

    }
        









}
?>