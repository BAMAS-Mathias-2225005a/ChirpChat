<?php
    function startPage(string $title) : void{
        ?>

        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title> <?php $title ?> </title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <nav>
                <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
                <h1>Chirp Chat</h1>
                <img id="loupeImage" alt="image d'une loupe" src="https://cdn-icons-png.flaticon.com/512/1280/1280594.png">
                <img id="backgroundImage" src="assets/img/NavBarBackground.png">
            </nav>
        </body>
        </html>
        <?php } ?>
