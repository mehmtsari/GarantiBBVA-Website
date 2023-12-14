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
                        aria-label="Gönderilen Kodu giriniz" aria-describedby="submitBTN">
                    <button class="btn btn-outline-success" type="button" id="submitBTN">Button</button>
                </div>
            </div>
            <div class="card-footer text-body-dark timer" id='timer'>
                Kalan Süre: <span class="text-danger fw-bolder" id="time"></span>
            </div>
        </div>

    </div>
    <?php
    //$toMail = $_POST["email"];
    //$toName = $_POST["fullname"];
    //$boolres = sendCodeMail($toMail, $toName);
    //if ($boolres) {
    //    echo '<script>startTimer();</script>';
    //    showAlert("Kod Başarıyla gönderildi", "success");
    //} else {
    //    showAlert("Kod gönderilirken bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz..", "danger");
    //}
    ?>

    <script>
        function startTimer() {
      // 2 dakikadan geriye sayma
      var countDownDate = new Date().getTime() + 120000;
      document.getElementById("time").innerHTML = "1:59";
      var x = setInterval(function () {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("time").innerHTML = minutes + ":" + seconds;

        if (distance < 0) {
          clearInterval(x);
          document.getElementById("time").innerHTML = "EXPIRED";
        }
      }, 1000)};

      startTimer();
    </script>






    <?php
    include 'php/bodyEnd.php';
    ?>

</body>

</html>