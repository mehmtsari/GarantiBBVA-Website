<?php
include "db.php";


$lastDate = getLastExchangeDate();
if ($lastDate == null || strtotime($lastDate) < strtotime('-1 days')) {
    $insertMode = true;
} else {
    $insertMode = false;
}


if ($insertMode) {
    $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_Cf6OAn29pmsbdoCZcWWPbQMzxEYKNJPEc9etwq1i&currencies=EUR%2CUSD%2CCAD%2CJPY%2CGBP%2CCHF&base_currency=TRY';
    
    // Verileri alın
    $response = file_get_contents($url);
    $data = json_decode($response);
    $currency_list = [
        'USD' => round(1 / $data->data->USD, 2),
        'EUR' => round(1 / $data->data->EUR, 2),
        'CAD' => round(1 / $data->data->CAD, 2),
        'JPY' => round(1 / $data->data->JPY, 2),
        'GBP' => round(1 / $data->data->GBP, 2),
        'CHF' => round(1 / $data->data->CHF, 2),
    ];
    $json = json_encode($currency_list);

    if ($insertMode) {
        insertExchange($json);
    }
}
else {
    $data = getLastExchange();
    $data = json_decode($data);
    
    $currency_list = [
        'USD' => round(1 / $data->USD, 2),
        'EUR' => round(1 / $data->EUR, 2),
        'CAD' => round(1 / $data->CAD, 2),
        'JPY' => round(1 / $data->JPY, 2),
        'GBP' => round(1 / $data->GBP, 2),
        'CHF' => round(1 / $data->CHF, 2),
    ];
    $json = json_encode($currency_list);

}


$json = json_encode($currency_list);


header('Content-Type: application/json');
echo $json;
?>