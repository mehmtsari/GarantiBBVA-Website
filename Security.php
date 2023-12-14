<?php
include 'php/db.php';
include 'php/main.php';

if (isset($_GET["register"])) {
    if ($_GET["register"] == "true") {

        if (isset($_SESSION["user"])) {
            header("Location: home.php?404Error=Giriş yapmışken kayıt olamazsınız!");
        }
    }
}



?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA</title>
    <?php
    include 'coreHTML/core/css.html';
    ?>

    <?php
    
    echo '<form  method="POST" action="php/securityAction.php?action=register" hidden>';
    // post verilerini buraya işle
    foreach ($_POST as $key => $value) {
        echo '<input type="text" name="' . $key . '" value="' . $value . '">';
    }
    echo '<button type="submit" id="actionBTN" name="actionBTN"></button>';
    echo '</form>';
    ?>

</head>

<body class="bg-dark">
    <?php
    include 'coreHTML/navbar.php';
    ?>




    <!-- itemlerini yan yana bitişik getirme-->
    <div class="container h-100 d-flex align-items-center justify-content-center " style="margin-top: 80px;">

        <div class="card text-center">
            <div class="card-header text-danger">
                Güvenlik Onayı
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">Güvenlik Dolayısıyla Bu işlemi Geçmek Zorundasınız</h5>
                <p class="card-text mb-4">Lütfen E-postanıza gönderilen kodu giriniz..</p>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="submitBTN">@</span>

                    <input type="text" class="form-control" placeholder="Gönderilen Kodu giriniz"
                        aria-label="Gönderilen Kodu giriniz" aria-describedby="submitBTN" id="code" name="code">
                    <button class="btn btn-outline-success" type="button" id="submitBTN"
                        onclick="codeControl()">Onayla</button>

                </div>

            </div>
            <div class="card-footer text-body-dark timer" id='timer'>
                Kalan Süre: <span class="text-danger fw-bolder" id="time"></span>
            </div>
        </div>

    </div>
    <?php
    $toMail = $_POST["email"];
    $toName = $_POST["fullname"];
    $boolres = sendCodeMail($toMail, $toName);
    if ($boolres[0]) {
        echo '<script>startTimer();</script>';
        showAlert("Kod Başarıyla gönderildi", "success");
    } else {
        showAlert("Kod gönderilirken bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz..", "danger");
    }
    ?>

    <script>
        function startTimer() {
            // 2 dakikadan geriye sayma
            var countDownDate = new Date().getTime() + 120000;
            document.getElementById("time").innerHTML = "01:59";
            var x = setInterval(function () {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                document.getElementById("time").innerHTML = minutes + ":" + seconds;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("time").innerHTML = "Süre Doldu";
                }
            }, 1000)
        };

        function codeControl() {
            var code = document.getElementById("code").value;

            if (code.length != 6) {
                <?php
                showAlert("Kod 6 haneli olmalıdır", "danger", true);
                ?>
                return;
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var res = this.responseText;
                    if (res == "1") {
                        document.getElementById("actionBTN").click();
                    } else {
                        <?php
                        showAlert("Kod yanlış girildi", "danger", true);
                        // kodu yazdır
                        
                        ?>
                        return;
                    }
                }
            };
            xhttp.open("GET", "php/securityCodeCheck.php?code=" + code + "&code2=" + <?php echo $_SESSION["code"]; ?>, true);
            xhttp.send();
        }
    </script>

    <?php
    include 'php/bodyEnd.php';
    ?>

</body>

</html>