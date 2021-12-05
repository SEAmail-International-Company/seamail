<?php
require_once("php/web_class.php");

if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

$web = new Web("SEAmail - Inscription");
$web->addNavBar($theme);
$web->addSection("Formulaire de création de compte", "");

$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST">
        <div class="field">
            <label class="label">Nom d'utilisateur</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" type="text" placeholder="JeanDupond22" required autofocus>
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <label class="label">Adresse mail</label>
            <p class="control has-icons-left is-expanded has-addons">
                <input class="input" type="mail" placeholder="jean.dupond@example.com" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>       
            </p>
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            <p class="control has-icons-left is-expanded has-addons">
                <input class="input" type="password" placeholder="************" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
                <p class="help">Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial ([|-_\`"#~!@{}[]+=%*&°) et un chiffre.</p>
            </p>
        </div>
        <div class="field is-grouped is-grouped-left mt-5">
            <p class="control">
                <button class="button is-info" type="submit">
                    Inscription
                </button>
            </p>
            <p class="control">
                <a class="button is-info is-outlined" href="connexion.php">
                    Déjà membre ?
                </a>
            </p>
        </div>
    </form> 
</div>  
HTML);

echo $web->toHTML($theme);