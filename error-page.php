
<?php
include 'php/db.php';
include 'php/main.php';

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

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center">

            <div class="card-body">
                <h5 class="card-title fw-bold" style="font-size: 2rem;">Error 404</h5>
                <p class="card-text fw-medium"> Aradığınız sayfa ya bulunmamakta ya da bakım aşamasında olabilir.</p>
                <p class="card-text fw-medium">Lütfen daha sonra tekrar deneyiniz.</p>
                <a href="/GARANTIBBVA" class="btn btn-success fw-medium">Anasayfa'ya Dön</a>
            </div>
            <div class="card-footer text-muted">
                GarantiBBVA © <?php echo date("Y"); ?>
            </div>
        </div>
    </div>

</body>

</html>

