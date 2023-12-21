<?php
include 'php/db.php';
include 'php/main.php';
loginRequired();
updateUserSession();

$userjson = $_SESSION["user"];
$user = json_decode($userjson, true);
// ismi soyismi ayırma
// soyisim son boşluktan sonrası
$fullname = $user["fullName"];
$lastname = substr($fullname, strrpos($fullname, ' ') + 1);
$name = substr($fullname, 0, strrpos($fullname, ' '));
$bankAccount = getBankAccountsData($user['id']);


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
                <div class="col-md-6 rounded-4 bg-dark-subtle account-details-container">
                    <form method="POST" action="security.php?action=updateUser">
                        <div class="h-100 p-5 rounded-3">
                            <div class="row">
                                <div class="col-md-7">
                                    <h2>Kişi Bilgileri <button class="btn btn-outline-success" type="button"
                                            onclick="lockUnlockEdit()"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg></button></h2>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Ad"
                                            value="<?php echo $name; ?>" name="name" disabled>
                                        <label for="floatingInput">Ad</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Soyad"
                                            value="<?php echo $lastname; ?>" name="lastname" disabled>
                                        <label for="floatingInput">Soyad</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            placeholder="TC Kimlik No" value="<?php echo $user["tcNo"]; ?>" name="tc"
                                            disabled>
                                        <label for="floatingInput">TC Kimlik No</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Telefon"
                                            value="<?php echo $user["phoneNumber"]; ?>" name="phone" disabled>
                                        <label for="floatingInput">Telefon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div>
                                    <div class="form-floating mb-6">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="E-Mail"
                                            value="<?php echo $user["email"]; ?>" name="email" disabled>
                                        <label for="floatingInput">E-Mail</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div>
                                    <div class="form-floating mb-6">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="IBAN"
                                            value="<?php echo $user["iban"]; ?>" name="iban" disabled>
                                        <label for="floatingInput">IBAN</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success w-100 AccountSave-Btn" hidden>Kaydet</button>
                                </div>
                            </div>
                            <script>
                                function lockUnlockEdit() {
                                    const container = document.getElementsByClassName("account-details-container");
                                    const saveButton = document.getElementsByClassName("AccountSave-Btn");
                                    var phoneinput = document.getElementsByName("phone");
                                    var emailinput = document.getElementsByName("email");
                                    if (phoneinput[0].disabled == true) {
                                        phoneinput[0].disabled = false;
                                        emailinput[0].disabled = false;
                                        container[0].classList.add("bg-light-subtle");
                                        container[0].classList.remove("bg-dark-subtle");
                                        saveButton[0].hidden = false;
                                    } else {
                                        phoneinput[0].disabled = true;
                                        emailinput[0].disabled = true;
                                        container[0].classList.add("bg-dark-subtle");
                                        container[0].classList.remove("bg-light-subtle");
                                        saveButton[0].hidden = true;
                                    }
                                }
                            </script>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Hesap Bilgileri</h2>
                            </div>
                            <div class="col-md-5">
                                <a href="transfer.php" class="btn btn-success w-100">Para Transferi
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            
                            <div class="row bg-body rounded-3 p-3 mb-2 my-5">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap No</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder ">
                                        <?php echo $bankAccount[0]['accountNumber'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row bg-body rounded-3 p-2 mb-2">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap Türü</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder">
                                        <?php echo $bankAccount[0]['type'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row bg-body rounded-3 p-2 mb-2">
                                <div class="col-md-6">
                                    <p class="fw-bolder">Hesap Bakiyesi</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="fw-bolder">
                                        <?php echo number_format($bankAccount[0]['amountMoney'], 2, ',', '.'); ?>
                                        TL
                                    </p>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-md-12">
                    <h2>Hesap Geçmişi</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Tarih</th>
                                <th scope="col">İşlem</th>
                                <th scope="col">Açıklama</th>
                                <th scope="col">Tutar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $history = getBankAccountHistoryWithType($user['id']);
                            if ($history == null) {
                                echo '<tr class="text-center">';
                                echo '<td colspan="3">Hesap Geçmişi Bulunamadı</td>';
                                echo '</tr>';
                            }
                            else{
                                foreach ($history as $key => $value) {
                                    if ($value['type'] == 0){
                                        $type = 'Gelen Ödeme';
                                        $type_color = 'text-success';
                                    }
                                    else{
                                        $type = 'Giden Ödeme';
                                        $type_color = 'text-danger';
                                    }



                                    echo '<tr>';
                                    echo '<td>' . $value['dateTime'] . '</td>';
                                    echo '<td class="' . $type_color . ' fw-bolder">' . $type . '</td>';
                                    echo '<td>' . $value['description'] . '</td>';
                                    echo '<td>' . number_format($value['count'], 2, ',', '.') . ' TL</td>';
                                    echo '</tr>';
                                }
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <?php
        include 'php/bodyEnd.php';
        if (isset($_GET['404Error'])) {
            showAlert($_GET['404Error'], "danger");
        }
        ?>
</body>