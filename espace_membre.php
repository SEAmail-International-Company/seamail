<?php
require_once("php/web_class.php");
require_once("php/functions.php");
require_once("cookies.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){

$web = new Web("SEAmail - Espace membre");
$web->addMenuLeft($theme);

$web->addCookieNotif($notif);
$web->addJSlink("js/espace_membre.js");
$web->addChat();
//$web->addModal("Modifier mon compte", "", "modal_modif_account");

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


<div class="modal" id="modal_modif_account">
  <div class="modal-background"></div>
    <div class="modal-content">
      <header class="modal-card-head">
        <p class="modal-card-title">Modifier mon compte</p>
        <button class="delete close_modif_account" aria-label="close"></button>
      </header>
      <div class="card">
        <div class="card-content">
          
        <figure class="image is-64x64">
                <img class="is-rounded" src="{$_SESSION['profile_picture']}" alt="Placeholder image">
              </figure>
          <div class="media">
            <div class="media-left">
            </div>
            <div class="media-content">
              <p class="subtitle is-6">Compte créé le <time datetime="2016-1-1">01/02/2021 à 15:54</time></p>
            </div>
          </div>
          <div class="content">
            <form method="POST">  
              <div class="field has-addons">  
                <div class="control">
                  <button type="button" class="button is-static">
                    Nom d'utilisateur
                  </button>
                </div>
                <div class="control is-expanded">
                  <input class="input is-static pl-3" id="username" name="username" type="text" value="@{$_SESSION['username']}" readonly>
                </div>
                <div class="control">
                  <button type="button" class="button is-dark is-light" id="edit-username">
                    <span class="icons">
                      <i class="fas fa-pen"></i>
                    </span>
                  </button>
                </div>
              </div>
            <label class="label">Adresse mail</label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <input class="input is-static" id="mail" name="mail" type="mail" value="{$_SESSION['mail']}" readonly>
                </div>
                <div class="control">
                  <button type="button" class="button is-dark is-light" id="edit-mail">
                    <span class="icons">
                      <i class="fas fa-pen"></i>
                    </span>
                  </button>
                </div>
              </div>
              <label class="label">Score</label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <input class="input is-static" id="score" name="score" type="text" value="{$_SESSION['score']}" readonly>
                </div>
                <div class="control">
                  <button type="button" class="button is-dark is-light" id="edit-score">
                    <span class="icons">
                      <i class="fas fa-pen"></i>
                    </span>
                  </button>
                </div>
              </div>
              <label class="label">Rang</label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <input class="input is-static" id="rang" name="rang" type="text" value="{$_SESSION['rang']}" readonly>
                </div>
                <div class="control">
                  <button type="button" class="button is-dark is-light" id="edit-rang">
                    <span class="icons">
                      <i class="fas fa-pen"></i>
                    </span>
                  </button>
                </div>
              </div>
                <p class="control has-icons-left pt-5">
                  <button type="submit" class="button is-dark">
                    Enregistrer
                  </button>
                  <button type="button" class="button is-light close_modif_account">
                    Fermer
                  </button>
                </p>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
HTML);

echo $web->toHTML($theme);

}else{
  setcookie("notification", "no_co", strtotime('+30 days'), "/", "localhost", false, false);
  header("location:index.php");
}