<?php
require_once("variables.php");
require_once("functions.php");
date_default_timezone_set("Europe/Paris");

$ERR["nom_salon"] = is_empty("nom_salon");
$ERR["logo_salon"] = -1;

$nom_salon = htmlspecialchars($_POST['nom_salon']);
if(is_input_correct("nom_salon", $ERR)) is_available_nom_salon($nom_salon);

if(isset($_FILES['logo_salon']) && !empty($_FILES['logo_salon']['name'])){

    switch ($_FILES['logo_salon']['type']) {
        case 'image/jpeg': $ext = 'jpeg'; break;
        case 'image/pjpeg' : $ext = 'jpg'; break;
        case 'image/gif' : $ext = 'gif'; break;
        case 'image/png' : $ext = 'png'; break; 
        case 'image/x-icon' : $ext = 'ico'; break;	
        case 'image/svg+xml' : $ext = 'svg'; break; 
        case 'image/tiff' : $ext = 'tiff'; break; 
        case 'image/webp' : $ext = 'webp'; break; 
        default          : $ext = ''; break;
    }

    if ($ext != '') {
        $tailleMax = 500000;
        
        if ($_FILES['logo_salon']['size'] <= $tailleMax){
            $rand_id = random_int(1000000, 9999999);
            $name_pj = $_SESSION['username'].$nom_salon.$rand_id;
            $name_pj = string2url($name_pj);
            $n = "../img/salons/".$name_pj.".".$ext;
            $move = move_uploaded_file($_FILES['logo_salon']['tmp_name'], $n);

            if ($move) {
                $logo_salon = "img/salons/".$name_pj.".".$ext;
                $ERR["logo_salon"] = 0;

            }else $ERR["logo_salon"] = -13;
        }else $ERR["logo_salon"] = -12;
    }else $ERR["logo_salon"] = -11;
}else $ERR["logo_salon"] = 0;

if (are_all_input_correct($ERR)) {

    $id_createur = $_SESSION["id"];
    $logo_salon = isset($logo_salon) ? $logo_salon : "";

    addSalon($id_createur, $nom_salon, $logo_salon);
    $success = true;
}

$msg_nom_salon = $ERR_DEFINE[$ERR["nom_salon"]];
$msg_logo_salon = $ERR_DEFINE[$ERR["logo_salon"]];

$response = ["success" => $success, "msg" => ["nom_salon" => $msg_nom_salon, "logo_salon" => $msg_logo_salon]];
echo json_encode($response);