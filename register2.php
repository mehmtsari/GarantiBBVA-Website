<?php
include 'php/db.php';
include 'php/main.php';
if (isset($_SESSION["user"])) {
  header("Location: home.php?404Error=Giriş yapmışken kayıt olamazsınız!");
}
if (isset($_GET["register"])){
  if ($_GET["register"] == "true"){
    insertUser();
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


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      echo 'Get isteği';
      echo '<div class="container align-items-center justify-content-center h-100 w-50 mx-auto text-light bg-dark">
        <h1 class="text-center display-1">Kayıt Ol </h1>
        <form class="card border-0 shadow-sm p-4 align-items-center bg-dark" method="POST">
        <div class="form-group row mb-3 m-2 label-floating w-75 ">
          <!-- 11 hane sınırlı tc inputu -->
            <input type="text" class="form-control" placeholder="TC Kimlik Numarası" id="tc" maxlength="11" name="tc" required>
        </div>


        <div class="form-group row mb-3 m-2 label-floating w-75 ">
          <input type="text" class="form-control" placeholder="İsim Soyisim" id="name" name="fullname" required>
        </div>
        <div class="form-group row mb-3 m-3 label-floating w-75 ">
          <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" required>
        </div>
        <div class="form-group row mb-3 m-3 label-floating w-75 h-100">
          <input type="password" class="form-control" placeholder="Şifre" id="password" name="password" required>
        </div>
        <div class="form-group row mb-3 m-3 label-floating w-75 h-100">
          <input type="password" class="form-control" placeholder="Şifre Tekrar" id="password2" name="password2" required>
        </div>


        <div class="form-group row mb-5 m-4 label-floating w-75 h-100 align-items-center justify-content-center" >
          <button class="btn btn-success w-75 text-center registerBtn disabled" type="submit">Doğrula</button>
        </div>
      </form>
    </div>
    <div class="card h-50 w-25 text-light bg-dark">
        <div class="card-body">
            <h5 class="card-title form-valid-title">Lütfen Bütün bilgileri giriniz</h5>
            <ul class="bd-example mb-2 border-0">
                <li class="list-group-item text-danger m-2 tc-valid ">TC Kimlik Numarası girilmeli </li>
                <li class="list-group-item text-danger m-2 name-valid">İsim Soyisim girilmeli!</li>
                <li class="list-group-item text-danger m-2 email-valid">E-mail Girilmeli</li>
                <li class="list-group-item text-danger m-2 password-length-valid">Şifre en az 8 karakter olmalı</li>
                <li class="list-group-item text-danger m-2 password-words-valid">Şifre Büyük harf, küçük harf ve rakam içermeli</li>
                <li class="list-group-item text-danger m-2 password-valid">Şifreler eşleşmeli</li>
            </ul>
            
        </div>
    </div>';
    } else {
      echo 'Post isteği';

      echo '<div class="container d-flex justify-content-center align-items-center m-5 bg-dark">
      <div class="card text-center m-5">
        <div class="card-body">
          <h5 class="card-title fw-bold" style="font-size: 2rem;">E-Posta Onayı</h5>
          <p class="card-text fw-medium"> Kayıt işleminizi tamamlamak için e-posta adresinize gönderilen kodu giriniz.
          </p>
          <form class="card-text fw-medium">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Kod" aria-label="Kod" aria-describedby="basic-addon2"
                required maxlength="6" minlength="6" pattern="[0-9]{6}" title="6 haneli kodu giriniz" id="code"
                name="codeCheck">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="codeControl()">Doğrula</button>
              </div>
            </div>
          </form>
          <p class="card-text fw-medium time-div" style="display: none;">Kalan Süre: <span id="time"></span></p>
        </div>
        <div class="card-footer text-muted">
          GarantiBBVA ©
          ' . date("Y") . '
        </div>
      </div>
    </div>

    <script>
    function startTimer() {
      // 2 dakikadan geriye sayma
      var countDownDate = new Date().getTime() + 120000;
      document.getElementById("time").innerHTML = "1:59";
      document.querySelector(".time-div").style.display = "block";
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
      }, 1000);

    }
  </script>';

      $toMail = $_POST["email"];
      $toName = $_POST["fullname"];
      $boolres = sendCodeMail($toMail, $toName);
      if ($boolres) {
        echo '<script>startTimer();</script>';
        showAlert("Kod Başarıyla gönderildi", "success");
      } else {
        showAlert("Kod gönderilirken bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz..", "danger");
      }

    }
    ?>
    <script>
      // securityCodeCheck.php get isteği
      function codeControl() {
        var code = document.getElementById("code").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var res = this.responseText;
            if (res == "1") {
              window.location.href = "register.php?register=true";
            } else {
              console.log("Kod yanlış");
            }
          }
        };
        xhttp.open("GET", "php/securityCodeCheck.php?code=" + code, true);
        xhttp.send();
      }
    </script>
    





  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo '<script src="js/signInOut.js"></script>';
  }
  ?>

  <?php
  include 'php/bodyEnd.php';
  ?>

</body>

</html>