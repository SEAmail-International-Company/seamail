<?php
require_once("php/web_class.php");
require_once("php/functions.php");

if(!isset($_COOKIE["banniere"])) {
    $_COOKIE["notification"] = "cookie_ban";
    setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
    setcookie("banniere", "true", strtotime('+30 days'), "/", "localhost", false, false);
}

require_once("cookies.php");

$web = new Web("SEAmail - Accueil");
$web->addNavBar($theme);

$web->addSection("Accueil", "<strong>Bienvenue sur la page d'accueil du site de SEAmail®.<br><br>SEAmail® c'est SEAsimple, SEAmail® c'est SEAcurisé !</strong><br><br><br><br><a class='button is-medium is-primary' href='inscription.php'>Je me jette à l'eau !</a>");

$web->addToBody(<<<HTML

<style>
    body{
        min-height: 100vh;
        background: url("img/ocean_3.jpg");
        background-size: cover;
    }
</style>

HTML);

$web->addCookieNotif($notif);
echo $web->toHTML($theme);