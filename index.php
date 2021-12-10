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

$web->addSection("Accueil", "Bienvenue sur la page d'accueil du site de SEAmail.");

$web->addCookieNotif($notif);
echo $web->toHTML($theme);