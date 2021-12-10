<?php
require_once("php/connect_database.php");
require_once("php/functions.php");

unset($_SESSION["username"]);
unset($_SESSION["id"]);
unset($_SESSION["mail"]);
unset($_SESSION["score"]);
unset($_SESSION["rang"]);
unset($_SESSION["profile_picture"]);

session_destroy();

setcookie("notification", "deconnexion", strtotime('+30 days'), "/", "localhost", false, false);

header("Location:index.php");