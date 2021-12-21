<?php

function showListSalons(){
    $username = $_SESSION['username'];
    $req = sendQuery("SELECT nom_salon FROM salons WHERE id_salon IN
                        (SELECT id_salon FROM membres_salons WHERE id_membre IN
                        (SELECT id_user FROM users WHERE username = '$username'))");

    while ($data = $req->fetch()){
        return <<<_END
        <a><i class="fas fa-comments"></i> | {$data['nom_salon']}</a>
        _END;
    }
}

function showListMessages(string $name_salon, string $theme){
    $req = sendQuery("SELECT * FROM messages WHERE id_message IN
                        (SELECT id_message FROM messages_salons WHERE id_salon IN
                        (SELECT id_salon FROM salons WHERE nom_salon = '$name_salon')) ORDER BY date_publication DESC");

    $message = "";
    while ($data = $req->fetch()){
        $id_message = $data["id_message"];
        $auteur_infos = sendQuery("SELECT * FROM users WHERE id_user IN
                        (SELECT id_auteur FROM messages WHERE id_message = '$id_message')");
        $auteur = $auteur_infos->fetch();

        $id_pj = $data["id_piece_jointe"];

        $pj_infos = sendQuery("SELECT lien_piece_jointe FROM piecesjointes WHERE id_piece_jointe = '$id_pj'");
        $pj = $pj_infos->fetch();
        $pj_url = $pj["lien_piece_jointe"];

        $message .= addMessage($auteur["profile_picture"], $auteur["username"], $data["contenu"], formatTimeStamp($data["date_publication"]), $pj_url, $theme);
    }
    return $message;
}
