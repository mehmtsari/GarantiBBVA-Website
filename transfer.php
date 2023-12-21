<?php
include 'php/db.php';
include 'php/main.php';

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

    <div class="container col-md-10">
        <div
            class="p-5 mb-4 bg-body-tertiary rounded-3 align-items-center justify-content-center d-flex transfer-container">
            <h1 class="display-4 p-5">Para Transferi <button class="btn btn-outline-primary back-btn"
                    onclick="window.location.href='transfer.php'" hidden>Geri Dön<svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path
                            d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                    </svg></button></h1>

            <hr class="my-4">
            <div id="transferMethod">
                <h4>Transfer yapmak istediğiniz yöntemi seçin:</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="transferMethod" id="ibanMethod" value="iban">
                    <label class="form-check-label" for="ibanMethod">
                        İbana Göre Transfer
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="transferMethod" id="nameMethod" value="name">
                    <label class="form-check-label" for="nameMethod">
                        İsme Göre Transfer
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="transferMethod" id="accountMethod"
                        value="account">
                    <label class="form-check-label" for="accountMethod">
                        Hesap Numarasına Göre Transfer
                    </label>
                </div>
            </div>
            <form class="form-floating mb-3 ActionForm" method="POST" action="security.php?action=transfer&method=0"
                hidden>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control nameInput" id="floatingInput" placeholder="IBAN" name="IBAN" required>
                    <label for="floatingInput" class="nameLabel">IBAN</label>
                </div>
                <div class="form-floating mb-3">
                    <div class="input-group mb-3">
                        
                        <input type="number" class="form-control amount" id="floatingInput"
                             placeholder="Tutar" name="count" required>
                        <span class="input-group-text fw-bolder">TL</span>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Açıklama" name="desc" required>
                    <label for="floatingInput">Açıklama</label>
                </div>
                <button type="submit" id="confirmButton" class="btn btn-success mx-auto"
                    style="width: 400px;">Onayla<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z">
                        </path>
                    </svg></button>
                <script>
                    var amount = document.querySelector(".amount");
                    // amount değeri float olarak gözükmeli bu yüzden imleç alandan çıktığında formatlanmalı (virgül kullanılmalı nokta değil bu kontrol edilmeli)
                    amount.addEventListener("blur", function () {
                        amount.value = parseFloat(amount.value).toFixed(2);
                        if (amount.value == "NaN") {
                            amount.value = "";
                        }
                        // input alanının number olduğunu unutmadan . yı virgül yap 
                        
                    });


                </script>
            </form>



        </div>
    </div>

    <?php
    include 'php/bodyEnd.php';
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector(".ActionForm");
            const nameInput = document.querySelector(".nameInput");
            const nameLabel = document.querySelector(".nameLabel");
            const backButton = document.querySelector(".back-btn");

            const ibanMethod = document.getElementById("ibanMethod");
            const nameMethod = document.getElementById("nameMethod");
            const accountMethod = document.getElementById("accountMethod");
            const method_selection = document.getElementById("transferMethod");

            ibanMethod.addEventListener("change", function () {
                if (ibanMethod.checked) {
                    nameInput.setAttribute("placeholder", "Iban");
                    nameLabel.innerHTML = "IBAN";
                    nameLabel.setAttribute("name","iban")
                    form.setAttribute("action", "security.php?action=transfer&method=0");
                    method_selection.setAttribute("hidden", "");
                    form.removeAttribute("hidden");
                    backButton.removeAttribute("hidden");
                }
            });

            nameMethod.addEventListener("change", function () {
                if (nameMethod.checked) {
                    nameInput.setAttribute("placeholder", "İsim Soyisim");
                    nameLabel.innerHTML = "İsim Soyisim";
                    nameLabel.setAttribute("name" , "nameSurname")
                    form.setAttribute("action", "security.php?action=transfer&method=1");
                    method_selection.setAttribute("hidden", "");
                    form.removeAttribute("hidden");
                    backButton.removeAttribute("hidden");
                }
            });

            accountMethod.addEventListener("change", function () {
                if (accountMethod.checked) {

                    nameInput.setAttribute("placeholder", "Hesap Numarası");
                    nameLabel.innerHTML = "Hesap Numarası";
                    nameLabel.setAttribute("name","accountNumber")
                    form.setAttribute("action", "security.php?action=transfer&method=2");
                    method_selection.setAttribute("hidden", "");
                    form.removeAttribute("hidden");
                    backButton.removeAttribute("hidden");
                }
            });
        });
    </script>
</body>

</html>