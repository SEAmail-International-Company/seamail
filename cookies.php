<?php

$notif = "";

if (isset($_COOKIE["notification"])){
    $notification = htmlspecialchars($_COOKIE["notification"]);
    switch ($notification) {
        case 'deconnexion':
            $notif = "<div class=\"notification is-success\">
                <button class=\"delete\"></button>
                Déconnexion réussie : vous avez été correctement déconnecté de votre compte.
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
        
        default:
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
    }
}