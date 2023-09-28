<?php

namespace ChirpChat\Views;

class MainLayout {

    public function __construct(private string $title, private string $content) { }

    public function show() : void {
?><!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../../_assets/styles/styles.css">
        <link rel="icon" type="favicon" href="/favicon.png">
        <title><?= $this->title?></title>
    </head>
    <body>
        <nav>
            <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
            <img id="Logo" src="/_assets/images/Logo.png">
            <img id="loupeImage" alt="image d'une loupe" src="https://cdn-icons-png.flaticon.com/512/1280/1280594.png">
            <img id="backgroundImage" alt="arrière plan image de vague" src="/_assets/images/NavBarBackground.png">
        </nav>
    <?= $this->content; ?>
    </body>
    </html>
<?php
    }
}