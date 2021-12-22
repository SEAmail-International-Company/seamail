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

function updateUserProfile($username, $mail, $password, $profile_picture, string $rang = "", int $score = -1){
    if($password != "") $password = hash("sha256", $password);
    $id = $_SESSION['id'];
    if($password != "") sendQuery("UPDATE users SET password = '$password' WHERE id_user = '$id'");
    if($username != "") sendQuery("UPDATE users SET username = '$username' WHERE id_user = '$id'");
    if($mail != "") sendQuery("UPDATE users SET mail = '$mail' WHERE id_user = '$id'");
    if($profile_picture != "") sendQuery("UPDATE users SET profile_picture = '$profile_picture' WHERE id_user = '$id'");
    if($rang != "") sendQuery("UPDATE users SET rang = '$rang' WHERE id_user = '$id'");
    if($score != -1) sendQuery("UPDATE users SET score = '$score' WHERE id_user = '$id'");
}

function hasChanged($var_type, $var_value, $id){
    $var_value = $var_type == "password" ? hash("sha256", $var_value) : $var_value;  
    $var_verify = sendQuery("SELECT * FROM users WHERE id_user = '$id'");
    $var_verify = $var_verify->fetch();

    $ERR = $var_verify[$var_type] == $var_value ? false : true;

    return $ERR;
}

function is_empty($var) : int{
    $ERR = [];
    $ERR[$var] = !empty($_POST[$var]) ? 0 : -1;

    return $ERR[$var];
}

function is_correct_password(string $password) : int{
    $ERR = [];
    $ERR["password"] = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{12,})/i", $password) ? 0 : -2;

    return $ERR["password"];
}

function is_correct_mail(string $mail) : int{
    $ERR = [];
    $ERR["mail"] = filter_var($mail, FILTER_VALIDATE_EMAIL) ? 0 : -5;

    return $ERR["mail"];
}

function are_all_input_correct(array $array) : bool{
    if (array_sum($array) == 0) return true;
    else return false;
}

function is_one_input_correct(array $array) : bool{
    $success = array_search(0, $array) != "" ? true : false;
    return $success;
}

function is_input_correct(string $value, array $array) : bool{
    if ($array[$value] == 0) return true;
    else return false;
}

function is_username_available(string $username) : int{
    $username_verify = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $ERR = [];
    $ERR["username"] = $username_verify->rowCount() == 0 ? 0 : -6;

    return $ERR["username"];
}

function is_username_exist(string $username) : int{
    $req = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $ERR = [];
    $ERR["username"] = $req->rowCount() != 0 ? 0 : -3;

    return $ERR["username"];
}

function setUserVar(string $username) : void{
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

function is_password_match(string $username, string $password) : int{
    $req = sendQuery("SELECT * FROM users WHERE username = '$username'");

    $req = $req->fetch();
	$password = hash("sha256", $password);

    $ERR = [];
    $ERR["password"] = ($password == $req["password"]) ? 0 : -4;

    return $ERR["password"];
}

function is_mail_available(string $mail) : int{
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
        <a href=\"{$_SESSION['profile_picture']}\" target='_blank' title=\"Ouvrir l'image dans un nouvel onglet\"><img class=\"is-rounded\" src=\"{$_SESSION['profile_picture']}\" alt=\"Profile picture\"></a>
      </figure>
    </div>
    <div class=\"media-content\">
    <div class=\"tags has-addons\"><span class=\"tag is-link is-medium\">@{$_SESSION['username']}</span><span class=\"tag is-warning is-medium\">{$_SESSION['rang']}</span><span class=\"tag is-primary is-medium\">{$_SESSION['score']}</span></div>
    <div class=\"tags has-addons\"><span class=\"tag is-light is-small\">Compte créé {$_SESSION['date_creation_compte']}</span></div>
    </div>
    </div>";
}

function add_user_in_salon(string $username, int $id_salon){
    $req = sendQuery("SELECT id_user FROM users WHERE username = '$username'");
    $id_user_fetch = $req->fetch();
    $id_user = $id_user_fetch['id_user'];
    sendQuery("INSERT INTO membres_salons (id_salon, id_membre) VALUES ('$id_salon', '$id_user')");
}

function addMessage(string $picture, string $author, string $message, string $hour, string $url_pj = "", string $theme, string $id_msg) : string{
    $color = $theme == "dark" ? "dark" : "light"; 
    $type_pj =  $url_pj == "" ? "" : mime_content_type("../" . $url_pj);
     $req = sendQuery("SELECT score FROM users WHERE username = '$author'");
     $score_user_fetch = $req->fetch();
     $score_user = $score_user_fetch['score'];
    switch ($type_pj) {
        case 'image/jpeg': $ext = 1; $icon_pj = "file-image"; break;
        case 'image/pjpeg' : $ext = 1; $icon_pj = "file-image"; break;
        case 'image/gif' : $ext = 1; $icon_pj = "file-image"; break;
        case 'image/png' : $ext = 1; $icon_pj = "file-image"; break; 
        case 'image/svg+xml' : $ext = 1; $icon_pj = "file-image"; break; 
        case 'image/tiff' : $ext = 1; $icon_pj = "file-image"; break; 
        case 'image/webp' : $ext = 1; $icon_pj = "file-image"; break; 
        case 'application/msword' : $ext = 2; $icon_pj = "file-word"; break; 
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : $ext = 2; $icon_pj = "file-word"; break; 
        case 'text/html' : $ext = 2; $icon_pj = "file-code"; break; 	
        case 'image/x-icon' : $ext = 1; $icon_pj = "file-image"; break; 
        case 'application/json' : $ext = 2; $icon_pj = "file-lines"; break; 
        case 'video/mpeg' : $ext = 2; $icon_pj = "file-video"; break; 
        case 'application/pdf' : $ext = 2; $icon_pj = "file-pdf"; break; 
        case 'application/vnd.ms-powerpoint' : $ext = 2; $icon_pj = "file-powerpoint"; break;
        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation' : $ext = 2; $icon_pj = "file-powerpoint"; break;
        case 'application/vnd.ms-excel' : $ext = 2; $icon_pj = "file-excel"; break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' : $ext = 2; $icon_pj = "file-excel"; break;
        case 'application/zip' : $ext = 2; $icon_pj = "file-zipper"; break;
        case 'application/xml' : $ext = 2; $icon_pj = "file"; break;
        case 'application/x-7z-compressed' : $ext = 2; $icon_pj = "file-zipper"; break;
        default          : $ext = 0; $icon_pj = "file"; break;
    }
    $piece_jointe = $url_pj == "" ? "" : "<span class=\"tag is-{$color}\">Télécharger la pièce jointe</span><a href='$url_pj' target='_blank' download><span class=\"tag is-danger\"><span class='icon'><i class='fas fa-{$icon_pj}'></i></span></span></a><br>";
    $afficher_pj = $ext == 1 ? "<figure class='media-left'><p class='image is-96x96'><a href='{$url_pj}' target='_blank'><img src='{$url_pj}' id='publication'></a></p></figure>" : "";
    $bouton_supp = $_SESSION["rang"] == "Administrateur" || $author == $_SESSION['username'] ? "<a href='php/delete_msg.php?id={$id_msg}' class='button is-small is-danger'>Supprimer ce message</a>" : "";
    return (<<<HTML
    <article class="media">
        <figure class="media-left">
            <a href='{$picture}' target='_blank'>
                <p class="image is-64x64">
                    <img src="{$picture}" class="is-rounded">
                </p>
            </a>
        </figure>
        <div class="media-content">
            <div class="content">
                <div class="tags has-addons"><span class="tag is-{$color} is-medium"><strong>@{$author}</strong></span><span class="tag is-success is-medium">{$score_user}</span></div>
                <br>
                <blockquote>{$message}<br>
                {$afficher_pj}</blockquote>
                <p><small>
                <div class="tags has-addons"><br>
                {$piece_jointe}<span class="tag is-{$color}">Date de publication</span><span class="tag is-info">{$hour}</span></div>
                {$bouton_supp}
                </small></p>
            </div>
        </div>
    </article>
    <hr>
    HTML);
}

function updateScore(string $id_user){
    $score = $_SESSION["score"] + 1;
    sendQuery("UPDATE users SET score = '$score' WHERE id_user = '$id_user'");
    $_SESSION['score'] = $score;
}

function sendMessage($id_user, $contenu_message, $salon_name, $url_pj){
    $date_publication = date("Y-m-d H:i:s");
    do { 
        $id_pj = random_int(1, 9999);
        $req = sendQuery("SELECT * FROM piecesjointes WHERE id_piece_jointe = '$id_pj'");
        $if_id_pj_exists = $req->rowCount();
    }while($if_id_pj_exists != 0);

    $salon_req = sendQuery("SELECT id_salon FROM salons WHERE nom_salon = '$salon_name'");
    $id_salon_recup = $salon_req->fetch();
    $id_salon = $id_salon_recup["id_salon"];

    sendQuery("INSERT INTO piecesjointes (id_piece_jointe, lien_piece_jointe) VALUES ('$id_pj', '$url_pj')");

    do { 
        $id_msg = random_int(1, 9999);
        $req_msg = sendQuery("SELECT * FROM messages WHERE id_message = '$id_msg'");
        $if_id_msg_exists = $req_msg->rowCount();
    }while($if_id_msg_exists != 0);
    
    sendQuery("INSERT INTO messages (id_message, id_auteur, id_piece_jointe, contenu, date_publication) VALUES ('$id_msg', '$id_user', '$id_pj', '$contenu_message', '$date_publication')");
    sendQuery("INSERT INTO messages_salons (id_salon, id_message) VALUES ('$id_salon', '$id_msg')");

}

function delete_msg(int $id_msg, int $id_pj, bool $is_pj_exists, string $url_pj = "") : void{
    sendQuery("DELETE FROM piecesjointes WHERE id_piece_jointe = '$id_pj'");
    sendQuery("DELETE FROM messages WHERE id_message = '$id_msg'");
    sendQuery("DELETE FROM messages_salons WHERE id_message = '$id_msg'");

    if($is_pj_exists){
        @unlink("../".$url_pj);
    }
}

function is_available_nom_salon(string $nom_salon) : int{
    $req = sendQuery("SELECT * FROM salons WHERE nom_salon = '$nom_salon'");

    $ERR_nom_salon = $req->rowCount() == 0 ? 0 : -16;

    return $ERR_nom_salon;
}

function addSalon(string $id_createur, string $nom_salon, string $logo_salon) : void{
    $date_creation_salon = date("Y-m-d H:i:s");

    if($logo_salon == "") $logo_salon = "img/salons/default.png";

    do { 
        $id_salon = random_int(1, 9999);
        $req_salon = sendQuery("SELECT * FROM salons WHERE id_salon = '$id_salon'");
        $if_id_salon_exists = $req_salon->rowCount();
    }while($if_id_salon_exists != 0);

    sendQuery("INSERT INTO salons (id_salon, nom_salon, date_creation_salon, icone_salon, createur_salon) VALUES ('$id_salon', '$nom_salon', '$date_creation_salon', '$logo_salon', '$id_createur')");
    sendQuery("INSERT INTO membres_salons (id_salon, id_membre) VALUES ('$id_salon', '$id_createur')");
}

function string2url($chaine) { 
    $chaine = trim($chaine); 
    $chaine = strtr($chaine, 
   "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", 
   "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
    $chaine = strtr($chaine,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"); 
    $chaine = preg_replace('#([^.a-z0-9]+)#i', '_', $chaine); 
    $chaine = preg_replace('#-{2,}#','_',$chaine); 
    $chaine = preg_replace("# #",'_',$chaine); 
    $chaine = preg_replace('#-$#','',$chaine); 
    $chaine = preg_replace('#^-#','',$chaine); 
    return $chaine; 
   }