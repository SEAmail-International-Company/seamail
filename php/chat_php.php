<?php
require_once("web_class.php");
require_once("functions.php");
require_once("../cookies.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){

$web = new Web("SEAmail - Espace membre");
$web->addChat("Général", $theme);

echo $web->toHTML($theme);

}else{
    setcookie("notification", "no_co", strtotime('+30 days'), "/", "localhost", false, false);
    header("location:index.php");
  }