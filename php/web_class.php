<?php
require_once("form_class.php");
require_once("requetes_php.php");
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
            style="z-index: 99; position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: {$color_background}; background: url('img/ocean_4.jpg'); background-size: cover;">
            <section class="section is-{$theme} is-large">
                <p class="title is-4">
                    Chargement en cours...
                </p><br>
                <p class="subtitle">
                <progress class="progress is-large is-link" id="loading" value="0" max="100"></progress>
                </p>
            </section>
            </div>
            <script>
            $(window).ready(function() {
                var loaderBar = $('#loading'),
                max = loaderBar.attr('max'),
                time = 7, 
                value = loaderBar.val();
                var Telechargement = function() {
                    value += 1;
                    addValue = loaderBar.val(value);
                };
                var animation = setInterval(function() {
                    Telechargement();
                }, time);
                  setTimeout(function() {
                    $("#loader").fadeOut("slow");
                }, 1500);       
            });
            </script>
        HTML);
    }

    public function addChat(string $salon = "Général", string $theme) {
        $_SESSION["salon"] = $salon;
        $color = $theme == "dark" ? "dark" : "light";
        $messages = showListMessages($salon, $theme);
        $this->addToBody(<<<HTML
          <div class="tile is-parent is-12" id="salon_msg">
            <div class="tile is-child box" id="child_salon_msg">
            <div class="tags has-addons"><span class="tag is-{$color} is-medium">Salon</span><span class="tag is-warning is-large">{$salon}</span>&nbsp;&nbsp;<span class="tag is-{$color} is-medium">Messages</span><span class="tag is-link is-medium">{$messages[1]}</span>&nbsp;&nbsp;<span class="tag is-{$color} is-medium show_membres_salon">Membres</span><span class="tag is-primary is-medium">{$messages[2]}</span></div>
            <hr>
            {$messages[0]}
            </div>
        </div>
        </div>
        HTML);

        return $messages[3];
    }

    public function addModal(string $titre, string $content, string $id = "", string $class = "") : void {
        $this->addToBody(<<<HTML
        <div class="modal" id="{$id}" class="{$class}" style="z-index:100;">
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
                <div id="notif_end" style="position: fixed; bottom: 0; right: 0px; z-index: 200;">
                    <p>
                    {$notification}
                    </p>
                </div>
            <script>
                $(window).ready(function() {
                var loaderBarNotif = $('.loading_notif'),
                max = loaderBarNotif.attr('max'),
                time = 20, 
                value = loaderBarNotif.val();
                var Telechargement = function() {
                    value += 1;
                    addValue = loaderBarNotif.val(value);
                };
                var animation = setInterval(function() {
                    Telechargement();
                }, time);   
                
                
                $("#notif_end").hide();
                $("#notif_end").fadeIn(200);
                setTimeout(function() {
                    $("#notif_end").fadeOut(400);
                }, 3000);
                $(".delete").click(function() {
                    $("#notif_end").fadeOut(400);
                });
            });
            </script>
            HTML);
        }
    }

    public function addMenuLeft(string $theme) : void{
        $liste_salons = showListSalons();
        $icon = $theme == "dark" ? "sun" : "moon";   
        $color = $theme == "dark" ? "black" : "white";
        $this->addToBody(<<<HTML
        <div class="control_menu" style="position: fixed; top: 10px; left: 0px; background-color: {$color}; padding: 5px; border-radius:8px;"><span class='icon is-small'> <i class='control_left_menu fas fa-angle-double-left'></i> </span></div>
        <div class="tile is-ancestor">
        <div class="tile is-4 is-parent" id="left_menu">
            <div class="tile is-child box">
            <p class="title mt-5">Bienvenue <code>{$_SESSION["username"]}</code> !</p>
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
                {$liste_salons}
                <a id="create_salon"><i class="fas fa-plus-circle"></i> | Créer un salon&nbsp;&nbsp;<div class='tag is-warning'>Fonctionnalité expérimentale</div></a>
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
        <script>
            $("#salon_msg").addClass("is-8")
            $(".control_left_menu").on('click', function() { 
                if($(this).hasClass("fa-angle-double-left"))
                {
                    $(this).removeClass("fa-angle-double-left")
                    $(this).addClass("fa-angle-double-right")
                    $("#salon_msg").removeClass("is-8")
                    $("#salon_msg").addClass("is-12")
                }else{
                    $(this).removeClass("fa-angle-double-right")
                    $(this).addClass("fa-angle-double-left")
                    $("#salon_msg").removeClass("is-12")
                    $("#salon_msg").addClass("is-8")
                }
                $("#left_menu").animate({
                    width: 'toggle'
                });
            });
        </script>
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
                            <span class="tag is-info">v5.0.0</span>
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