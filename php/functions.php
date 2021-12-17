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

function updateUserProfile($username, $mail, $password, $profile_picture){
    if($password != "") $password = hash("sha256", $password);
    $id = $_SESSION['id'];
    if($password != "") sendQuery("UPDATE users SET password = '$password' WHERE id_user = '$id'");
    if($username != "") sendQuery("UPDATE users SET username = '$username' WHERE id_user = '$id'");
    if($mail != "") sendQuery("UPDATE users SET mail = '$mail' WHERE id_user = '$id'");
    if($profile_picture != "") sendQuery("UPDATE users SET profile_picture = '$profile_picture' WHERE id_user = '$id'");
}

function hasChanged($var_type, $var_value, $id){
    $var_value = $var_type == "password" ? hash("sha256", $var_value) : $var_value;  
    $var_verify = sendQuery("SELECT * FROM users WHERE id_user = '$id'");
    $var_verify = $var_verify->fetch();

    $ERR = $var_verify[$var_type] == $var_value ? false : true;

    return $ERR;
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

function is_one_input_correct($array){
    $success = array_search(0, $array) != "" ? true : false;
    return $success;
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
    $_SESSION["rang"] = $req["rang"] == "user" ? "Membre" : "Administrateur";
    $_SESSION["profile_picture"] = $req["profile_picture"];
    $_SESSION["date_creation_compte"] = formatTimeStamp($req["date_creation_compte"]);
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

function add_new_user($username, $mail, $score, $rang, $password, $date_creation_compte, $profile_picture){
    $password = hash("sha256", $password);
    sendQuery("INSERT INTO users (username, profile_picture, mail, score, rang, password, date_creation_compte) VALUES ('$username', '$profile_picture', '$mail', '$score', '$rang', '$password', '$date_creation_compte')");
}

function formatDate($date){
    $annee = substr($date, 0, 4);
    $m = substr($date, 5, 2);
    $jour = substr($date, 8, 2);

    switch ($m) {
        case "01":
            $mois = "janvier";
            break;

        case "02":
            $mois = "février";
            break;

        case "03":
            $mois = "mars";
            break;
        
        case "04":
            $mois = "avril";
            break;

        case "05":
            $mois = "mai";
            break;

        case "06":
            $mois = "juin";
            break;
        
        case "07":
            $mois = "juillet";
            break;

        case "08":
            $mois = "août";
            break;

        case "09":
            $mois = "septembre";
            break;

        case "10":
            $mois = "octobre";
            break;

        case "11":
            $mois = "novembre";
            break;
            
        default:
            $mois = "décembre";
            break;
    }

    $formated_date = $jour." ".$mois." ".$annee;

    return $formated_date;
}

function formatHour($hour){
    $h = substr($hour, 0, 2);
    $m = substr($hour, 3, 2);
    $s = substr($hour, 6, 2);

    $formated_hour = $h."h ".$m."m ".$s."s";
    return $formated_hour;
}

function formatTimeStamp($timestamp){
    $timestamp_part_one = formatDate(substr($timestamp, 0, 10));
    $timestamp_part_two = formatHour(substr($timestamp, 11));
    $formated_timestamp = "le ".$timestamp_part_one." à ".$timestamp_part_two;

    return $formated_timestamp;
}

function showResumeProfile(){
    return "<div class=\"media\">
    <div class=\"media-left\">
      <figure class=\"image is-96x96\">
        <a href=\"{$_SESSION['profile_picture']}\" target='_blank' title=\"Ouvrir l'image dans un nouvel onglet\"><img src=\"{$_SESSION['profile_picture']}\" alt=\"Profile picture\" style='border-radius: 10px;'></a>
      </figure>
    </div>
    <div class=\"media-content\">
      <p class=\"title is-5\">@{$_SESSION['username']}</p>
      <p class=\"subtitle is-6\">Compte créé {$_SESSION['date_creation_compte']}</p>
    </div>
    </div>";
}