<?php
require_once("php/web_class.php");

if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

$web = new Web("SEAmail - Connexion");
$web->addNavBar($theme);
$web->addSection("Page de connexion", "Veuillez compléter le formulaire ci-dessous pour vous connecter à votre compte SEAmail.");

$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST">
        <div class="field">
        <p class="control has-icons-left is-expanded">
            <input class="input" type="text" placeholder="Nom d'utilisateur">
            <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
            </span>
        </p>
        </div>
        <div class="field">
        <p class="control has-icons-left is-normal">
            <input class="input" type="password" placeholder="Mot de passe">
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
        </div>
        <div class="field is-grouped is-grouped-left mt-5">
            <p class="control">
                <a class="button is-info">
                Connexion
                </a>
            </p>
            <p class="control">
                <a class="button is-info is-outlined" href="inscription.php">
                Pas encore membre ?
                </a>
            </p>
        </div>
    </form> 
</div>  
HTML);

echo $web->toHTML($theme);