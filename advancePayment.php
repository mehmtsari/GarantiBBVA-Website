<?php
include 'php/db.php';
include 'php/main.php';
loginRequired();
advancePaymentinsert();
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

<body class="bg-dark text-light">
    <?php
    include 'coreHTML/navbar.php';
    ?>

    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center mb-3 gradient-text">Avans Talep İsteği</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Ad Soyad</label>
                    <input type="text" class="form-control" id="name" name="name" disabled required>
                </div>
                <div class="form-group">
                    <label for="email">E-Posta</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="tcno">TC Kimlik Numarası</label>
                    <input type="text" class="form-control" id="tcno" name="tcno" disabled required>
                </div>
                <div class="form-group">
                    <label for="iban">IBAN</label>
                    <input type="text" class="form-control" id="iban" name="iban" disabled required>
                </div>
                <div class="form-group">
                    <label for="amount">Talep Edilen Tutar</label>
                    <input type="number" class="form-control" id="amount" name="amount" required>
                </div>
                <span class="d-block mt-3"></span>

                <button type="button" class="btn btn-success btn-block w-100 fw-bolder" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Gönder
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content  bg-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 gradient-text" id="exampleModalLabel">Avans Talep İsteği Onayı</h1>                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal Et</button>
                                <button type="submit" class="btn btn-success btn-block w-25 fw-bolder sendBtn">Gönder</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <?php
    include 'php/bodyEnd.php';
    ?>
    <script>
        <?php
        $user = json_decode($_SESSION['user']);
        echo "document.getElementById('name').value = '" . $user->fullName . "'   ;";
        echo "document.getElementById('email').value = '" . $user->eMail . "'   ;";
        echo "document.getElementById('tcno').value = '" . $user->tcNo . "'   ;";
        ?>
    </script>
</body>

</html>