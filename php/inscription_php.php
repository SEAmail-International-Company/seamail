<?php

include_once("variables.php");
require_once("functions.php");

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