<?php
session_start();

$code = $_GET["code"];
$code2 = $_GET["code2"];

if ($code == $code2) {
    echo "1";
}
else {
    echo "0";
}
?>