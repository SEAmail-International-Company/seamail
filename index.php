<?php
require_once("php/web_class.php");
require_once("php/functions.php");

if (isset($_GET["action"])){
    $action = htmlspecialchars($_GET["action"]);
    switch ($action) {
        case 'deconnexion':
            echo <<<_END
            <div class="notification is-success">
                <button class="delete"></button>
                Déconnexion réussie : vous avez été correctement déconnecté de votre compte.
            </div>
            _END;
            break;
        
        default:
            # code...
            break;
    }
}

$web = new Web("SEAmail - Accueil");
$web->addNavBar($theme);

$web->addSection("Accueil", "Bienvenue sur la page d'accueil du site de SEAmail.");

echo $web->toHTML($theme);