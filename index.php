<?php
require_once("php/web.class.php");

$web = new Web("E-commerce");

$web->addCSSlink("css/style.css");
$web->addIcon("https://samsam.go.yo.fr/avatar.png");

echo $web->toHTML();