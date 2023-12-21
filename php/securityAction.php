<?php
session_start();
include 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_GET["action"])) {
        if ($_GET["action"] == "register") {
            if (isset($_SESSION["user"])) {
                header("Location: home.php?404Error=Giriş yapmışken kayıt olamazsınız!");
            }

            insertUser();
        } elseif ($_GET["action"] == "updateUser") {
            if (isset($_SESSION["user"])) {
                $user = json_decode($_SESSION["user"]);
                if (isset($_POST['tcNo'])) {
                    $tc = $_POST['tcNo'];
                } else {
                    $tc = null;
                }
                if (isset($_POST['name'])) {
                    if (isset($_POST['lastname'])) {
                        $fullName = $_POST['name'] . " " . $_POST['surname'];
                    } else {
                        $fullName = null;
                    }
                }
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                } else {
                    $email = null;
                }
                if (isset($_POST['phone'])) {
                    $phone = $_POST['phone'];
                } else {
                    $phone = null;
                }
                updateUser($user->id, $tc, $fullName, $email, $phone);
            }
        }
        elseif ($_GET['action'] == "transfer") {
            $count = $_POST['count'];
            $desc = $_POST['desc'];
            if (isset($_GET['method'])) {
                $user = json_decode($_SESSION["user"]);
                $from = $user->id;
                if ($_GET['method'] == 0) {   
                    $to = getUserIdFromIBAN($_POST['IBAN']);
                }
                elseif ($_GET['method'] == 1) {
                    $to = getUserIdFromName($_POST['name']);
                }
                elseif ($_GET['method'] == 2) {
                    $to = getUserIdFromAccountNumber($_POST['accountNumber']);
                }
                else{
                    header("Location: ../error.php");
                }

                if ($to == null){
                    header("Location: ../error.php");
                }
                else{
                    if (transferMoney($from, $to, $count, $desc)){
                        $_SESSION["lastMSG"] = "Para başarıyla gönderildi";
                        $_SESSION["lastMSGType"] = "success";
                        header("Location: ../account.php");
                    }
                    else{
                        $_SESSION["lastMSG"] = "Para gönderilirken bir hata oluştu";
                        $_SESSION["lastMSGType"] = "danger";
                        header("Location: ../account.php");
                    }
                }

            } else {
                header("Location: ../error.php");
            }
        }


    } else {
        header("Location: ../error.php");
    }
}

?>