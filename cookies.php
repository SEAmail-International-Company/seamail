<?php

$notif = "";

if (isset($_COOKIE["notification"])){
    $notification = htmlspecialchars($_COOKIE["notification"]);
    switch ($notification) {
        case 'connexion':
            $notif = "<div class=\"notification is-success\">
                <button class=\"delete\"></button>
                <strong>Connexion réussie</strong><br> Vous avez été correctement connecté à votre compte {$_SESSION['username']}.
                <progress class=\"progress is-small is-success loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
        
        case 'interdit':
            $notif = "<div class=\"notification is-danger\">
                <button class=\"delete\"></button>
                <strong>Accès interdit</strong><br> L'accès direct à cette page est strictement interdit pour des raisons de sécurité.
                <progress class=\"progress is-small is-danger loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
        
        case 'change_theme':
            $notif = "<div class=\"notification is-info\">
                <button class=\"delete\"></button>
                <strong>Changement de thème réussi</strong><br> Le thème a correctement été réglé sur {$theme}.
                <progress class=\"progress is-small is-info loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;

        case 'msg_supp':
                $notif = "<div class=\"notification is-info\">
                    <button class=\"delete\"></button>
                    <strong>Message supprimé avec succès</strong><br> Le message a correctement été supprimé.
                    <progress class=\"progress is-small is-info loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
                </div>";
                setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
                break;

        case 'deconnexion':
            $notif = "<div class=\"notification is-success\">
                <button class=\"delete\"></button>
                <strong>Déconnexion réussie</strong><br> Vous avez été correctement déconnecté de votre compte.
                <progress class=\"progress is-small is-success loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
            </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
            
        case 'inscription':
                $notif = "<div class=\"notification is-success\">
                    <button class=\"delete\"></button>
                    <strong>Inscription réussie</strong><br> Votre compte a été créé avec succès.
                    <progress class=\"progress is-small is-success loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
                </div>";
                setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
                break;

        case 'deja_co':
                $notif = "<div class=\"notification is-warning\">
                    <button class=\"delete\"></button>
                    <strong>Accès impossible</strong><br> Vous êtes déjà connecté à votre compte ! Pour continuer, veuillez vous déconnecter.
                    <progress class=\"progress is-small is-warning loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
                </div>";
                setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
                break;

        case 'no_co':
                $notif = "<div class=\"notification is-danger\">
                    <button class=\"delete\"></button>
                    <strong>Accès restreint</strong><br> Vous devez être connecté pour accéder à cette page.
                    <progress class=\"progress is-small is-danger loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
                </div>";
                setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
                break;

        case 'cookie_ban':
            $notif = "<div class=\"notification is-info\">
                    <button class=\"delete\"></button>
                    <strong>🍪 Information cookies</strong><br> En naviguant sur ce site, vous acceptez l'utilisation de cookies utilisés uniquement à des fins fonctionnelles.
                    <progress class=\"progress is-small is-info loading_notif\" value=\"0\" max=\"100\" style=\"position: absolute; bottom: 0; left: 2; height: 7px;\"></progress>
                </div>";
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;

        default:
            setcookie("notification", "", strtotime('-30 days'), "/", "localhost", false, false);
            break;
    }
}