<?php
require_once("variables.php");
require_once("functions.php");
date_default_timezone_set("Europe/Paris");

$ERR["nom_salon"] = is_empty("nom_salon");
$ERR["logo_salon"] = -1;

$nom_salon = htmlspecialchars($_POST['nom_salon']);

$msg_nom_salon = $ERR_DEFINE[$ERR["nom_salon"]];
$msg_logo_salon = $ERR_DEFINE[$ERR["logo_salon"]];

$response = ["success" => $success, "msg" => ["nom_salon" => $msg_nom_salon, "logo_salon" => $msg_logo_salon]];
echo json_encode($response);