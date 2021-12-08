<?php
require_once("php/web_class.php");
require_once("php/functions.php");

$web = new Web("SEAmail - Connexion");
$web->addNavBar($theme);
$web->addSection("Formulaire de connexion", "Veuillez compléter le formulaire ci-dessous pour vous connecter à votre compte SEAmail.");
$web->addJSlink("js/changeInputStatus.js");
$web->addJSlink("js/verifForm.js");

$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST" id="loginForm">
        <div class="field">
            <label class="label">Nom d'utilisateur</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" name="username" id="username" type="text" placeholder="Nom d'utilisateur" autofocus>
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
                <p class="help" id="statebox_username"></p>
            </p>
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            <p class="control has-icons-left is-expanded">
                <input class="input" id="password" name="password" type="password" placeholder="Mot de passe">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
                <p class="help" id="statebox_password"></p>
                <p class="help">Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial (!@#$%^&*) et un chiffre.</p>
            </p>
        </div>
        <div class="field is-grouped is-grouped-left mt-5">
            <p class="control">
                <input class="button is-info" type="submit" value="Connexion">
            </p>
            <p class="control">
                <a class="button is-info is-outlined" href="inscription.php">
                Pas encore membre ?
                </a>
            </p>
        </div>
    </form> 
</div> 

<script>
    verifForm(["username", "password"], "index.php", "php/connexion_php.php");
</script>
HTML);

echo $web->toHTML($theme);