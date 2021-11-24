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
                <script src="https://kit.fontawesome.com/602d3eba54.js" crossorigin="anonymous"></script>
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