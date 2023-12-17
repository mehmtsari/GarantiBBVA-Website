

<div class="container">
    <header data-type="navbar"
      class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="https://sube.assets.garantibbva.com.tr/assets/img/logo-garantibbva.png" alt="">
        </a>
      </div>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 ">

        <li><a href="advancePayment.php" class="nav-link px-3 text-success">Avans</a></li>
        <li><a href="credit.php" class="nav-link px-3 text-success">Kredi</a></li>
        <li><a href="info.php" class="nav-link px-3 text-success">Hakkımızda</a></li>
        <li><a href="services.php" class="nav-link px-3 text-success">Hizmetlerimiz</a></li>
      </ul>
      <div class="card justify-content-center text-center bg-light " style="width: 220px; height:40px;">
        <div class="card-body">
          <span class="fw-bolder text-dark h-100 w-100 gradient-text-black-double" id="navExchangeBox"></span>
        </div>
      </div>
      <div class="col-md-3 text-end">
        <?php 
        if (isset($_SESSION["user"])) {
          echo '<a type="button" href="account.php" class="btn btn-outline-success me-2">Hesap Bilgilerim</a>';
          echo '<a type="button" href="php/main.php?logout=true" class="btn btn-outline-danger me-2">Çıkış Yap</a>';
        } else {
          echo '<a type="button" href="register.php" class="btn btn-success me-2">Müşteri Ol</a>';
          echo '<a type="button" href="login.php" class="btn btn-outline-success">Giriş Yap</a>';
        }
        ?>
      </div>
    </header>
    <div class="alert fw-bolder alert-dismissible fade show alert-success topAlert" role="alert" style="display: none;">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="me-3">
            <i class="bi bi-check-circle-fill me-2"></i>
            <span class="alert-message">İşlem başarılı</span>
          </div>
          <button type="button" class="btn-close alertBtn" aria-label="Close" onclick="document.querySelector('.alert').style.display = 'none';"></button>
        </div>
      </div>
</div>