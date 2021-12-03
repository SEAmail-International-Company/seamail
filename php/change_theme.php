<?php
require_once("web_class.php");

if (isset($_GET["retour"])){
    $retour = htmlspecialchars($_GET["retour"]);
    $retour = explode("/", $retour);
    $url_retour = "location: ../" . $retour[count($retour) - 1];

    if(isset($_COOKIE["theme"])) {
        $theme = $_COOKIE["theme"];

        if($theme == "light") $new_theme = "dark";
        else $new_theme = "light";

        setcookie("theme", $new_theme, strtotime('+30 days'), "/", "localhost", false, false);

    } 
    else {
        $new_theme = "light";
        setcookie("theme", $new_theme, strtotime('+30 days'), "/", "localhost", false, false);
    }

    header($url_retour);
}else{
    header('location:index.php');
}