<?php
require_once("php/web_class.php");

if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

$web = new Web("SEAmail - Accueil");
$web->addNavBar($theme);

$web->addSection("Accueil", "Bienvenue sur la page d'accueil du site de SEAmail.");

echo $web->toHTML($theme);