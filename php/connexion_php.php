<?php

include_once("variables.php");
require_once("functions.php");

$ERR["username"] = is_empty("username");
$ERR["password"] = is_empty("password");

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

if(is_input_correct("password", $ERR)){
    $ERR["password"] = is_correct_password($password);
}

if (are_all_input_correct($ERR)) {

    $success = true;
}

$msg_username = $ERR_DEFINE[$ERR["username"]];
$msg_password = $ERR_DEFINE[$ERR["password"]];

$response = ["success" => $success, "msg" => ["username" => $msg_username, "password" => $msg_password]];
echo json_encode($response);