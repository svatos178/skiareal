<?php
declare(strict_types=1);
include_once("navbar.php");
include_once("db.php");
include_once("query.php");

$email_exists = "";
$heslo_err = "";

if (isset($_POST['email']) && isset($_POST['heslo']) && isset($_POST['predcisli']) && isset($_POST['cislo'])) {


    $email = $_POST['email'];
    $predcisli = $_POST['predcisli'];
    $heslo = password_hash($_POST['heslo'], PASSWORD_BCRYPT);
    $cislo = $_POST['cislo'];

    $user = selecc("SELECT email FROM uzivatel WHERE email=?", $email);

    if ($user != null) {
        $email_exists = "Email již existuje";
        //header('Location: register.php#reg');
    } else {

        if (password_verify($_POST["heslo-znovu"], $heslo)) {
            insert("INSERT INTO uzivatel (email, heslo, telefon, predvolba) VALUES (?, ?, ?, ?)", $email, $heslo, $cislo, $predcisli);
            $_SESSION["logged"] = $_POST['email'];
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            $heslo_err = "Rozdílná hesla!";
            // header('Location: register.php#reg');
        }
    }
}
$db->close();

include_once("include/logo-banner.html");
include_once("main-pages/register.html");
include_once("include/footer.html");
?>