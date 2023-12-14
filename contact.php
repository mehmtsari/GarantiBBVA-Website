<?php 
session_start();
// eğer giriş yapılmamışsa login.php ye yönlendir

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA</title>
    <?php 
        include 'coreHTML/core/css.html';
        include 'php/main.php';
    ?>

</head>

<body class="bg-dark">
    <?php 
        include 'coreHTML/navbar.php';
    ?>

    

    <?php 
        include 'coreHTML/footer.html';
        include 'coreHTML/core/js.html';
    ?>
</body>

</html>