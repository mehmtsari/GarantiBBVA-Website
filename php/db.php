<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garantidb";
$conn = connectDB($servername, $username, $password, $dbname);


function connectDB($servername, $username, $password, $dbname)
{
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    return $conn;
  }
}

function emailExists($email)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE eMail='$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function tcExists($tc)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE tcNo='$tc'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function controlUserData($tc, $fullname, $email, $password, $password2)
{
  if (tcExists($tc)) {
    showAlert("Bu 'TC' kimlik numarası ya kullanılamaz yada kullanılmakta.. Lütfen bilgilerinizi kontrol ediniz..", "danger");
    return;
  }
  if (emailExists($email)) {
    showAlert("Bu E-mail adresi kullanılmakta. Lütfen başka bir e-mail adresi giriniz..", "danger");
    return;
  }
  if (strlen($tc) != 11) {
    showAlert("TC Kimlik Numarası 11 haneli olmalı!", "danger");
    return;
  }
  if (strlen($password) < 8) {
    showAlert("Şifre en az 8 karakter olmalı!", "danger");
    return;
  }
  if (!preg_match("#[0-9]+#", $password)) {
    showAlert("Şifre en az 1 rakam içermeli!", "danger");
    return;
  }
  if (!preg_match("#[a-z]+#", $password)) {
    showAlert("Şifre en az 1 küçük harf içermeli!", "danger");
    return;
  }
  if (!preg_match("#[A-Z]+#", $password)) {
    showAlert("Şifre en az 1 büyük harf içermeli!", "danger");
    return;
  }
  if ($password != $_POST["password2"]) {
    showAlert("Şifreler eşleşmiyor!", "danger");
    return;
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showAlert("Geçersiz E-mail adresi giriniz...", "danger");
    return;
  }
  $password = password_hash($password, PASSWORD_DEFAULT);
  if (password_verify($password, $email)) {
    showAlert("Şifre ve E-mail aynı olamaz!", "danger");
    return;
  }
  if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }
  return true;

}

// eğer sayfa post olarak yüklenmişse
function insertUser()
{
  global $conn;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tc = $_POST["tc"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $roleID = 1;
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (tcNo, fullName, eMail, password, roleID) VALUES ('$tc', '$fullname', '$email', '$password', '$roleID')";
    if (mysqli_query($conn, $sql)) {
      
      $_SESSION["lastMSG"] = "Kayıt Başarıyla Tamamlandı, Artık giriş yapabilirsiniz..";
      $_SESSION["lastMSGType"] = "success";
      header("Location: ../login.php");
      exit();
    } else {
      die("Connection failed: " . mysqli_connect_error());
    }

  }
}

function login()
{
  global $conn;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tc = $_POST["tc"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE tcNo='$tc'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        $_SESSION["user"] = json_encode($row);
        $_SESSION["lastMSG"] = "Giriş başarılı";
        $_SESSION["lastMSGType"] = "success";
        header("Location: home.php");
        exit();
      } else {
        $_SESSION["lastMSG"] = "Kullanıcı adı veya şifre yanlış!";
        $_SESSION["lastMSGType"] = "danger";
        return;
      }
    } else {
      $_SESSION["lastMSG"] = "Kullanıcı adı veya şifre yanlış!";
      $_SESSION["lastMSGType"] = "danger";
      return;

    }
  }
}


function insertExchange($datajson, $datetime = null)
{
  global $conn;
  $dateTime = date("Y-m-d H:i:s");
  if ($datetime) {
    $dateTime = $datetime;
  }

  $sql = "INSERT INTO exchange (exchangeJSON,datetime) VALUES ('$datajson','$dateTime')";
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

function advancePaymentinsert()
{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;
    $user = json_decode($_SESSION["user"]);
    $sql = "INSERT INTO advancerequests (userID ,amount) VALUES (" . $user->id . ", '" . $_POST["amount"] . "')";
    if (mysqli_query($conn, $sql)) {
      $_SESSION["lastMSG"] = "Avans talebiniz başarıyla alındı. En kısa sürede size dönüş yapılacaktır.";
      $_SESSION["lastMSGType"] = "success";
    } else {
      $_SESSION["lastMSG"] = null;
      die("Connection failed: " . mysqli_connect_error());
    }
  } else {
    $_SESSION["lastMSG"] = "Bu hizmet sayesinde avans talebinde bulunabilirsiniz.";
    $_SESSION["lastMSGType"] = "primary";
  }
}


function getExchanges($datemonths)
{
  global $conn;
  $dateDays = $datemonths * 30;
  $sql = "SELECT * FROM exchange ORDER BY datetime DESC LIMIT $dateDays";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;
  } else {
    return false;
  }
}

function getLastExchangeDate()
{
  global $conn;
  $sql = "SELECT * FROM exchange ORDER BY datetime DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["datetime"];
  } else {
    return null;
  }
}

function getLastExchange()
{
  global $conn;
  $sql = "SELECT * FROM exchange ORDER BY datetime DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["exchangeJSON"];
  } else {
    return null;
  }
}




?>