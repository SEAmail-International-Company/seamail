<?php
require_once("php/web_class.php");

if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

$web = new Web("SEAmail - Inscription");
$web->addNavBar($theme);
$web->addSection("Formulaire de création de compte", "");
$web->addJSlink("js/changeInputStatus.js");
$web->addJSlink("js/verifForm.js");

$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST">
        <div class="field">
            <label class="label">Nom d'utilisateur</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" type="text" name="username" id="username" placeholder="Nom d'utilisateur" autofocus>
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
                <p class="help" id="statebox_username"></p>
            </p>
        </div>
        <div class="field">
            <label class="label">Adresse mail</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" type="mail" name="mail" id="mail" placeholder="Adresse mail">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>       
                <p class="help" id="statebox_mail"></p>
            </p>
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" type="password" name="password" id="password" placeholder="Mot de passe">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
                <p class="help" id="statebox_password"></p>
                <p class="help">Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial (!@#$%^&*) et un chiffre.</p>
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

<script>
    verifForm(["username", "password", "mail"], "index.php", "php/inscription_php.php");
</script>
HTML);

echo $web->toHTML($theme);