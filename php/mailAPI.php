<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../home.php?404Error=404");
    die();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // PHPMailer kütüphanesini yükleyin

$mail = new PHPMailer(true);


$toAddress = $_POST['toMail'];
$toName = $_POST['toName'];
$code = $_POST['code'];
try {
    // SMTP ayarları
    $mail->isSMTP();
    $mail->Host       = 'smtp-mail.outlook.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lorpenbusiness@outlook.com';
    $mail->Password   = 'Fbmehmet09';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;


    // Alıcı ve mesaj bilgileri
    $mail->setFrom('lorpenbusiness@outlook.com', 'Lorpen Business');
    $mail->addAddress($toAddress, $toName);
    $mail->Subject = 'GarantiBBVA Güvenlik Kodu';
    $mail->isHTML(true);
    // geniş string kullanımı
    $mail->Body = '<!DOCTYPE html>
    <html lang="tr">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>GarantiBBVA Güvenlik Kodu Maili</title>
        <style>
          body {
            font-size: 1.2rem;
            background-color: #343a40;
            color: #fff;
            padding: 5rem;
          }
    
          h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
          }
    
          .fw-bold {
            font-weight: bold;
          }
    
          p {
            margin-bottom: 1rem;
          }
    
          button {
            background-color: #dc3545;
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
          }
    
          button.btn-success {
            background-color: #198754;
          }
    
          img {
            max-width: 100%;
            height: auto;
          }
    
          .text-green {
            color: #198754;
          }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      </head>
      <body>
        <div class="container">
          <h1>Sayın <span class="fw-bold text-green">'. $toName .'</span> Bey,</h1>
          <p>
            GarantiBBVA üzerinden
            <span class="fw-bold">Güvenlik Kodu</span> talebinde bulundunuz.
          </p>
          <p>
            Güvenlik Kodunuz:
            <button id="copyButton" class="btn btn-danger">' . $code .'</button>
          </p>
          <p>Bu kodu kimseyle paylaşmayınız.</p>
          <p>GarantiBBVA iyi günler diler..</p>
          <img
            src="https://sube.assets.garantibbva.com.tr/assets/img/logo-garantibbva.png"
            alt=""
          />
        </div>
        <script>
          function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
          }
          document
            .querySelector("#copyButton")
            .addEventListener("click", function () {
              copyToClipboard(document.querySelector("#copyButton"));
              document.querySelector("#copyButton").innerHTML = "Kopyalandı";
              document.querySelector("#copyButton").classList.remove("btn-danger");
              document.querySelector("#copyButton").classList.add("btn-success");
              setTimeout(function () {
                document.querySelector("#copyButton").innerHTML = "'. $code .'";
                document
                  .querySelector("#copyButton")
                  .classList.remove("btn-success");
                document.querySelector("#copyButton").classList.add("btn-danger");
              }, 1000);
            });
        </script>
      </body>
    </html>';
    // utf-8
    $mail->CharSet = 'UTF-8';
    

    // E-posta gönderme
    $mail->send();
    echo true;
} catch (Exception $e) {
    echo false;
}
?>


