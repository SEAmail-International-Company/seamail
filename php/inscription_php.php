<?php

require_once("functions.php");

$ERR_DEFINE = [];
$ERR = [];
$ERR_DEFINE[0] = "Ce champ est correct.";
$ERR_DEFINE[-1] = "Ce champ est requis.";
$ERR_DEFINE[-2] = "Le format requis du mot de passe n'est pas respecté.";
$ERR_DEFINE[-3] = "Ce nom d'utilisateur ne correspond à aucun compte existant.";
$ERR_DEFINE[-4] = "Ce mot de passe ne correspond pas au compte de l'utilisateur.";
$ERR_DEFINE[-5] = "L'adresse mail entrée n'est pas valide.";
$success = false;

$ERR["username"] = is_empty("username");
$ERR["password"] = is_empty("password");
$ERR["mail"] = is_empty("mail");

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$mail = htmlspecialchars($_POST["mail"]);
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

if(is_input_correct("password", $ERR)){
    $ERR["password"] = is_correct_password($password);
}

if(is_input_correct("mail", $ERR)){
    $ERR["mail"] = is_correct_mail($mail);
}

if (are_all_input_correct($ERR)) {

    $success = true;
}

$msg_username = $ERR_DEFINE[$ERR["username"]];
$msg_password = $ERR_DEFINE[$ERR["password"]];
$msg_mail = $ERR_DEFINE[$ERR["mail"]];

$response = ["success" => $success, "msg" => ["username" => $msg_username, "password" => $msg_password, "mail" => $msg_mail]];
echo json_encode($response);