<?php

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

function are_all_input_correct($array){
    if (array_sum($array) == 0) return true;
    else return false;
}

function is_input_correct($value, $array){
    if ($array[$value] == 0) return true;
    else return false;
}