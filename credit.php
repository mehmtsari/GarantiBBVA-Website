<?php
  include 'php/db.php';
  include 'php/main.php';
  loginRequired();
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
        <div class="row">
            
            <div class="col-md-6 offset-md-3">
            <h1 class="text-center mb-3 gradient-text">Kredi Önizlemesi</h1>
                <form id="credit-form" method="POST">
                    <div class="form-group">
                        <label for="credit-type">Kredi Türü</label>
                        <select class="form-control" id="credit-type" name="creditType">
                            <option value="1">Konut Kredisi</option>
                            <option value="2">Taşıt Kredisi</option>
                            <option value="3">İhtiyaç Kredisi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="credit-amount">Kredi Miktarı</label>
                        <input type="number" class="form-control" id="credit-amount" placeholder="Kredi Miktarı" name="creditAmount">
                    </div>
                    <div class="form-group">
                        <label for="credit-term">Vade</label>
                        <select class="form-control" id="credit-term" name="creditTerm">
                            <option value="3">3 Ay</option>
                            <option value="6">6 Ay</option>
                            <option value="12">12 Ay</option>
                            <option value="24">24 Ay</option>
                        </select>
                    </div>
                    <span class="d-block mt-3"></span>
                    <button type="submit" class="btn btn-success btn-block w-100 h-100 fw-bolder">Hesapla</button>
                </form>
            </div>
        </div>
        <!-- boşluk için span -->
        <span class="d-block mt-5"></span>
    </div>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kredi türüne göre faiz oranı belirlenecek
            $creditType = $_POST['creditType'];
            $creditAmount = $_POST['creditAmount'];
            $creditTerm = $_POST['creditTerm'];

            // hepsini int'e çevir
            $creditType = (int)$creditType;
            $creditAmount = (int)$creditAmount;
            $creditTerm = (int)$creditTerm;

            $faizOrani = 0.05;

            if ($creditType == 1) {
                $faizOrani = 0.02;
            } else if ($creditType == 2) {
                $faizOrani = 0.03;
            } else if ($creditType == 3) {
                $faizOrani = 0.04;
            }

            $odenecekTutar = $creditAmount + ($creditAmount * $faizOrani * $creditTerm);
            

            echo '<div class="row justify-content-center result">';
                echo '<div class="col-md-6">';
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<h4>Hesaplama Sonuçları</h4>';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<p>Kredi Miktarı: ' . $creditAmount . ' TL</p>';
                echo '<p>Vade Süresi: ' . $creditTerm . ' Ay</p>';
                echo '<p>Faiz Oranı: ' . $faizOrani . '</p>';
                echo '<p>Ödenecek Tutar: ' . $odenecekTutar . ' TL</p>';
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped table-dark">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Taksit No</th>';
                echo '<th>Anapara</th>';
                echo '<th>Faiz Tutarı</th>';
                echo '<th>Taksit Tutarı</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                for ($i = 1; $i <= $creditTerm; $i++) {
                    $anapara = ($creditAmount / $creditTerm);
                    $faizTutari = $creditAmount * $faizOrani;
                    $taksitTutari = $anapara + $faizTutari;
                    // virgülden sonra 1 basamak göster
                    $anapara = number_format($anapara, 1);
                    $taksitTutari = number_format($taksitTutari, 1);

                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $anapara . '</td>';
                    echo '<td>' . $faizTutari . '</td>';
                    echo '<td>' . $taksitTutari .  '</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<td colspan="3">Toplam Ödenecek Tutar</td>';
                echo '<td>' . $odenecekTutar .' TL </td>';
                echo '</tr>';
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

        }
    ?>

    <?php 
        include 'php/bodyEnd.php';
        showAlert("Bu hizmet sayesinde bankamızın verdiği kredilere önizlenim yapabilirsiniz.", "primary");
    ?>
</body>

</html>