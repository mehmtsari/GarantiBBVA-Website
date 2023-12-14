<?php
session_start();


if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_destroy();
    header("Location: ../home.php");
    exit();
}


function showAlert($message=null, $type="info", $jsInside=null){
    if ($message) {
        $_SESSION["lastMSG"] = $message;
        $_SESSION["lastMSGType"] = $type;
    }

    if ($_SESSION["lastMSG"]) {
      $msg = $_SESSION["lastMSG"];
      $type = $_SESSION["lastMSGType"];
      
      if ($jsInside) {
        echo 'document.querySelector(".alert").style.display = "block";'
        . 'document.querySelector(".alert").className = "alert fw-bolder alert-dismissible fade show topAlert alert-'.$type.'";'
        . 'document.querySelector(".alert-message").innerHTML = "'.$msg.'";';
        
      }
      else {
        echo '<script>'
        . 'document.querySelector(".alert").style.display = "block";'
        . 'document.querySelector(".alert").className = "alert fw-bolder alert-dismissible fade show topAlert alert-'.$type.'";'
        . 'document.querySelector(".alert-message").innerHTML = "'.$msg.'";'
          . '</script>';
      }
    
          
      $_SESSION["lastMSG"] = null;
      $_SESSION["lastMSGType"] = null;
  }
}

function navbarExchangeSet(){
    $data = getLastExchange();
    $data = json_decode($data, true);
    $dataList = [];
    foreach ($data as $key => $value) {
        
        if ($key == "USD"){
            $dataList[] = '1 Dolar ' . $value . "₺";
        }
        else if ($key == "EUR"){
            $dataList[] = '1 Euro ' . $value . "₺";
        }
        else if ($key == "CAD"){
            $dataList[] = '1 Kanada Doları ' . $value . "₺";
        }
        else if ($key == "JPY"){
            $dataList[] = '1 Japon Yeni ' . $value . "₺";
        }
        else if ($key == "GBP"){
            $dataList[] = '1 İngiliz Sterlini ' . $value . "₺";
        }
        else if ($key == "CHF"){
            $dataList[] = '1 İsviçre Frangı ' . $value . "₺";
        }
    }
    
    echo '<script>var typed = new Typed("#navExchangeBox", {strings: ["'.implode('","', $dataList).'"],typeSpeed: 80,backSpeed: 150,startDelay: 500, showCursor: false,waitUntilVisible: true,loop: true});</script>';

}

function loginRequired(){
    if (!isset($_SESSION["user"])) {
        header("Location: login.php?loginReq=true");
        exit();
    }
}

function sendCodeMail($toMail,$toName){
    $code = rand(100000,999999);
    $_SESSION["code"] = $code;
    echo $code;
    echo $_SESSION["code"];
    $url = "http://localhost/GarantiBBVA/php/mailAPI.php";
    $data = array(
        'toMail' => $toMail,
        'toName' => $toName,
        'code' => $code,
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {
        // Handle error
        $_SESSION["code"] = null;
        return [false,null];
    }
    else {
        return [true,$code];
    }
}
?>