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
        <nav>
            <div id="logoDiv" style="display: flex; align-items: center; gap: 20px; width: 20vw; justify-content: space-around">
                <img alt="Logo" id="logo" src="/_assets/images/Logo.png">
                <h1 style="margin-top: 15px"><a href="index.php">ChirpChat</a></h1>
            </div>
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
            <div id="connectionSection"">
                <a href="index.php?action=connexion"><input type="button" value="SE CONNECTER"></a>
                <a href="index.php?action=inscription"><input type="button" value="S'INSCRIRE"></a>
            </div>
            <?php }?>
        </nav>

        <div id="mobileViewBottomBar">
            <ul>
                <li>
                    <a href="index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <p>Accueil</p>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=privateMessage">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <p>Messages</p>
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <p>Rechercher</p>
                </li>
                <li>
                    <?php if(isset($_SESSION['ID'])){
                        ?>
                    <a href="index.php?action=profile&id= <?= $user->getUserID() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <p>Profil</p>
                        <?php
                        }else{
                        ?>
                    <a href="index.php?action=connection">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        <p>Connexion</p>
                        <?php
                        }?>
                    </a>
                </li>
            </ul>

            <a>
                <div id="addPostButtonContainer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16"> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg>
                </div>
            </a>
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