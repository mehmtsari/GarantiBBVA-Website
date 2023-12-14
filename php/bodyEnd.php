<?php
include 'coreHTML/footer.html';
include 'coreHTML/core/js.html';
navbarExchangeSet();
try{
    // session içinde lastMSG varsa alert göster
    if (isset($_SESSION["lastMSG"])) {
        showAlert();
    }
}
catch(Exception $e){
    echo $e;
    
}


?>