<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbvadb";
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

function generateRandomIBAN() {
  $countryCode = "TR"; 
  $checkDigits = "00";
  $bankCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
  $accountNumber = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

  $iban = $countryCode . $checkDigits . $bankCode . $accountNumber;

  return $iban;
}

function getUserIdFromTC($tc){
  global $conn;
  $sql = "SELECT * FROM users WHERE tcNo='$tc'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["id"];
  } else {
    return false;
  }
}

function getUserIdFromIBAN($iban){
  global $conn;
  $sql = "SELECT * FROM users WHERE iban='$iban'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["id"];
  } else {
    return false;
  }
}

function getUserIdFromName($name){
  global $conn;
  $sql = "SELECT * FROM users WHERE fullName='$name'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["id"];
  } else {
    return false;
  }
}

function getUserIdFromAccountNumber($accountNumber){
  global $conn;
  $sql = "SELECT * FROM bankaccounts WHERE accountNumber='$accountNumber'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["userID"];
  } else {
    return false;
  }
}


function isIbanExists($iban){
  global $conn;
  $sql = "SELECT * FROM users WHERE iban='$iban'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function isUserNameExists($name){
  global $conn;
  $sql = "SELECT * FROM users WHERE fullName='$name'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}

function isAccountNumberExists($accountNumber){
  global $conn;
  $sql = "SELECT * FROM bankaccounts WHERE accountNumber='$accountNumber'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }
}


function insertBankAccount($userId,$type,$count){
  global $conn;
  $accountNumber = rand(100,999)."-".rand(1000,9999)." ".rand(100,999);
  $date = date("Y-m-d H:i:s");
  $sql = "INSERT INTO bankaccounts (userID, accountNumber, type,amountMoney,createdDate) VALUES ('$userId', '$accountNumber', '$type','$count','$date')";

  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

function transferMoney($from,$to,$count,$desc){
  global $conn;
  $date = date("Y-m-d H:i:s");
  $sql = "INSERT INTO moneytransfers (senderId, receiverId, description,count,dateTime) VALUES ('$from', '$to', '$desc','$count','$date')";
  if (mysqli_query($conn, $sql)) {
    setMoney($from,getMoney($from)-$count);
    setMoney($to,getMoney($to)+$count);
    return true;
  } else {
    return false;
  }
}

function getMoney($userId){
  global $conn;
  $sql = "SELECT * FROM bankaccounts WHERE userID='$userId'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row["amountMoney"];
  } else {
    return false;
  }
}

function setMoney($userId,$count){
  global $conn;
  $sql = "UPDATE bankaccounts SET amountMoney='$count' WHERE userID='$userId'";
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    return false;
  }
}

function getBankAccountsData($userId){
  global $conn;
  $sql = "SELECT * FROM bankaccounts WHERE userID='$userId'";
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

function getBankAccountHistory($userId){
  global $conn;
  $sql = "SELECT * FROM moneytransfers WHERE senderId='$userId' OR receiverId='$userId' ORDER BY dateTime DESC";
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

function getBankAccountHistoryWithType($userId){
  // gelen ödeme mi giden ödeme mi bunu belirtmek için her row sonuna type ekleyeceğiz
  // 0 gelen 1 giden
  global $conn;
  $sql = "SELECT * FROM moneytransfers WHERE senderId='$userId' OR receiverId='$userId' ORDER BY dateTime DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row["senderId"] == $userId) {
        $row["type"] = 1;
      } else {
        $row["type"] = 0;
      }
      $rows[] = $row;
    }
    return $rows;
  } else {
    return false;
  }
  
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
    $roleID = 0;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $iban = generateRandomIBAN();
    


    $sql = "INSERT INTO users (tcNo, fullName, eMail,iban, password, roleID) VALUES ('$tc', '$fullname', '$email','$iban', '$password', '$roleID')";
    if (mysqli_query($conn, $sql)) {
      // Herhangi bir atm hizmeti olmadığı için parayı rastgele belirliyoruz şuanlık
      // Normalde yapılması gereken değerin 0 olarak atanması ve kullanıcının hesabına para yatırması
      insertBankAccount(getUserIdFromTC($tc),"Vadesiz Hesap",rand(1000,9999));
      $_SESSION["lastMSG"] = "Kayıt Başarıyla Tamamlandı, Artık giriş yapabilirsiniz..";
      $_SESSION["lastMSGType"] = "success";
      header("Location: ../login.php");
      exit();
    } else {
      die("Connection failed: " . mysqli_connect_error());
    }

  }
}

function updateUser($id, $tc=null, $fullname=null, $email=null,$phone=null)
{
  global $conn;
  
  $sql = "UPDATE users SET ";
  if ($tc) {
    $sql .= "tcNo='$tc',";
  }
  if ($fullname) {
    $sql .= "fullName='$fullname',";
  }
  if ($email) {
    $sql .= "eMail='$email',";
  }
  if ($phone) {
    $sql .= "phoneNumber='$phone',";
  }
  $sql = substr($sql, 0, -1);
  $sql .= " WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
    $_SESSION["lastMSG"] = "Kullanıcı bilgileri başarıyla güncellendi..";
    $_SESSION["lastMSGType"] = "success";
    header("Location: ../account.php");
    exit();
  } else {
    die("Connection failed: " . mysqli_connect_error());
  }
}

function getAllUsers()
{
  global $conn;
  $sql = "SELECT * FROM users";
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

function getAllTransfers()
{
  global $conn;
  $sql = "SELECT * FROM moneytransfers ORDER BY dateTime DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $row['senderName'] = getUserDetailForId($row['senderId'], 'fullName');
      $row['receiverName'] = getUserDetailForId($row['receiverId'], 'fullName');
      $rows[] = $row;
    }
    return $rows;
  } else {
    return false;
  }
}

function getAllAdvances()
{
  global $conn;
  $sql = "SELECT * FROM advancerequests ORDER BY datetime DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $row['fullName'] = getUserDetailForId($row['userID'], 'fullName');
      $rows[] = $row;
    }
    return $rows;
  } else {
    return false;
  }
}

function getUserDetailForId($id, $detail)
{
  global $conn;
  $sql = "SELECT $detail FROM users WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row[$detail];
  } else {
    return false;
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

function getUser($id)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row;
  } else {
    return false;
  }
}

function updateUserSession()
{
  global $conn;
  if (isset($_SESSION["user"])) {
    $user = json_decode($_SESSION["user"]);
    $sql = "SELECT * FROM users WHERE id='$user->id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["user"] = json_encode($row);
    } else {
      $_SESSION["lastMSG"] = "Kullanıcı bulunamadı!";
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
    $sql = "INSERT INTO advancerequests (userID ,amount,datetime) VALUES (" . $user->id . ", '" . $_POST["amount"] . "', '" . date("Y-m-d H:i:s") . "')";
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