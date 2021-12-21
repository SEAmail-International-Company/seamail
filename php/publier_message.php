<?php
require_once("variables.php");
require_once("functions.php");
date_default_timezone_set("Europe/Paris");

$ERR["message"] = is_empty("message");
$ERR["pj"] = -1;

$message = htmlspecialchars($_POST["message"]);

if(isset($_FILES['piece_jointe_message']) && !empty($_FILES['piece_jointe_message']['name'])){

    switch ($_FILES['piece_jointe_message']['type']) {
        case 'image/jpeg': $ext = 'jpg'; break;
        case 'image/pjpeg' : $ext = 'jpg'; break;
        case 'image/gif' : $ext = 'gif'; break;
        case 'image/png' : $ext = 'png'; break; 
        case 'image/svg+xml' : $ext = 'svg'; break; 
        case 'image/tiff' : $ext = 'tiff'; break; 
        case 'image/webp' : $ext = 'webp'; break; 
        case 'application/msword' : $ext = 'doc'; break; 
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : $ext = 'docx'; break; 
        case 'text/html' : $ext = 'html'; break; 	
        case 'image/x-icon' : $ext = 'ico'; break; 
        case 'application/json' : $ext = 'json'; break; 
        case 'video/mpeg' : $ext = 'mpeg'; break; 
        case 'application/pdf' : $ext = 'pdf'; break; 
        case 'application/vnd.ms-powerpoint' : $ext = 'ppt'; break;
        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation' : $ext = 'pptx'; break;
        case 'application/vnd.ms-excel' : $ext = 'xls'; break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' : $ext = 'xlsx'; break;
        case 'application/zip' : $ext = 'zip'; break;
        case 'application/xml' : $ext = 'xml'; break;
        case 'application/x-7z-compressed' : $ext = '7z'; break;
        default          : $ext = ''; break;
    }

    if ($ext != '') {
        $tailleMax = 50000000;
        
        if ($_FILES['piece_jointe_message']['size'] <= $tailleMax){
            $rand_id = random_int(1000000, 9999999);
            $n = "../piecesjointes/".$_SESSION['username'].$rand_id.".".$ext;
            $move = move_uploaded_file($_FILES['piece_jointe_message']['tmp_name'], $n);
            
            if ($move) {
                $url_pj = "piecesjointes/".$_SESSION['username'].$rand_id.".".$ext;
                $ERR["pj"] = 0;

            }else $ERR["pj"] = -13;
        }else $ERR["pj"] = -12;
    }else $ERR["pj"] = -11;
}else $ERR["pj"] = 0;

if (are_all_input_correct($ERR)) {

    $id_user = $_SESSION["id"];
    $salon_name = $_SESSION["salon"];
    $url_pj = isset($url_pj) ? $url_pj : "";

    sendMessage($id_user, $message, $salon_name, $url_pj);
    updateScore($id_user);
    $success = true;
}

$msg_pj = $ERR_DEFINE[$ERR["pj"]];
$msg_message = $ERR_DEFINE[$ERR["message"]];

$response = ["success" => $success, "msg" => ["pj" => $msg_pj, "message" => $msg_message]];
echo json_encode($response);