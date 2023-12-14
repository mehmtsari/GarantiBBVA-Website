<?php
include 'php/db.php';
include 'php/main.php';
if (isset($_SESSION["user"])) {
    header("Location: home.php?404Error=Giriş yapmışken kayıt olamazsınız!");
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
        <div class="container align-items-center justify-content-center h-100 w-50 mx-auto text-light bg-dark">
            
            <h1 class="text-center display-1">Kayıt Ol </h1>
            <form class="card border-0 shadow-sm p-4 align-items-center bg-dark" method="POST" action="Security.php?register=true">
                <div class="form-group row mb-3 m-2 label-floating w-75 ">
                    <!-- 11 hane sınırlı tc inputu -->
                    <input type="text" class="form-control" placeholder="TC Kimlik Numarası" id="tc" maxlength="11"
                        name="tc" required>
                </div>


                <div class="form-group row mb-3 m-2 label-floating w-75 ">
                    <input type="text" class="form-control" placeholder="İsim Soyisim" id="name" name="fullname"
                        required>
                </div>
                <div class="form-group row mb-3 m-3 label-floating w-75 ">
                    <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" required>
                </div>
                <div class="form-group row mb-3 m-3 label-floating w-75 h-100">
                    <input type="password" class="form-control" placeholder="Şifre" id="password" name="password"
                        required>
                </div>
                <div class="form-group row mb-3 m-3 label-floating w-75 h-100">
                    <input type="password" class="form-control" placeholder="Şifre Tekrar" id="password2"
                        name="password2" required>
                </div>


                <div
                    class="form-group row mb-5 m-4 label-floating w-75 h-100 align-items-center justify-content-center">
                    <button type="submit" class="btn btn-success text-center w-75  registerBtn" >
                        Kayıt Ol
                    </button>
                        
                    </button>
                </div>
            </form>
        </div>
        <div class="card h-50 w-25 text-light bg-dark">
            <div class="card-body bg-dark">
                <h5 class="card-title form-valid-title ">Lütfen Bütün bilgileri giriniz</h5>
                <ul class="bd-example mb-2 border-0">
                    <li class="list-group-item text-danger m-2 tc-valid ">TC Kimlik Numarası girilmeli </li>
                    <li class="list-group-item text-danger m-2 name-valid">İsim Soyisim girilmeli!</li>
                    <li class="list-group-item text-danger m-2 email-valid">E-mail Girilmeli</li>
                    <li class="list-group-item text-danger m-2 password-length-valid">Şifre en az 8 karakter olmalı</li>
                    <li class="list-group-item text-danger m-2 password-words-valid">Şifre Büyük harf, küçük harf ve
                        rakam içermeli</li>
                    <li class="list-group-item text-danger m-2 password-valid">Şifreler eşleşmeli</li>
                </ul>

            </div>
        </div>

        <?php



        ?>
        <script>
            // securityCodeCheck.php get isteği
            function codeControl() {
                var code = document.getElementById("code").value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var res = this.responseText;
                        if (res == "1") {
                            window.location.href = "login.php";
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