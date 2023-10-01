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
            <h1>ChirpChat</h1>
            <div id="searchBar">
                <img alt="Loupe barre de recherche" src="https://cdn-icons-png.flaticon.com/512/68/68213.png">
                <input placeholder="Rechercher un post">
            </div>

            <?php if(isset($_SESSION['ID'])){?>
            <div id="profilSection">
                <img id="messageIcon" alt="image icon message privés" src="https://cdn-icons-png.flaticon.com/512/245/245810.png">
                <p>@Username</p>
                <img id="profilPicture" alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
            </div>
            <?php }else{?>
            <div id="connectionSection">
                <input type="button" value="SE CONNECTER">
                <input type="button" value="S'INSCRIRE">
            </div>
            <?php }?>
        </nav>
        <main id="pageContent">
            <?= $this->content; ?>
        </main>
    </body>
    </html>
<?php
    }
}