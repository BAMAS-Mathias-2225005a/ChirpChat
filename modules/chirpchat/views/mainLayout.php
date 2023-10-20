<?php

namespace ChirpChat\Views;
use \ChirpChat\Model\User;
class MainLayout {

    public function __construct(private string $title, private string $content) { }

    /**
     * @param $user
     * @return void
     */
    public function show(array $styles, ?User $user = null) : void {
?><!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../../_assets/styles/styles.css">
        <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
        <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
        <!-- Ajout des styles donnés -->
        <?php
            foreach($styles as $style){
                echo '<link rel="stylesheet" href="/_assets/styles/' . $style . '">';
            }
            ?>

        <link rel="stylesheet" href="_assets/styles/styles.css">
        <link rel="icon" type="favicon" href="/favicon.png">
        <script src="/_assets/js/scripts.js"></script>
        <title><?= $this->title?></title>
    </head>
    <body>
        <nav>
            <img alt="Logo" id="logo" src="/_assets/images/Logo.png">
            <h1><a href="index.php">ChirpChat</a></h1>
            <div id="searchBar">
                <img alt="Loupe barre de recherche" src="https://cdn-icons-png.flaticon.com/512/68/68213.png">
                <form action="index.php?action=search" method="post">
                    <input name="filter" placeholder="Rechercher un post">
                    <input type="submit" style="position: absolute; width: 0; height: 0">
                </form>
            </div>

            <?php if($user != null){
                $this->displayProfilSection($user);
            }else{?>
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

    public function displayProfilSection(User $user) : void{
    ?>
        <div id="profilSection">
            <a href="index.php?action=privateMessage"><img id="messageIcon" alt="image icon message privés" src="https://cdn-icons-png.flaticon.com/512/245/245810.png"></a>
            <?php if($user != null) echo '<p>@' . $user->getUsername() . '</p>' ?>
            <img id="profilPicture" alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
            <div id="scrolledProfile">
                <ul>
                    <li id="profilMenu">
                        <a href="index.php?action=profile&id=<?= $_SESSION['ID'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0Zm0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5H8Z" clip-rule="evenodd"/></svg>
                            <p>Profil</p>
                        </a>
                    </li>
                    <li id="logoutMenu">
                        <a href="index.php?action=logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path fill="currentColor" d="M23 4H7a2 2 0 0 0-2 2v24a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6h-9.37a1 1 0 0 1-1-1a1 1 0 0 1 1-1H25V6a2 2 0 0 0-2-2Z" class="clr-i-solid clr-i-solid-path-1"/><path fill="currentColor" d="M28.16 17.28a1 1 0 0 0-1.41 1.41L30.13 22H25v2h5.13l-3.38 3.46a1 1 0 1 0 1.41 1.41l5.84-5.8Z" class="clr-i-solid clr-i-solid-path-2"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                            <p>Se déconnecter</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

<?php
    }
}