<?php
  include 'php/db.php';
  include 'php/main.php';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA Kredi Öngösterim Sayfası</title>
    <?php 
        include 'coreHTML/core/css.html';
    ?>
</head>

<body class="bg-dark">
    <?php 
        include 'coreHTML/navbar.php';
    ?>

    <div class="container my-5">
        <h1 class="text-success mb-5">Hizmetlerimiz</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kredi Kartları</h5>
                        <p class="card-text">GarantiBBVA kredi kartları hakkında detaylı bilgi almak için tıklayın.</p>
                        <a href="credit-cards.php" class="btn btn-success">Daha Fazla Bilgi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kredi</h5>
                        <p class="card-text">GarantiBBVA kredi hizmetleri hakkında detaylı bilgi almak için tıklayın.</p>
                        <a href="loans.php" class="btn btn-success">Daha Fazla Bilgi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sigorta</h5>
                        <p class="card-text">GarantiBBVA sigorta hizmetleri hakkında detaylı bilgi almak için tıklayın.</p>
                        <a href="insurance.php" class="btn btn-success">Daha Fazla Bilgi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        include 'php/bodyEnd.php';
    ?>
</body>

</html>
