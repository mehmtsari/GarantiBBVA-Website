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
  <?php
  include 'coreHTML/navbar.php';
  ?>

  <div class="container my-5">
    <div class="row ">
      <div class="row">
      <div class="col-md-8 ">
        <h1 class="text-center text-light display-4 fw-normal gradient-text">Garanti BBVA ile Piyasalar</h1>
      </div>
      </div>
      <div class="row">
        <div class="col-md-8 ">
          <div class="card mb-3 justify-content-between text-dark text-end">
            <canvas id="ExchangeChart" style="width:100%;max-width:900px"></canvas>
            <div class="card-body">
            </div>
          </div>
        </div>
        <div class="col-md-4 align-self-center h-100">
          <div class="card mb-3 ">
            <div class="card-body ">
              <h5 class="card-title gradient-text-black">Döviz Kurları (TL)</h5>
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">Döviz</th>
                    <th scope="col">Alış</th>
                    <th scope="col">Satış</th>
                  </tr>
                </thead>
                <tbody id="exchangeTBody">
                  <tr>
                    <th colspan="3" class="text-center gradient-text-black">Yükleniyor...</th>
                  </tr>
                </tbody>
              </table>
              <script>
                function updateTable(time) {
                  fetch('php/exchangeDailyAPI.php')
                    .then(response => response.json())
                    .then(data => {
                      let exchangeTBody = document.querySelector('#exchangeTBody');
                      console.log(data);
                      exchangeTBody.innerHTML = "";
                      var i = 0;
                      for (let currency in data) {

                        setTimeout(function () {
                          let row = exchangeTBody.insertRow();
                          let currencyCell = row.insertCell();
                          let buyCell = row.insertCell();
                          let sellCell = row.insertCell();
                          if (currency == "USD") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #3333FF;">' + currency + '</span>';
                          }
                          else if (currency == "EUR") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #157347;">' + currency + '</span>';
                          }
                          else if (currency == "CAD") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #FF3333;">' + currency + '</span>';
                          }
                          else if (currency == "JPY") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #212529;">' + currency + '</span>';
                          }
                          else if (currency == "GBP") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #00FFFF;">' + currency + '</span>';
                          }
                          else if (currency == "CHF") {
                            currencyCell.innerHTML = '<span class="badge" style="background-color: #FF00FF;">' + currency + '</span>';
                          }
                          buyCell.innerHTML = data[currency];
                          sellCell.innerHTML = (data[currency] * 1.1).toFixed(2);

                        }, time * i);
                        i++;
                      }

                    })
                }
                


              </script>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-20">
          <h1 class="text-center text-light display-4 fw-light gradient-text fw-medium">Garanti BBVA Hakkında</h1>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="card mb-3 h-100">
              <img
                src="https://www.garantibbva.com.tr/tr/hakkimizda/_jcr_content/root/container/productgridcontainer/productgriditemconta_359319924/card_copy_244698944/cardimage.coreimg.jpeg/1658820662143/yatirimci-iliskileri-736x480.jpeg"
                class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title fw-bolder">Yatırımcı İlişkileri</h5>
                <p class="card-text fw-bold text-dark-emphasis">1946 yılında Ankara’da kurulan Garanti BBVA, 31 Mart
                  2022 tarihi itibarıyla 953 milyar Türk lirasına ulaşan konsolide aktif büyüklüğü ile Türkiye'nin en
                  büyük ikinci özel ve en değerli bankası konumunda.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card mb-3 h-100">
              <img
                src="https://www.garantibbva.com.tr/tr/hakkimizda/_jcr_content/root/container/productgridcontainer/productgriditemconta_359319924/card_copy_1930745366/cardimage.coreimg.jpeg/1651220087948/garanti-bbvadan-haberler-736x480.jpeg"
                class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title fw-bolder">Garanti BBVA'dan Haberler</h5>
                <p class="card-text fw-bold text-dark-emphasis">Önemli gelişmeler, sunduğumuz yenilikler, başarı ve
                  ödüllerimiz ile ilgili detaylara ulaşabilir, haberleri inceleyebilirsiniz.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card mb-3 h-100">
              <img
                src="https://www.garantibbva.com.tr/tr/hakkimizda/_jcr_content/root/container/productgridcontainer/productgriditemconta_359319924/card/cardimage.coreimg.jpeg/1645457627891/genel-mudurluk.jpeg"
                class="card-img-top" alt="...">
              <div class="card-body ">
                <h5 class="card-title fw-bolder">Amacımız</h5>
                <p class="card-text fw-bold text-dark-emphasis">Amacımız, çağın olanaklarını herkese sunmak. Garanti
                  BBVA stratejisinin temel yapıtaşları, değerleri ve tüm detaylı kurumsal bilgilerine ulaşabilirisiniz.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="space-20 my-3"></div>

        <div class="row">
          <div class="col-md-6 cursor-hover hover-darken bank-info-Btn">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Banka Hakkında</h5>
                <p class="card-text">GarantiBBVA bankası hakkında bilgilere buradan ulaşabilirsiniz.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 cursor-hover hover-darken bank-credit-Btn">
            <div class="card mb-3 ">
              <div class="card-body">
                <h5 class="card-title">Banka Kredileri</h5>
                <p class="card-text">GarantiBBVA bankasının sunduğu kredilere buradan ulaşabilirsiniz.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      include 'php/bodyEnd.php';
      include 'php/exchangeHistoryAPI.php';
      if (isset($_GET['404Error'])) {
        showAlert($_GET['404Error'], "danger");
      }
      ?>
      <script>
        updateTable(100);
        showAllExchangeHistory(100);
        setInterval(updateTable, 60000);
      </script>





</body>

</html>