<?php
require_once("php/web_class.php");
require_once("php/functions.php");
require_once("cookies.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    setcookie("notification", "deja_co", strtotime('+30 days'), "/", "localhost", false, false);
    header("Location:espace_membre.php");
}else{

$web = new Web("SEAmail - Connexion");
$web->addNavBar($theme);
$web->addSection("Formulaire de connexion", "Veuillez compléter le formulaire ci-dessous pour vous connecter à votre compte SEAmail.");
$web->addJSlink("js/changeInputStatus.js");
$web->addJSlink("js/verifForm.js");
$web->addLoader($theme);
$web->addCookieNotif($notif);

$username_input = new Input();
$username_input->setBalise("input");
$username_input->setClass("input");
$username_input->setName("username");
$username_input->setId("username");
$username_input->setType("username");
$username_input->setPlaceholder("Nom d'utilisateur");
$username_input->setAutofocus(true);
$username_input->setHasIconsLeft(true);
$username_input->setIsExpanded(true);
$username_input->setIconLeft("user");
$username_input->setHasHelpbox(true);
$username = $username_input->createInput();

$password_input = new Input();
$password_input->setBalise("input");
$password_input->setClass("input");
$password_input->setName("password");
$password_input->setId("password");
$password_input->setType("password");
$password_input->setPlaceholder("Mot de passe");
$password_input->setHasIconsLeft(true);
$password_input->setIsExpanded(true);
$password_input->setIconLeft("lock");
$password_input->setHasHelpbox(true);
$password_input->setHelpboxContent("Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial (!@#$%^&*) et un chiffre.");
$password = $password_input->createInput();

$submit_input = new Input("input", "", "submit", "connexion", "connexion", "button is-info", "Connexion");

$a_link = new Input("a", "", "", "", "", "button is-info is-outlined", "", "Pas encore membre ?", "inscription.php");

$bottom_field = new Field("", true, false, false, "", [$submit_input->createInput(), $a_link->createInput()]);
$bottom = $bottom_field->createField();

$web->addToBody(<<<HTML
<div class="container is-fluid">
    <form method="POST" id="loginForm">
        <div class="field">
            <label class="label">Nom d'utilisateur</label>
            {$username}
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            {$password}
        </div>
         {$bottom}
    </form> 
</div> 

<script>
    $(window).ready(function() {    
        verifForm(["username", "password"], "espace_membre.php", "php/connexion_php.php");
     });
</script>
HTML);

echo $web->toHTML($theme);
}