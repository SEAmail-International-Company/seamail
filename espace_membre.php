<?php
require_once("php/web_class.php");
require_once("php/functions.php");

if(isset($_SESSION["username"]) && !empty($_SESSION["username"])){

$icon_theme = $theme == "dark" ? "sun" : "moon";
$web = new Web("SEAmail - Espace membre");

$web->addToBody(<<<HTML
<div class="tile is-ancestor">
  <div class="tile is-4 is-vertical is-parent">
    <div class="tile is-child box">
      <p class="title">Bienvenue {$_SESSION["username"]} !</p>
      <p class="menu-label">
        Général
      </p>
      <ul class="menu-list">
        <li><a href="index.php">
        <i class="fas fa-home"></i> |
          Accueil</a></li>
      </ul>
      <p class="menu-label">
        Salons
      </p>
      <ul class="menu-list">
        <li>
          <a><i class="fas fa-comments"></i> | Général</a>
          <a><i class="fas fa-plus-circle"></i> | Créer un salon</a>
        </li>
      </ul>
      <p class="menu-label">
        Paramètres
      </p>
      <ul class="menu-list">
        <li>
          <a id="modif_account"><i class="fas fa-user-edit"></i> |
            Modifier mon compte</a>
          <a href="php/change_theme.php?retour={$_SERVER['REQUEST_URI']}">
          <i class="fas fa-{$icon_theme}"></i> |
            Changer le thème</a>
          <a href="deconnexion.php">
            <i class="fas fa-sign-out-alt"></i> |
            Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="tile is-vertical is-parent">
    <div class="tile is-child box">
      <p class="title">Chat général</p>
      {$web->addMessage("img/logo_court_blanc.png", "Jean Valjean", "Coucou", "12:32")}
    </div>
  </div>
</div>



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
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img src="{$_SESSION['profile_picture']}" alt="Placeholder image">
              </figure>
            </div>
            <div class="media-content">
              <p class="title is-4">{$_SESSION['username']}</p>
              <p class="subtitle is-6">Compte créé le <time datetime="2016-1-1">01/02/2021 à 15:54</time></p>
            </div>
          </div>
          <div class="content">
          <form method="POST">   
            <label class="label">Adresse mail</label>
              <div class="field has-addons">
                <div class="control">
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
                <div class="control">
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
                <div class="control">
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
<script>
  $(window).ready(function() {
    $("#modif_account").click(function() {
        $("#modal_modif_account").addClass("is-active");
    });
    $(".close_modif_account").click(function() {
      $("#modal_modif_account").removeClass("is-active");
      $("#mail").addClass("is-static");
      $('#mail').attr('readonly', true);
      $("#edit-mail").show();
      $("#score").addClass("is-static");
      $('#score').attr('readonly', true);
      $("#edit-score").show();
      $("#rang").addClass("is-static");
      $('#rang').attr('readonly', true);
      $("#edit-rang").show();
    });
    $("#edit-mail").click(function() {
      $("#mail").removeClass("is-static");
      $('#mail').attr('readonly', false);
      $(this).hide();
    });
    $("#edit-score").click(function() {
      $("#score").removeClass("is-static");
      $('#score').attr('readonly', false);
      $(this).hide();
    });
    $("#edit-rang").click(function() {
      $("#rang").removeClass("is-static");
      $('#rang').attr('readonly', false);
      $(this).hide();
    });
  });
</script>
HTML);

echo $web->toHTML($theme);

}else{
  header("location:index.php");
}