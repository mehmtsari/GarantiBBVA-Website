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


    <div class="row w-100">
        <div class="col-md-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary sidebar bg-secondary-subtle"
                style="width: 280px;">
                <a href="home.php"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4 text-success-emphasis">GarantiBBVA Admin Panel</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="?page=Users" class="nav-link link-body-emphasis" name="users">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#speedometer2"></use>
                            </svg>
                            Üyeler
                        </a>
                    </li>
                    <li>
                        <a href="?page=Transfers" class="nav-link link-body-emphasis" name="transfers">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#table"></use>
                            </svg>
                            Para Transferleri
                        </a>
                    </li>
                    <li>
                        <a href="?page=Advances" class="nav-link link-body-emphasis" name="advances">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#grid"></use>
                            </svg>
                            Avans İstekleri
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="container">

                    <div class="row">
                        <div class="col-6 fw-bolder text-white">Mehmet Sarı</div>
                        <button type="button" class="btn btn-outline-danger col-6"
                            onclick="window.location.href='php/main.php?logout=true'">Çıkış Yap</button>
                    </div>
                </div>
            </div>
            <script>
                var sidebar = document.querySelector(".sidebar");
                sidebar.style.height = window.innerHeight + "px";

            </script>
        </div>

        <div class="col-md-9">
            <!--kullanıcıları listeleme-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="display-4">
                            <?php
                            if (isset($_GET['page'])) {
                                if ($_GET['page'] == "Users") {
                                    echo "Üyeler";
                                }
                                if ($_GET['page'] == "Transfers") {
                                    echo "Para Transferleri";
                                }
                                if ($_GET['page'] == "Advances") {
                                    echo "Avans İstekleri";
                                }
                            }
                            ?>
                        </h1>
                        <hr class="my-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <?php
                                    if (isset($_GET['page'])) {
                                        if ($_GET['page'] == "Users") {
                                            echo '<tr>';
                                            echo '<th>TC Kimlik Numarası</th>';
                                            echo '<th>İsim Soyisim</th>';
                                            echo '<th>E-mail</th>';
                                            echo '<th>Telefon Numarası</th>';
                                            echo '<th></th>';
                                            echo '</tr>';
                                        } elseif ($_GET['page'] == "Transfers") {
                                            echo '<tr>';
                                            echo '<th>Transfer Yapan</th>';
                                            echo '<th>Transfer Alan</th>';
                                            echo '<th>Transfer Tarihi</th>';
                                            echo '<th>Transfer Tutarı</th>';
                                            echo '<th>Transfer Açıklaması</th>';
                                            echo '<th></th>';
                                            echo '</tr>';
                                        } elseif ($_GET['page'] == "Advances") {
                                            echo '<tr>';
                                            echo '<th>Avans Alan</th>';
                                            echo '<th>Avans Tarihi</th>';
                                            echo '<th>Avans Tutarı</th>';
                                            echo '<th></th>';
                                            echo '</tr>';
                                        }

                                    }
                                    ?>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['page'])) {
                                        if ($_GET['page'] == "Users") {
                                            $users = getAllUsers();
                                            if ($users == null) {
                                                echo '<tr>';
                                                echo '<td colspan="5" class="text-center">Kullanıcı Bulunmamaktadır.</td>';
                                                echo '</tr>';
                                            } else {
                                                foreach ($users as $key => $value) {
                                                    echo '<tr>';
                                                    echo '<td>' . $value["tcNo"] . '</td>';
                                                    echo '<td>' . $value["fullName"] . '</td>';
                                                    echo '<td>' . $value["email"] . '</td>';
                                                    echo '<td>' . $value["phoneNumber"] . '</td>';
                                                    echo '<td><button type="button" class="btn btn-outline-danger col-12"
                                            onclick="window.location.href=\'php/main.php?deleteUser=true&id=' . $value["id"] . '\'">Sil</button></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        } elseif ($_GET['page'] == "Transfers") {
                                            $transfers = getAllTransfers();
                                            if ($transfers == null) {
                                                echo '<tr>';
                                                echo '<td colspan="6" class="text-center">Transfer Bulunmamaktadır.</td>';
                                                echo '</tr>';
                                            } else {
                                                foreach ($transfers as $key => $value) {
                                                    echo '<tr>';
                                                    echo '<td>' . $value["senderName"] . '</td>';
                                                    echo '<td>' . $value["receiverName"] . '</td>';
                                                    echo '<td>' . $value["dateTime"] . '</td>';
                                                    echo '<td>' . $value["count"] . '</td>';
                                                    echo '<td>' . $value["description"] . '</td>';
                                                    echo '<td><button type="button" class="btn btn-outline-danger col-12" onclick="window.location.href=\'php/main.php?deleteTransfer=true&id=' . $value["id"] . '\'">Sil</button></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        } elseif ($_GET['page'] == "Advances") {
                                            $advances = getAllAdvances();
                                            if ($advances == null) {
                                                echo '<tr>';
                                                echo '<td colspan="4" class="text-center">Onay Bekleyen Avans Bulunmamaktadır.</td>';
                                                echo '</tr>';
                                            } else {
                                                foreach ($advances as $key => $value) {
                                                    echo '<tr>';
                                                    echo '<td>' . $value["fullName"] . '</td>';
                                                    echo '<td>' . $value["dateTime"] . '</td>';
                                                    echo '<td>' . $value["count"] . '</td>';
                                                    echo '<td><button type="button" class="btn btn-outline-success col-12" onclick="window.location.href=\'php/main.php?acceptAdvance=true&id=' . $value["id"] . '\'">Onayla</button></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</body>