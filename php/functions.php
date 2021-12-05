<?php

function is_empty($var){
    $ERR[$var] = !empty($_POST[$var]) ? 0 : -1;

    return $ERR;
}

function is_all_input_correct($array){
    if (array_sum($array) == 0) return true;
    else return false;
}