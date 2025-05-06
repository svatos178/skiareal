<?php
declare(strict_types = 1);
include_once("navbar.php");
include_once("db.php");
include_once("query.php");
if (!isset($_SESSION["logged"]) || !isset($_GET['cislo'])) {
    echo '<script>window.location.href = "index.php";</script>';
}

$cislo = $_GET['cislo'];

$data = selecc_all("SELECT skipass.skupina, skipass.druh
 from objednavka JOIN uzivatel ON uzivatel.id = objednavka.id_user JOIN skipass ON objednavka.id = skipass.id_objednavka WHERE uzivatel.email = ? AND skipass.id_objednavka = (SELECT objednavka.id FROM objednavka WHERE objednavka.cisloObjednavky = ?)", $_SESSION["logged"], $cislo);

$objednavka = selecc("SELECT objednavka.datum, objednavka.cisloObjednavky, objednavka.castka, objednavka.casOdbaveni, objednavka.faktura 
from objednavka WHERE objednavka.cisloObjednavky = ?", $cislo);

$skipass = [];
foreach ($data as $key => $value) {

    $arrayKey = json_encode($value);

    if (!isset($skipass[$arrayKey])) {
        $value["pocet"] = 1;
        $skipass[$arrayKey] = $value;
    } else {
        $skipass[$arrayKey]["pocet"]++;
    }
}

include_once("include/logo-banner.html");
include_once("main-pages/objednavka.html");
?>