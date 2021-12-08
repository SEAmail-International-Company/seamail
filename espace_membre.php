<?php
require_once("php/web_class.php");
require_once("functions.php");

$web = new Web("SEAmail - Espace membre");
$web->addToBody(<<<HTML
<div class="tile is-ancestor">
  <div class="tile is-4 is-vertical is-parent">
    <div class="tile is-child box">
      <p class="title">Menu</p>
      <p class="menu-label">
        General
      </p>
      <ul class="menu-list">
        <li><a>Dashboard</a></li>
        <li><a>Customers</a></li>
      </ul>
      <p class="menu-label">
        Administration
      </p>
      <ul class="menu-list">
        <li>
          <a>Team Settings</a>
        </li>
        <li>
          <a class="is-active">Manage Your Team</a>
          <ul>
            <li><a>Members</a></li>
            <li><a>Plugins</a></li>
            <li><a>Add a member</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="tile is-vertical is-parent">
    <div class="tile is-child box">
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
HTML);

echo $web->toHTML($theme);