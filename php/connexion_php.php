<?php

require_once("functions.php");

$ERR_DEFINE = [0 => "Ce champ est correct.", -1 => "Ce champ est requis."];

$success = false;

$ERR["username"] = !empty($_POST["username"]) ? 0 : -1;
$ERR["password"] = !empty($_POST["password"]) ? 0 : -1;

if (array_count_values($ERR) == 0) $success = true;

$response = ["success" => $success, "msg_username" => $ERR_DEFINE[$ERR["username"]], "msg_password" => $ERR_DEFINE[$ERR["password"]]];
echo json_encode($response);