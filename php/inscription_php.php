<?php
require_once("variables.php");
require_once("functions.php");
date_default_timezone_set("Europe/Paris");

$ERR["username"] = is_empty("username");
$ERR["password"] = is_empty("password");
$ERR["mail"] = is_empty("mail");

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$mail = htmlspecialchars($_POST["mail"]);
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

if(is_input_correct("password", $ERR)) $ERR["password"] = is_correct_password($password);
if(is_input_correct("mail", $ERR)) $ERR["mail"] = is_correct_mail($mail);

if(is_input_correct("username", $ERR)) $ERR["username"] = is_username_available($password);
if(is_input_correct("mail", $ERR)) $ERR["mail"] = is_mail_available($mail);

if (are_all_input_correct($ERR)) {
    $score = 0;
    $rang = "user";
    $date_creation_compte = date("Y-m-d H:i:s");

    add_new_user($username, $mail, $score, $rang, $password, $date_creation_compte);
    $success = true;
}

$msg_username = $ERR_DEFINE[$ERR["username"]];
$msg_password = $ERR_DEFINE[$ERR["password"]];
$msg_mail = $ERR_DEFINE[$ERR["mail"]];

$response = ["success" => $success, "msg" => ["username" => $msg_username, "password" => $msg_password, "mail" => $msg_mail]];
echo json_encode($response);