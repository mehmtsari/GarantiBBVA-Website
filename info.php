<?php
  include 'php/db.php';
  include 'php/main.php';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GarantiBBVA Hakkında</title>
    <?php 
        include 'coreHTML/core/css.html';
    ?>
</head>

<body class="bg-dark text-light">
    <?php 
        include 'coreHTML/navbar.php';
    ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="https://www.garantibbva.com.tr/tr/hakkimizda/_jcr_content/root/container/productgridcontainer/productgriditemconta_359319924/card_copy/cardimage.coreimg.jpeg/1653395046320/tarihce-736x480-.jpeg" class="img-fluid rounded" alt="GarantiBBVA">
            </div>
            <div class="col-md-6 align-self-center h-100">
                <h1 class="display-4 fw-bold gradient-text">GarantiBBVA Hakkında</h1>
                <p class="lead fw-medium">GarantiBBVA, Türkiye'nin önde gelen bankalarından biridir. 1946 yılında Ankara'da kurulmuştur.</p>
                <p class="fw-normal">GarantiBBVA, müşterilerine birçok finansal hizmet sunmaktadır, bunlar arasında kredi kartları, bireysel ve kurumsal bankacılık, yatırım hizmetleri ve sigorta yer almaktadır.</p>
            </div>
        </div>

        <hr class="my-5">

        <div class="row">
            <div class="col-md-6">
                <h2 >Vizyon ve Misyon</h2>
                <ul>
                    <li>Vizyon: Müşterilerimizin hayatını kolaylaştırmak ve finansal hedeflerine ulaşmalarına yardımcı olmak.</li>
                    <li>Misyon: Müşterilerimize en iyi hizmeti sunmak ve topluma değer katmak.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>GarantiBBVA'nın Değerleri</h2>
                <ul>
                    <li>Müşteri Odaklılık</li>
                    <li>Yenilikçilik</li>
                    <li>Çalışan Memnuniyeti</li>
                    <li>Topluma Katkı</li>
                </ul>
            </div>
        </div>

        <hr class="my-5">

        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4 fw-medium gradient-text">GarantiBBVA Tarihçesi</h1>
                    <p class="lead">GarantiBBVA, 1946 yılında Ankara'da Türkiye İş Bankası'nın bir iştiraki olarak kurulmuştur.</p>
                    <p>Banka, 1983 yılında İstanbul Menkul Kıymetler Borsası'na girmiş ve 1990 yılında halka açılmıştır. 2001 yılında BBVA ile ortaklık kurulmuş ve bankanın adı GarantiBBVA olarak değiştirilmiştir.</p>
                    <p>GarantiBBVA, Türkiye'nin önde gelen bankalarından biri olarak, müşterilerine birçok finansal hizmet sunmaktadır.</p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="row">
            <div class="col-md-12">
                <h2 class="gradient-text">GarantiBBVA Yönetim Ekibi</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Adı Soyadı</th>
                                <th>Görevi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Recep Baştuğ</td>
                                <td>Genel Müdür</td>
                            </tr>
                            <tr>
                                <td>Ebru Dildar Edin</td>
                                <td>Genel Müdür Yardımcısı</td>
                            </tr>
                            <tr>
                                <td>Ali Fuat Erbil</td>
                                <td>Genel Müdür Yardımcısı</td>
                            </tr>
                            <tr>
                                <td>Didem Dinçer Başer</td>
                                <td>Genel Müdür Yardımcısı</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="row">
            <div class="col-md-12">
                <h2 class="gradient-text">GarantiBBVA İletişim Bilgileri</h2>
                <p>Adres: Levent, Nispetiye Mahallesi, Aytar Caddesi No:2, 34340 Beşiktaş/İstanbul</p>
                <p>Telefon: 444 0 333</p>
                <p>E-posta: info@garantibbva.com.tr</p>
            </div>
        </div>

    </div>

    <?php 
        include 'php/bodyEnd.php';
    ?>
</body>

</html>