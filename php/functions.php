<?php
require_once("connect_database.php");

function sendQuery($query){

	global $db;

	$req = $db->query($query);

	if ($req){
		return $req;
	}else{
		return false;
	}

}

function is_empty($var){
    $ERR = [];
    $ERR[$var] = !empty($_POST[$var]) ? 0 : -1;

    return $ERR[$var];
}

function is_correct_password($password){
    $ERR = [];
    $ERR["password"] = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{12,})/i", $password) ? 0 : -2;

    return $ERR["password"];
}

function is_correct_mail($mail){
    $ERR = [];
    $ERR["mail"] = filter_var($mail, FILTER_VALIDATE_EMAIL) ? 0 : -5;

    return $ERR["mail"];
}

function are_all_input_correct($array){
    if (array_sum($array) == 0) return true;
    else return false;
}

function is_input_correct($value, $array){
    if ($array[$value] == 0) return true;
    else return false;
}

function is_username_available($username){
    $username_verify = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $ERR = [];
    $ERR["username"] = $username_verify->rowCount() == 0 ? 0 : -6;

    return $ERR["username"];
}

function is_username_exist($username){
    $req = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $ERR = [];
    $ERR["username"] = $req->rowCount() != 0 ? 0 : -3;

    return $ERR["username"];
}

function setUserVar($username){
    $req = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $req = $req->fetch();

    $_SESSION["username"] = $username;
    $_SESSION["id"] = $req["id_user"];
    $_SESSION["mail"] = $req["mail"];
    $_SESSION["score"] = $req["score"];
    $_SESSION["rang"] = $req["rang"];
}

function is_password_match($username, $password){
    $req = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $req = $req->fetch();
	$password = hash("sha256", $password);

    $ERR = [];
    $ERR["password"] = ($password == $req["password"]) ? 0 : -4;

    return $ERR["password"];
}

function is_mail_available($mail){
    $req = sendQuery("SELECT * FROM users WHERE mail = '$mail'");

    $ERR = [];
    $ERR["mail"] = $req->rowCount() == 0 ? 0 : -7;

    return $ERR["mail"];
}

function add_new_user($username, $mail, $score, $rang, $password, $date_creation_compte){
    $password = hash("sha256", $password);
    sendQuery("INSERT INTO users (username, mail, score, rang, password, date_creation_compte) VALUES ('$username', '$mail', '$score', '$rang', '$password', '$date_creation_compte')");
}