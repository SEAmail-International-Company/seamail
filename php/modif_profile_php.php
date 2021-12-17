<?php
require_once("variables.php");
require_once("functions.php");
date_default_timezone_set("Europe/Paris");

$username = htmlspecialchars($_POST['username']);
$mail = htmlspecialchars($_POST['mail']);
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($_POST['password']);
$profile_picture = "";

$ERR["username"] = !empty($username) ? 0 : -9;
if(is_input_correct("username", $ERR)) $ERR["username"] = hasChanged("username", $username, $_SESSION["id"]) ? is_username_available($username) : -8;
$ERR["password"] = !empty($password) ? is_correct_password($password) : -9;

$ERR["mail"] = !empty($mail) ? 0 : -9;

if(is_input_correct("mail", $ERR)) $ERR["mail"] = hasChanged("mail", $mail, $_SESSION["id"]) ? is_correct_mail($mail) : -8;
if(is_input_correct("mail", $ERR)) $ERR["mail"] = is_mail_available($mail);
if(is_input_correct("password", $ERR)) $ERR["password"] = hasChanged("password", $password, $_SESSION["id"]);

if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){

		switch ($_FILES['avatar']['type']) {
			case 'image/jpeg': $ext = 'jpg'; break;
            case 'image/pjpeg' : $ext = 'jpg'; break;
			case 'image/gif' : $ext = 'gif'; break;
			case 'image/png' : $ext = 'png'; break; 	
			default          : $ext = ''; break;
		}

		if ($ext != '') {
			$tailleMax = 500000;
			
			if ($_FILES['avatar']['size'] <= $tailleMax){
				$n = "../img/profiles/".$_SESSION['username'].".".$ext;
				$move = move_uploaded_file($_FILES['avatar']['tmp_name'], $n);
				
				if ($move) {
                    $profile_picture = "img/profiles/".$_SESSION['username'].".".$ext;
					$ERR["avatar"] = 0;

				}else $ERR["avatar"] = -13;
			}else $ERR["avatar"] = -12;
		}else $ERR["avatar"] = -11;
	}else $ERR["avatar"] = -10;

if (is_one_input_correct($ERR)) {
    
    updateUserProfile($username, $mail, $password, $profile_picture);
    $success = true;
}

$msg_username = $ERR_DEFINE[$ERR["username"]];
$msg_password = $ERR_DEFINE[$ERR["password"]];
$msg_mail = $ERR_DEFINE[$ERR["mail"]];
$msg_avatar = $ERR_DEFINE[$ERR["avatar"]];

$response = ["success" => $success, "msg" => ["username" => $msg_username, "password" => $msg_password, "mail" => $msg_mail, "avatar" => $msg_avatar]];
echo json_encode($response);