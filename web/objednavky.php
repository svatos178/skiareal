<?php
declare(strict_types = 1);
include_once("navbar.php");
include_once("db.php");
include_once("query.php");

$data = selecc_all("SELECT objednavka.datum, objednavka.cisloObjednavky, objednavka.castka, objednavka.casOdbaveni, objednavka.faktura from objednavka JOIN uzivatel ON uzivatel.id = objednavka.id_user WHERE uzivatel.email = ?", $_SESSION["logged"]);

var_dump($data != null);
if($data != null){
    foreach ($data as $key => $value) {
        echo $value[0], $value[1], $value[2], $value[3], $value[4];

    }
}else{

}


include_once("include/logo-banner.html");
include_once("main-pages/objednavky.html");


?>