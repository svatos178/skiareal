<?php
declare(strict_types = 1);
include_once("navbar.php");
include_once("db.php");
include_once("query.php");

$email_not_exists = "";
$wrong_password = "";

if (isset($_POST['email']) && isset($_POST['heslo'])) {

    $data = selecc("SELECT heslo from uzivatel WHERE email = ?", $_POST["email"]);
    $password  =  $_POST['heslo'];
    if (isset($data["heslo"])) {

        if (password_verify($password, $data["heslo"])) {
            $_SESSION["logged"] = $_POST["email"];

            echo '<script>window.location.href = "index.php";</script>';
        } else {
            $wrong_password = "Špatné heslo";
        }

    } else {
        $email_not_exists = "Email neexistuje";
    }
}


include_once("include/logo-banner.html");
include_once("main-pages/login.html");
include_once("include/footer.html");
?>