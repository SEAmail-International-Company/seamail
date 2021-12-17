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

$username_input = new Input("input", "", "text", "username", "username", "input", "Nom d'utilisateur", "", "", true, false, true, false, true, "user", false, "", true);
$username_field = new Field("", false, false, true, "Nom d'utilisateur", [$username_input->createInput()]);

$helpbox_content_password = "Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial (!@#$%^&*) et un chiffre.";
$password_input = new Input("input", "", "password", "password", "password", "input", "Mot de passe", "", "", true, false, true, false, true, "lock", false, $helpbox_content_password, true);
$password_field = new Field("", false, false, true, "Mot de passe", [$password_input->createInput()]);

$submit_input = new Input("input", "", "submit", "connexion", "connexion", "button is-info", "Connexion");
$a_link = new Input("a", "", "", "", "", "button is-info is-outlined", "", "Pas encore membre ?", "inscription.php");
$bottom_field = new Field("", true, false, false, "", [$submit_input->createInput(), $a_link->createInput()]);

$form_obj = new Form("POST", "loginForm", [$username_field->createField(), $password_field->createField(), $bottom_field->createField()]);
$form = $form_obj->createForm();

$web->addToBody(<<<HTML
<div class="container is-fluid">
    {$form}
</div> 

<script>
    $(window).ready(function() {    
        verifForm(["username", "password"], "espace_membre.php", "php/connexion_php.php", "loginForm");
     });
</script>
HTML);

echo $web->toHTML($theme);
}