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

    public function addNavBar() : void{
        $this->addToBody(<<<HTML
        <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
            <img src="img/logo_long_blanc.png" width="112" height="28">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Accueil
            </a>
            </div>
            </div>
            <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                <a class="button is-dark is-light" href="connexion.php">
                    Connexion
                </a>
                <a class="button is-white is-light is-outlined" href="inscription.php">
                    Inscription
                </a>
                </div>
            </div>
            </div>
        </div>
        </nav>
        HTML);
    }

    public function toHTML() : string{
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
            </head>
            <body>
                {$this->getBody()}
            </body>
        </html>
        HTML;

        return $html;
    }
}