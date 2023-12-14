<?php
session_start();
include 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "register") {
            echo "1";

            if (isset($_SESSION["user"])) {
                header("Location: home.php?404Error=Giriş yapmışken kayıt olamazsınız!");
            }
            
            insertUser();
        }
    }


}
else {
    header("Location: ../error.php");
}

?>