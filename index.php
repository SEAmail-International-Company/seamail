<?php
require_once("php/web_class.php");
require_once("php/functions.php");
include_once("cookies.php");

$web = new Web("SEAmail - Accueil");
$web->addNavBar($theme);

$web->addSection("Accueil", "Bienvenue sur la page d'accueil du site de SEAmail.");

$web->addCookieNotif($notif);

echo $web->toHTML($theme);