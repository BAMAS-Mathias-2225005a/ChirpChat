<?php

namespace ChirpChat\Views;
use \ChirpChat\Model\User;
class MainLayout {

    public function __construct(private string $title, private string $content) { }

    /**
     * @param $user
     * @return void
     */
    public function show(?User $user = null) : void {
?><!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../../_assets/styles/styles.css">
        <link rel="icon" type="favicon" href="/favicon.png">
        <script src="/_assets/js/scripts.js"></script>
        <title><?= $this->title?></title>
    </head>
    <body>
        <nav>
            <h1><a href="index.php">ChirpChat</a></h1>
            <div id="searchBar">
                <img alt="Loupe barre de recherche" src="https://cdn-icons-png.flaticon.com/512/68/68213.png">
                <input placeholder="Rechercher un post">
            </div>

            <?php if(isset($_SESSION['ID'])){?>
            <div id="profilSection">
                <img id="messageIcon" alt="image icon message privés" src="https://cdn-icons-png.flaticon.com/512/245/245810.png">
                <?php if($user != null) echo '<p>@' . $user->getUsername() . '</p>' ?>;
                <img id="profilPicture" alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
            </div>
            <?php }else{?>
            <a id="hamburgerMenuIcon" onclick="openHamburgerMenu()"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/2048px-Hamburger_icon.svg.png" ></a>
            <div id="connectionSection">
                <a href="index.php?action=connexion"><input type="button" value="SE CONNECTER"></a>
                <a href="index.php?action=inscription"><input type="button" value="S'INSCRIRE"></a>
            </div>
            <?php }?>
        </nav>

        <div id="hamburgerMenuUnscroll" style="display: none">
            <img id="closeHamburgerMenuIcon" onclick="closeHamburgerMenu()" src="https://cdn-icons-png.flaticon.com/512/57/57165.png">
            <div id="buttons">
                <a href="index.php?action=connexion"><input type="button" value="SE CONNECTER"></a>
                <a href="index.php?action=inscription"><input type="button" value="S'INSCRIRE"></a>
            </div>
        </div>

        <main id="pageContent">
            <?= $this->content; ?>
        </main>
    </body>
    </html>
<?php
    }
}