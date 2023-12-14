<?php
session_start();

$code = $_GET["code"];

if (!isset($_SESSION["code"])){
    echo "0";
}
else if ($code == $_SESSION["code"]){
    $_SESSION["code"] = null;
    echo "1";
}
else{
    echo "0";
}
?>