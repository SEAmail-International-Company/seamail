<?php
require_once("form_class.php");
if(isset($_COOKIE["theme"])) $theme = $_COOKIE["theme"];
else $theme = "dark";

class Web{
    private $head;
    private $body;
    private $title;

    public function __construct(string $title = ""){
        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    public function getHead() : string{
        return $this->head;
    }

    public function getBody() : string{
        return $this->body;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function addToHead(string $head) : void{
        $this->head .= $head;
    }

    public function addToBody(string $body) : void{
        $this->body .= $body;
    }

    public function addCSSlink(string $link) : void{
        $this->addToHead(<<<HTML
        <link rel="stylesheet" type="text/css" href="{$link}"><br>
        HTML);
    }

    public function addJSlink(string $link) : void{
        $this->addToBody(<<<HTML
        <script src="{$link}"></script>
        HTML);
    }

    public function addIcon(string $link) : void{
        $this->addToHead(<<<HTML
        <link rel="icon" type="image/png" href="{$link}">
        HTML);
    }

    public function addSection(string $title, string $subtitle, string $size = "small") : void{
        $this->addToBody(<<<HTML
        <section class="section is-{$size}">
            <h1 class="title">{$title}</h1>
            <h2 class="subtitle">{$subtitle}</h2>
        </section>
        HTML);
    }

    public function addLoader(string $theme) : void{
        $color_background = $theme == "dark" ? "black" : "white";
        $this->addToBody(<<<HTML
            <div id="loader" 
            style="z-index: 99; position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: {$color_background};">
            <section class="section is-{$theme} is-large">
                <p class="title is-4">
                    Chargement en cours...
                </p><br>
                <p class="subtitle">
                    <progress class="progress is-{$theme} is-small" max="100"></progress>
                </p>
            </section>
            </div>
            <script>
            $(window).ready(function() {
                setTimeout(function() {
                $("#loader").fadeOut("slow");
                }, 600);       
            });
            </script>
        HTML);
    }

    public function addChat(string $salon = "général", string $utilisateur = "") : void {
        $this->addToBody(<<<HTML
          <div class="tile is-vertical is-parent">
            <div class="tile is-child box">
            <p class="title">Salon {$salon}</p>
            {$this->addMessage("img/logo_court_blanc.png", "Jean Valjean", "Coucou", "12:32")}
            </div>
        </div>
        </div>
        HTML);
    }

    public function addModal(string $titre, string $content, string $id) : void {
        $this->addToBody(<<<HTML
        <div class="modal" id="{$id}">
            <div class="modal-background"></div>
            <div class="modal-content">
                <header class="modal-card-head">
                    <p class="modal-card-title">{$titre}</p>
                    <button class="delete close_{$id}" aria-label="close"></button>
                </header>
                <div class="card">
                    <div class="card-content">
                        <div class="content">{$content}</div>
                    </div>
                </div>
            </div>
        </div>
        HTML);
    }

    public function addCookieNotif(string $notification) : void{
        if($notification != "") {
            $this->addToBody(<<<HTML
                <div id="notif_end" style="position: absolute; bottom: 0; right: 0px; z-index: 200;">
                    <p>
                    {$notification}
                    </p>
                </div>
            <script>
                $("#notif_end").hide();
                $("#notif_end").fadeIn(200);
                setTimeout(function() {
                    $("#notif_end").fadeOut(400);
                }, 4000);
                $(".delete").click(function() {
                    $("#notif_end").fadeOut(400);
                });
            </script>
            HTML);
        }
    }

    public function addMessage(string $picture, string $author, string $message, string $hour) : string{
        return (<<<HTML
        <article class="media">
            <figure class="media-left">
            <p class="image is-64x64">
                <img src="{$picture}">
            </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                    <strong>{$author}</strong>
                    <br>
                    {$message}
                    <br>
                    <small><a>J'aime</a> · <a>Répondre</a> · {$hour}</small>
                    </p>
                </div>
            </div>
        </article>
        HTML);
    }

    public function addMenuLeft(string $theme) : void{
        $icon = $theme == "dark" ? "sun" : "moon";
        $this->addToBody(<<<HTML
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
                <a id="create_salon"><i class="fas fa-plus-circle"></i> | Créer un salon</a>
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
                <i class="fas fa-{$icon}"></i> |
                    Changer le thème</a>
                <a href="deconnexion.php">
                    <i class="fas fa-sign-out-alt"></i> |
                    Déconnexion</a>
                </li>
            </ul>
            </div>
        </div>
        HTML);
    }

    public function addNavBar(string $color = "dark") : void{
        if($color == "dark"){
            $logo = "blanc";
            $icon = "moon";
        }else if($color == "light"){
            $logo = "couleur";
            $icon = "sun";
        }
        $this->addToBody(<<<HTML
        <nav class="navbar is-{$color} has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
            <img src="img/logo_long_{$logo}.png" width="112" height="28">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="connexion.php">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        <span>Connexion</span>
                    </span>
                </a>
                <a class="navbar-item" href="inscription.php">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        <span>Inscription</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="navbar-end">
                <a class="navbar-item" href="php/change_theme.php?retour={$_SERVER['REQUEST_URI']}">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-{$icon}"></i>
                        </span>
                        <span>Thème</span>
                    </span>
                </a>
                <a class="navbar-item" href="https://github.com/SEAmail-International-Company/seamail" target="_blank">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-code-branch"></i>
                        </span>
                        <span>
                        <div class="control">
                            <div class="tags has-addons">
                            <span class="tag is-dark">Build</span>
                            <span class="tag is-info">v2.0.0R</span>
                            </div>
                        </div>
                        </span>
                    </span>
                </a>
            </div>
        </div>
        </nav>
        HTML);
    }

    public function toHTML(string $color = "dark") : string{
        if($color == "dark"){
            $logo = "blanc";
            $add_on = "<link rel=\"stylesheet\" type=\"text/css\" href=\"https://unpkg.com/bulma-prefers-dark\" />";
        }else if($color == "light"){
            $logo = "couleur";
            $add_on  = "";
        }
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                {$this->getHead()}
                <title>{$this->getTitle()}</title>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
                {$add_on}
                <link rel="icon" type="image/png" href="img/logo_court_{$logo}.png">
                <script src="https://kit.fontawesome.com/602d3eba54.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            </head>
            <body class="has-navbar-fixed-bottom">
                {$this->getBody()}
            </body>
        </html>
        HTML;

        return $html;
    }
}