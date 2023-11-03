<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Category;
use Chirpchat\Model\Database;
use ChirpChat\Model\Post;
use ChirpChat\Model\User;
use ChirpChat\Model\UserRepository;
/**
 * Class HomePageView
 *
 * Cette classe gère l'affichage de la page d'accueil, y compris les catégories, les publications et les publications populaires.
 */
class HomePageView {
    /**
     * Vue des catégories.
     *
     * @var string
     */
    private string $categoriesView = "";
    private string $postListView = "";
    private string $bestPostView = "";

    /**
     * Définit la vue des catégories.
     *
     * @param Category[] $categoriesList Un tableau d'objets Category représentant les catégories.
     *
     * @return HomePageView
     */
    public function setCategoriesView(array $categoriesList) : HomePageView{
        ob_start();
        ?> <div id="categories">
            <h3 class="sectionTitle">CATÉGORIES</h3><br/>
            <div id="slider">
                <script src="../../../_assets/js/categoriesCreation.js"></script>
                <?php for ($i = 0; $i < count($categoriesList) && $i < 5; $i++){
                    $category = $categoriesList[$i]?>
                    <a style="background-color: <?= $category->getColorCode() ?>">
                        <h3><?= $category->getLibelle() ?></h3>
                        <p><?= $category->getNbPostInCategory()?><br> Posts</p>
                        <svg onload="placeStarElement(this)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </a>
                <?php } ?>
                <a id="more-category" href="index.php?action=categoryList">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <p>Plus de catégories</p>
                </a>
            </div>
        </div>

        <?php
        $this->categoriesView = ob_get_clean();
        return $this;
    }

    /**
     * @param Post[] $postList
     * @param $categories
     * @param $pageNb
     * @return $this
     */
    public function setPostListView($postList, $categories, $pageNb = 1) : HomePageView {
        ob_start();
        ?><div id="postList">
        <?php if(isset($_SESSION['ID'])){
            $user = (new UserRepository(Database::getInstance()->getConnection()))->getUser($_SESSION['ID']);
        ?>

            <form action="index.php?action=sendPost" id="writePostSection" method="post">
                <img alt="photo de profil" class="profile-picture" src="<?= $user->getProfilPicPath()?>">
                <div id="userInputContent">
                    <input type="text" placeholder="Donnez un titre !" name="titre" required></input>
                    <textarea spellcheck="false" maxlength="160" placeholder="Envoyez un message !" name="message" required></textarea>
                    <select id="category" multiple name="categories[]" required>
                        <?php $this->getCategoriesList($categories) ?>
                    </select>
                    <script>
                        new SlimSelect({
                            select: '#category',
                            settings: {
                                placeholderText: 'Choisir une catégorie',
                                searchPlaceholder: 'Rechercher',
                            }
                        })
                    </script>
                    <input type="submit" value="POSTER">
                </div>


            </form>

        <?php }
        $lastPost = $postList[0];
            foreach($postList as $post){
                $lastPost = $post;
                (new \ChirpChat\Views\PostView($post))->show();
        }
        echo '<a href="index.php?page=' . $pageNb + 1 . '#' . $lastPost->idPost . '"><button class="authButtons" id="see-more-button">Voir Plus</button></a>';
        ?>
        </div><?php

        $this->postListView = ob_get_clean();
        return $this;
    }

    /**
     * Définit la vue des publications populaires.
     *
     * @return HomePageView
     */
    public function setBestPostView() : HomePageView {
        ob_start();
        ?>
        <div id="bestPost" style="background: linear-gradient(to bottom, #2980b9, #6dd5fa, #ffffff);">
            <h3 class="sectionTitle"> Les plus likés </h3><br/>
        </div>
        <?php
        $this->bestPostView = ob_get_clean();
        return $this;
    }

    public function displayHomePageView($user) : void {
        ob_start();
        ?><div id="catContainer">
            <?= $this->categoriesView ?>
            <?= $this->postListView ?>
            <?= $this->bestPostView ?>
        </div>
        <?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\mainLayout("Accueil", $content))->show(['homePage.css', 'post.css']);
    }
    /**
     * Affiche un message d'erreur lorsque aucune publication n'est trouvée.
     *
     * @return void
     */
    public function displayNoPostFoundError() : void {
        echo '<p> Aucun Post Trouvé </p>';
    }

    /**
     * Affiche la liste des catégories.
     *
     * @param Category[] $categoriesList Un tableau d'objets Category représentant les catégories.
     *
     * @return void
     */
    public function getCategoriesList(array $categoriesList) : void{
        echo sizeof($categoriesList);
        foreach($categoriesList as $category){
            echo '<option>' . $category->getLibelle() . '</option>';
        }
    }
}
