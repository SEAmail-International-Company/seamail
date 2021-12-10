<?php

$notif = "";

if (isset($_COOKIE["notification"])){
    $notification = htmlspecialchars($_COOKIE["notification"]);
    switch ($notification) {
        case 'deconnexion':
            $notif = "<div class=\"notification is-success\">
                <button class=\"delete\"></button>
                <strong>Déconnexion réussie</strong><br> Vous avez été correctement déconnecté de votre compte.
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
            
        case 'inscription':
                $notif = "<div class=\"notification is-success\">
                    <button class=\"delete\"></button>
                    <strong>Inscription réussie</strong><br> Votre compte a été créé avec succès.
                </div>";
                setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
                break;

        case 'cookie_ban':
            $notif = "<div class=\"notification is-info\">
                    <button class=\"delete\"></button>
                    <strong>🍪 Information cookies</strong><br> En naviguant sur ce site, vous acceptez l'utilisation de cookies utilisés uniquement à des fins fonctionnelles.
                </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;

        default:
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
    }
}