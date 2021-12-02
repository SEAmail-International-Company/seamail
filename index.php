<?php
require_once("php/web_class.php");

$web = new Web("SEAmail - Accueil");

$web->addIcon("img/logo_court_couleur.png");

$web->addNavBar();

$web->addJSlink("https://kit.fontawesome.com/602d3eba54.js");
$web->addJSlink("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");

$web->addToBody(<<<HTML

HTML);

echo $web->toHTML();