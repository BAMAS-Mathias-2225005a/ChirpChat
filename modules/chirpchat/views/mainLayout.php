<?php

namespace ChirpChat\Views;
use Chirpchat\Model\Database;use \ChirpChat\Model\User;use ChirpChat\Model\UserRepository;
/**
 * Class MainLayout
 *
 * Cette classe gère la mise en page principale d'une page web.
 */
class MainLayout {
/**
 * Constructeur de la classe MainLayout.
 *
 * @param string $title   Le titre de la page.
 * @param string $content Le contenu de la page.
 */
    public function __construct(private string $title, private string $content) { }

/**
 * Affiche la page web avec un ensemble de styles.
 *
 * @param array $styles Un tableau contenant les noms des fichiers de styles à inclure.
 *
 * @return void
 */
    public function show(array $styles) : void {
?><!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../../_assets/styles/styles.css">
        <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
        <script src="/_assets/js/navbar.js"></script>
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
        <!-- AFFICHE LA NAVBAR -->
        <?php
        if(isset($_SESSION['ID'])){
            $userRepo = new UserRepository(Database::getInstance()->getConnection());
            (new \ChirpChat\Views\NavBarLayout($userRepo->getUser($_SESSION['ID'])))->displayNavBar();
        }else{
            (new \ChirpChat\Views\NavBarLayout(null))->displayNavBar();
        }
        ?>

        <!-- CONTENU DE LA PAGE -->
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
            <?php if($user != null) echo '<p>' . $user->getUsername() . '</p>' ?>
            <div id="profile" onclick="openCloseUserMenu(this)">
                <img id="profilPicture" alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
                <div id="scrolledProfile" class="menuClose">
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
        </div>

<?php
    }
}