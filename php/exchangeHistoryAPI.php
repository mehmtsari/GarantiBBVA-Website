<?php
// son 48 ayı getir
$rows = getExchanges(240);

// aylık verileri tutacak listeler
$usdList = [];
$eurList = [];
$cadList = [];
$jpyList = [];
$gbpList = [];
$chfList = [];
$datetimeList = [];

// verileri aylık olarak gruplayacak değişkenler
$currentMonth = '';
$currentYear = '';
$usdMonthly = [];
$eurMonthly = [];
$cadMonthly = [];
$jpyMonthly = [];
$gbpMonthly = [];
$chfMonthly = [];



foreach ($rows as $row) {
    $json = json_decode($row['exchangeJSON'], true);
    $usd = $json['USD'];
    $eur = $json['EUR'];
    $cad = $json['CAD'];
    $jpy = $json['JPY'];
    $gbp = $json['GBP'];
    $chf = $json['CHF'];
    $date = $row['datetime'];
    $date = substr($date, 0, 10);
    $dateParts = explode('-', $date);
    $year = $dateParts[0];
    $month = $dateParts[1];
    if ($currentMonth != $month || $currentYear != $year) {
        if ($currentMonth != '') {
            $usdList[] = round(array_sum($usdMonthly) / count($usdMonthly), 2);
            $eurList[] = round(array_sum($eurMonthly) / count($eurMonthly), 2);
            $cadList[] = round(array_sum($cadMonthly) / count($cadMonthly), 2);
            $jpyList[] = round(array_sum($jpyMonthly) / count($jpyMonthly), 2);
            $gbpList[] = round(array_sum($gbpMonthly) / count($gbpMonthly), 2);
            $chfList[] = round(array_sum($chfMonthly) / count($chfMonthly), 2);
            $datetimeList[] = $currentYear . '-' . $currentMonth . '-01';
        }
        $currentMonth = $month;
        $currentYear = $year;
        $usdMonthly = [];
        $eurMonthly = [];
        $cadMonthly = [];
        $jpyMonthly = [];
        $gbpMonthly = [];
        $chfMonthly = [];
    }
    $usdMonthly[] = $usd;
    $eurMonthly[] = $eur;
    $cadMonthly[] = $cad;
    $jpyMonthly[] = $jpy;
    $gbpMonthly[] = $gbp;
    $chfMonthly[] = $chf;
}

// son ayı da ekle
$usdList[] = round(array_sum($usdMonthly) / count($usdMonthly), 2);
$eurList[] = round(array_sum($eurMonthly) / count($eurMonthly), 2);
$cadList[] = round(array_sum($cadMonthly) / count($cadMonthly), 2);
$jpyList[] = round(array_sum($jpyMonthly) / count($jpyMonthly), 2);
$gbpList[] = round(array_sum($gbpMonthly) / count($gbpMonthly), 2);
$chfList[] = round(array_sum($chfMonthly) / count($chfMonthly), 2);
$datetimeList[] = $currentYear . '-' . $currentMonth . '-01';

// veriyi ters çeviriyoruz
$usdList = array_reverse($usdList);
$eurList = array_reverse($eurList);
$cadList = array_reverse($cadList);
$jpyList = array_reverse($jpyList);
$gbpList = array_reverse($gbpList);
$chfList = array_reverse($chfList);
$datetimeList = array_reverse($datetimeList);



// json formatındaki listeleri javascript tarafına gönderiyoruz
$usdList = json_encode($usdList);
$eurList = json_encode($eurList);
$cadList = json_encode($cadList);
$jpyList = json_encode($jpyList);
$gbpList = json_encode($gbpList);
$chfList = json_encode($chfList);
$datetimeList = json_encode($datetimeList);

echo "<script>
    var usdList = $usdList;
    var eurList = $eurList;
    var cadList = $cadList;
    var jpyList = $jpyList;
    var gbpList = $gbpList;
    var chfList = $chfList;
    var datetimeList = $datetimeList;

    
    var chart = new Chart('ExchangeChart', {
        type: 'line',
        options:{
            responsive:true,
            maintainAspectRatio:false,
            },
        data: {
            labels: datetimeList,
            datasets: [{
                label: 'USD',
                backgroundColor: 'rgba(0,0,255,1.0)',
                borderColor: 'rgba(0,0,255,0.8)',
                data: usdList,
                fill: false,
                hidden: true,
            },
            {
                label: 'EUR',
                backgroundColor: 'rgba(21,115,71,1.0)',
                borderColor: 'rgba(21,115,71,0.8)',
                data: eurList,
                fill: false,
                hidden: true,
            },
            {
                label: 'CAD',
                backgroundColor: 'rgba(255,0,0,1.0)',
                borderColor: 'rgba(255,0,0,0.8)',
                data: cadList,
                fill: false,
                hidden: true,
            },
            {
                label: 'JPY',
                backgroundColor: 'rgba(33,37,41,1.0)',
                borderColor: 'rgba(33,37,41,0.8)',
                data: jpyList,
                fill: false,
                hidden: true,
            },
            {
                label: 'GBP',
                backgroundColor: 'rgba(0,255,255,1.0)',
                borderColor: 'rgba(0,255,255,0.8)',
                data: gbpList,
                fill: false,
                hidden: true,
            },
            {
                label: 'CHF',
                backgroundColor: 'rgba(255,0,255,1.0)',
                borderColor: 'rgba(255,0,255,0.8)',
                data: chfList,
                fill: false,
                hidden: true,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            }
        }
    });

    // hepsini animasyon gibi teker teker aç
    function showAllExchangeHistory(time) {
        for (let i = 0; i < chart.data.datasets.length; i++) {
            setTimeout(function(){
                chart.getDatasetMeta(i).hidden=false;
                chart.update();
            }, time *i);
        }
    }
    function hideAllExchangeHistory(time) {
        for (let i = 0; i < chart.data.datasets.length; i++) {
            setTimeout(function(){
                chart.getDatasetMeta(i).hidden=true;
                chart.update();
            }, time *i);
        }
    }
    

</script>";
?>