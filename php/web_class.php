<?php

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
            <a role="button" class="navbar-burger is-active" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
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
                        <span>Version de build 1.0.0[R]</span>
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
                <link rel="stylesheet" href="css/style.css">
                {$add_on}
                <link rel="icon" type="image/png" href="img/logo_court_{$logo}.png">
                <script src="https://kit.fontawesome.com/602d3eba54.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            </head>
            <body>
                {$this->getBody()}
            </body>
        </html>
        HTML;

        return $html;
    }
}