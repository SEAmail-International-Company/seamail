<?php

function showListSalons(){
    $username = $_SESSION['username'];
    $req = sendQuery("SELECT * FROM salons WHERE id_salon IN
                        (SELECT id_salon FROM membres_salons WHERE id_membre IN
                        (SELECT id_user FROM users WHERE username = '$username'))");
    $salons_liste = "";
    while ($data = $req->fetch()){
        $icone_salon = $data['icone_salon'];
        if($data['nom_salon'] == "Général"){
            $salons_liste .= "<a id='{$data['nom_salon']}'><img src='{$icone_salon}' width='20' height='20'> | {$data['nom_salon']}</a>";
        }else{
            $salons_liste .= "<a id='{$data['nom_salon']}' disabled><img src='{$icone_salon}' width='20' height='20'> | {$data['nom_salon']} &nbsp;&nbsp;<div class='tag is-primary'>Disponible prochainement</div></a>";
        }
        
    }

    return $salons_liste;
}

function showListMessages(string $name_salon, string $theme){
    $req = sendQuery("SELECT * FROM messages WHERE id_message IN
                        (SELECT id_message FROM messages_salons WHERE id_salon IN
                        (SELECT id_salon FROM salons WHERE nom_salon = '$name_salon')) ORDER BY date_publication DESC");

    $message = "";
    $nb_msg = 0;
    while ($data = $req->fetch()){
        $id_message = $data["id_message"];
        $auteur_infos = sendQuery("SELECT * FROM users WHERE id_user IN
                        (SELECT id_auteur FROM messages WHERE id_message = '$id_message')");
        $auteur = $auteur_infos->fetch();

        $id_pj = $data["id_piece_jointe"];

        $pj_infos = sendQuery("SELECT lien_piece_jointe FROM piecesjointes WHERE id_piece_jointe = '$id_pj'");
        $pj = $pj_infos->fetch();
        $pj_url = $pj["lien_piece_jointe"];

        $message .= addMessage($auteur["profile_picture"], $auteur["username"], $data["contenu"], formatTimeStamp($data["date_publication"]), $pj_url, $theme, $id_message);
        $nb_msg++;
    }

    if($nb_msg == 0){
        $message = "Aucun message n'a été envoyé pour le moment.<br>Sois le premier à briser la glace !";
    }

    $req_users_in_salon = sendQuery("SELECT * FROM membres_salons WHERE id_salon IN 
                                    (SELECT id_salon FROM salons WHERE nom_salon = '$name_salon')");
    
    $nb_users = $req_users_in_salon->rowCount();

    $users_list = "<ul>";

    while ($data_users = $req_users_in_salon->fetch()){
        $id_user = $data_users["id_membre"];
        $auteur_infos = sendQuery("SELECT * FROM users WHERE id_user = '$id_user'");
        $auteur = $auteur_infos->fetch();

        $users_list .= "<li>". $auteur["username"] ."</li>";
    }

    $users_list .= "</ul>";

    return [$message, $nb_msg, $nb_users, $users_list];
}
