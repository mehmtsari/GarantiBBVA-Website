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
<html lang="tr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA - Hesap Bilgilerim</title>
    <?php
    include 'coreHTML/core/css.html';
    ?>
</head>

<body>
    <?php
    include 'coreHTML/navbar.php';
    ?>



    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-md-6 rounded-4 bg-light-subtle">
                    <div class="h-100 p-5 rounded-3">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Kişi Bilgileri</h2>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Ad"
                                        value="<?php echo $name; ?>">
                                    <label for="floatingInput">Ad</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Soyad"
                                        value="<?php echo $lastname; ?>">
                                    <label for="floatingInput">Soyad</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="TC Kimlik No" value="<?php echo $user["tcNo"]; ?>">
                                    <label for="floatingInput">TC Kimlik No</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Telefon"
                                        value="+90 (553)163 69-50">
                                    <label for="floatingInput">Telefon</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div>
                                <div class="form-floating mb-6">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="IBAN"
                                        value="TR 00 0000 0000 0000 0000 0000 99">
                                    <label for="floatingInput">IBAN</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Hesap Bilgileri</h2>
                            </div>
                            <div class="col-md-5">
                                <button type="button" class="btn btn-success w-100">Para Transferi
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="row bg-body rounded-3 p-3 mb-2">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap No</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder ">000000000000000000000000</p>
                                </div>
                            </div>
                            <div class="row bg-body rounded-3 p-2 mb-2">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap Türü</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder">Vadesiz Hesap</p>
                                </div>
                            </div>
                            <div class="row bg-body rounded-3 p-2 mb-2">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap Bakiyesi</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder">0.00 TL</p>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php
    include 'php/bodyEnd.php';
    ?>
</body>