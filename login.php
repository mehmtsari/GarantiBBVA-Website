<?php



include 'php/db.php';
include 'php/main.php';
if (isset($_SESSION["user"])) {
  header("Location: home.php?404Error=Zaten giriş yapmışsınız!");
}
login();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GarantiBBVA</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <?php
  include 'coreHTML/core/css.html';
  ?>
</head>

<body class="bg-dark">
  <?php
  include 'coreHTML/navbar.php';
  ?>


  <div class="container align-items-center h-100">
    <div class="container align-items-center justify-content-center h-100 w-50 mx-auto text-light bg-dark"
      style="margin-top: 150px;">
      <h1 class="text-center display-1">Giriş Yap</h1>
      <form class="card border-0 shadow-sm p-4 align-items-center bg-dark" method="POST">

        <div class="form-group row mb-3 m-2 label-floating w-75 ">
          <input type="text" class="form-control" placeholder="TC Kimlik Numarası" name="tc">
        </div>
        <div class="form-group row mb-3 m-4 label-floating w-75 h-100">
          <input type="password" class="form-control" placeholder="Şifre" name="password">
        </div>
        <div class="form-group row mb-5 m-4 label-floating w-75 h-100 align-items-center justify-content-center">
          <button class="btn btn-success w-75 text-center ">Giriş Yap</button>
        </div>
      </form>
    </div>
  </div>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <?php

  if (isset($_GET['loginReq'])) {
    showAlert("Bu sayfayı görüntülemek için giriş yapmalısınız!", "danger");
  }
  include 'php/bodyEnd.php';
  ?>
</body>

</html>