<?php
require_once("web_class.php");
require_once("../cookies.php");
require_once("connect_database.php");
require_once("functions.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

    if (isset($_GET["id"])){

        $id_msg = htmlspecialchars($_GET["id"]);
        $id_msg = (int)$id_msg;

        if(is_int($id_msg)){
            if($id_msg >= 0 && $id_msg <= 10000){           
                $msg_infos = sendQuery("SELECT * FROM messages WHERE id_message = '$id_msg'");

                if($msg_infos->rowCount() == 1){

                    $data_msg = $msg_infos->fetch();

                    if($data_msg["id_user"] == $_SESSION["id"] || $_SESSION["rang"] == "Administrateur"){
                        
                        $id_pj = $data_msg["id_piece_jointe"];  

                        $infos_pj = sendQuery("SELECT * FROM piecesjointes WHERE id_piece_jointe = '$id_pj'");
                        $infos_pj_fetch = $infos_pj->fetch();
                        $is_pj_exists = $infos_pj_fetch["lien_piece_jointe"] != "" ? true : false;

                        delete_msg($id_msg, $id_pj, $is_pj_exists, $infos_pj_fetch["lien_piece_jointe"]);
                        setcookie("notification", "msg_supp", strtotime('+30 days'), "/", "localhost", false, false);
                        header('location:../espace_membre.php');

                    }else{
                        setcookie("notification", "interdit", strtotime('+30 days'), "/", "localhost", false, false);
                        header('location:../espace_membre.php');
                    }

                }else{
                    setcookie("notification", "interdit", strtotime('+30 days'), "/", "localhost", false, false);
                    header('location:../espace_membre.php');
                }
            }else{
                setcookie("notification", "interdit", strtotime('+30 days'), "/", "localhost", false, false);
                header('location:../espace_membre.php');
            }
        }else{
            setcookie("notification", "interdit", strtotime('+30 days'), "/", "localhost", false, false);
            header('location:../espace_membre.php');
        }
        
    }else{
        setcookie("notification", "interdit", strtotime('+30 days'), "/", "localhost", false, false);
        header('location:../espace_membre.php');
    }

}else{
  setcookie("notification", "no_co", strtotime('+30 days'), "/", "localhost", false, false);
  header("location:../index.php");
}