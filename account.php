<?php
include 'php/db.php';
include 'php/main.php';
$userjson = $_SESSION["user"];
$user = json_decode($userjson, true);
// ismi soyismi ayırma
// soyisim son boşluktan sonrası
$fullname = $user["fullName"];
$lastname = substr($fullname, strrpos($fullname, ' ') + 1);
$name = substr($fullname, 0, strrpos($fullname, ' '));


loginRequired();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA - Hesap Bilgilerim</title>
    <?php
    include 'coreHTML/core/css.html';
    ?>
</head>

<body class="bg-dark text-light">
    <?php
    include 'coreHTML/navbar.php';
    ?>

    <div class="container mt-5">
        <h1>Hesap Bilgilerim</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Kişisel Bilgiler</h3>
                <div class="card bg-success text-light mb-3 ">
                    <div class="card-body">
                        <table class="table table-striped table-success">
                            <tbody>
                                <tr>
                                    <td>Ad</td>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Soyad</td>
                                    <td>
                                        <?php echo $lastname; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TC Kimlik Numarası</td>
                                    <td>
                                        <?php echo $user["tcNo"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Doğum Tarihi</td>
                                    <td>01/01/2000</td>
                                </tr>
                                <tr>
                                    <td>Telefon Numarası</td>
                                    <td>555-555-5555</td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td>
                                        <a href="mailto: <?php echo $user['eMail']; ?>">
                                            <?php echo $user['eMail']; ?>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <table class="table table-striped table-success">
                            <thead>
                                <tr>
                                    <th>Adres</th>
                                    <th>Adres Tipi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1234 Main St</td>
                                    <td>Ev</td>
                                </tr>
                                <tr>
                                    <td>5678 Main St</td>
                                    <td>İş</td>
                                </tr>
                            </tbody>
                        </table>




                        <a href="edit.php" class="btn btn-light btn-block w-100 h-100 fw-bolder">Düzenle</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Hesap Bilgileri</h3>
                <div class="col">
                    <div class="card bg-success text-light">
                        <div class="card-body">

                            <table class="table table-success bg-success text-light">
                                <tbody>
                                    <tr>
                                        <td>Hesap Numarası</td>
                                        <td>
                                            <span class="fw-bolder">000000000000000000000000</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hesap Türü</td>
                                        <td>
                                            Bireysel
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Para Birimi</td>
                                        <td>
                                            USD
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bakiye</td>
                                        <td>
                                            $1000
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>IBAN</td>
                                        <td>
                                            TR000000000000000000000000
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="transfer.php" class="btn btn-light btn-block w-100 h-100 fw-bolder">Para
                                Transferi</a>

                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Para Akışı</h3>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Tarih/Saat</th>
                            <th>Açıklama</th>
                            <th>Tutar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01/01/2022 12:00</td>
                            <td>Maaş Ödemesi</td>
                            <td>$2000</td>
                        </tr>
                        <tr>
                            <td>02/01/2022 12:00</td>
                            <td>Fatura Ödemesi</td>
                            <td>-$100</td>
                        </tr>
                        <tr>
                            <td>03/01/2022 12:00</td>
                            <td>Havale</td>
                            <td>-$500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include 'php/bodyEnd.php';
    ?>
</body>