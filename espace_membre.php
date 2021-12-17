<?php
require_once("php/web_class.php");
require_once("php/functions.php");
require_once("cookies.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){

$web = new Web("SEAmail - Espace membre");
$web->addMenuLeft($theme);

$web->addCookieNotif($notif);
$web->addJSlink("js/espace_membre.js");
$web->addJSlink("js/changeInputStatus.js");
$web->addJSlink("js/verifForm.js");
$web->addJSlink("js/updateInputFile.js");
$web->addChat();

$profile_picture = showResumeProfile();

$avatar_input = new Input("input", "", "file", "avatar", "avatar", "input", "", $_SESSION['profile_picture'], "", true, false, true, false, true, "file", false, "", true, "", ".png, .jpg, .jpeg, .gif");
$avatar_field = new Field("", false, false, true, "Photo de profil (5Mo max. / .png, .jpg et .gif uniquement)", [$avatar_input->createInput()]);

$username_input = new Input("input", "", "text", "username", "username", "input", "Nom d'utilisateur", $_SESSION['username'], "", true, false, true, false, true, "user", false, "", true);
$username_field = new Field("", false, false, true, "Nom d'utilisateur", [$username_input->createInput()]);

$mail_input = new Input("input", "", "mail", "mail", "mail", "input", "Adresse mail", $_SESSION['mail'], "", true, false, true, false, true, "envelope", false, "", true);
$mail_field = new Field("", false, false, true, "Adresse mail", [$mail_input->createInput()]);

$password_input = new Input("input", "", "password", "password", "password", "input", "Mot de passe", "", "", true, false, true, false, true, "lock", false, "", true);
$password_field = new Field("", false, false, true, "Mot de passe", [$password_input->createInput()]);

$rang_input = new Input("input", "", "text", "rang", "rang", "input", "Rang", $_SESSION['rang'], "", true, true, true, true, true, "hat-wizard", false, "", true);
$rang_field = new Field("", false, false, true, "Rang", [$rang_input->createInput()]);

$score_input = new Input("input", "", "text", "score", "score", "input", "Score", $_SESSION['score'], "", true, true, true, true, true, "trophy", false, "", true);
$score_field = new Field("", false, false, true, "Score", [$score_input->createInput()]);

$submit_input = new Input("input", "", "submit", "modifier", "modifier", "button is-dark", "", "Modifier");
$close_input = new Input("input", "", "button", "fermer_modif", "fermer_modif", "button is-light close_modal_modif_account", "", "Fermer");
$bottom_field = new Field("", true, false, false, "", [$submit_input->createInput(), $close_input->createInput()]);

$form_obj = new Form("POST", "modifAccountForm", [$avatar_field->createField(), $username_field->createField(), $mail_field->createField(), $password_field->createField(), $rang_field->createField(), $score_field->createField(), $bottom_field->createField()], true);
$form = $form_obj->createForm();
$web->addModal("Modifier mon compte", $profile_picture.$form, "modal_modif_account");


$logo_salon_input = new Input("input", "", "file", "logo_salon", "logo_salon", "input", "", "", "", true, false, true, false, true, "file", false, "", true, "", ".png, .jpg, .jpeg, .gif");
$logo_salon_field = new Field("", false, false, true, "Logo du salon (5Mo max. / .png, .jpg et .gif uniquement)", [$logo_salon_input->createInput()]);

$nom_salon_input = new Input("input", "", "text", "nom_salon", "nom_salon", "input", "Nom du salon", "", "", true, false, true, false, true, "user", false, "", true);
$nom_salon_field = new Field("", false, false, true, "Nom du salon", [$nom_salon_input->createInput()]);

$create_salon_input = new Input("input", "", "submit", "creer_salon", "creer_salon", "button is-dark", "", "Créer");
$close_salon_input = new Input("input", "", "button", "fermer_creer_salon", "fermer_creer_salon", "button is-light close_modal_create_salon", "", "Fermer");
$bottom_salon_field = new Field("", true, false, false, "", [$create_salon_input->createInput(), $close_salon_input->createInput()]);

$form_obj_create_salon = new Form("POST", "createSalonForm", [$logo_salon_field->createField(), $nom_salon_field->createField(), $bottom_salon_field->createField()], true);
$form_create_salon = $form_obj_create_salon->createForm();

$web->addModal("Créer un nouveau salon", $form_create_salon, "modal_create_salon");

$web->addToBody(<<<HTML
<section class="hero" style="bottom: 0 !important; position:fixed !important; width: 100%; height: 70px;">
  <div class="hero-body" style="margin-top: -55px !important;">
    <form method="POST" class="box">
      <div class="field has-addons">
        <p class="control">
          <div id="file-js-example" class="file has-name">
            <label class="file-label">
              <input class="file-input" type="file" name="resume"/>
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fas fa-paperclip"></i>
                </span>
              </span>
            </label>
          </div>
        </p>
        <p class="control is-expanded">
          <input class="input" type="text" placeholder="Ecrivez votre message...">
        </p>
        <p class="control has-icons-left">
          <button type="submit" class="button is-info">
            <span class="icons">
              <i class="fas fa-paper-plane"></i>
            </span>
          </button>
        </p>
      </div>
    </form>
  </div>
</section>

<script>
    $(window).ready(function() { 
        updateInputFile("logo_salon", "inputFileCreerSalon");
        updateInputFile("avatar", "inputFileAvatar");
        verifForm(["avatar", "mail", "username", "password"], "deconnexion.php", "php/modif_profile_php.php", "modifAccountForm");
        verifForm(["logo_salon", "nom_salon"], "deconnexion.php", "php/creer_salon_php.php", "createSalonForm");
      });
</script>
HTML);

echo $web->toHTML($theme);

}else{
  setcookie("notification", "no_co", strtotime('+30 days'), "/", "localhost", false, false);
  header("location:index.php");
}