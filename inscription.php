<?php
require_once("php/web_class.php");
require_once("php/functions.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    setcookie("notification", "deja_co", strtotime('+30 days'), "/", "localhost", false, false);
    header("Location:espace_membre.php");
}else{

$web = new Web("SEAmail - Inscription");
$web->addNavBar($theme);
$web->addSection("Formulaire de création de compte", "");
$web->addJSlink("js/changeInputStatus.js");
$web->addJSlink("js/verifForm.js");
$web->addLoader($theme);

$username_input = new Input("input", "", "text", "username", "username", "input", "Nom d'utilisateur", "", "", true, false, true, false, true, "user", false, "", true);
$username_field = new Field("", false, false, true, "Nom d'utilisateur", [$username_input->createInput()]);

$mail_input = new Input("input", "", "mail", "mail", "mail", "input", "Adresse mail", "", "", true, false, true, false, true, "envelope", false, "", true);
$mail_field = new Field("", false, false, true, "Adresse mail", [$mail_input->createInput()]);

$helpbox_content_password = "Doit contenir plus de 12 caractères parmis lesquels au moins une majuscule, une minuscule, un caractère spécial (!@#$%^&*) et un chiffre.";
$password_input = new Input("input", "", "password", "password", "password", "input", "Mot de passe", "", "", true, false, true, false, true, "lock", false, $helpbox_content_password, true);
$password_field = new Field("", false, false, true, "Mot de passe", [$password_input->createInput()]);

$submit_input = new Input("input", "", "submit", "inscription", "inscription", "button is-info", "Inscription");
$a_link = new Input("a", "", "", "", "", "button is-info is-outlined", "", "Déjà membre ?", "connexion.php");
$bottom_field = new Field("", true, false, false, "", [$submit_input->createInput(), $a_link->createInput()]);

$form_obj = new Form("POST", "registerForm", [$username_field->createField(), $mail_field->createField(), $password_field->createField(), $bottom_field->createField()]);
$form = $form_obj->createForm();

$web->addToBody(<<<HTML
<div class="container is-fluid">
    {$form}
</div>  

<script>
    $(window).ready(function() {        
        verifForm(["username", "password", "mail"], "connexion.php", "php/inscription_php.php", "registerForm");
     });
</script>
HTML);

echo $web->toHTML($theme);
}