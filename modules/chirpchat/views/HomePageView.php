<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Category;
use Chirpchat\Model\Database;
use ChirpChat\Model\Post;
use ChirpChat\Model\User;
use ChirpChat\Model\UserRepository;

class HomePageView {

    private string $categoriesView = "";
    private string $postListView = "";
    private string $bestPostView = "";

    /**
     * @param Category[] $categoriesList
     * @return $this
     */
    public function setCategoriesView(array $categoriesList) : HomePageView{
        ob_start();
        ?> <div id="categories">
            <h3 class="sectionTitle">CATÉGORIES</h3><br/>
            <div id="slider">
                <script src="../../../_assets/js/categoriesCreation.js"></script>
                <?php foreach ($categoriesList as $category){ ?>
                    <a>
                        <h3><?= $category->getLibelle() ?></h3>
                        <p>146 <br> Posts</p>
                        <svg onload="placeStarElement(this)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php
        $this->categoriesView = ob_get_clean();
        return $this;
    }

    public function setPostListView($postList, $categories) : HomePageView {
        ob_start();
        ?><div id="postList">
        <?php if(isset($_SESSION['ID'])){?>

            <form action="index.php?action=sendPost" id="writePostSection" method="post">
                <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/436/436299.png">
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

        <?php } foreach($postList as $post){
            (new \ChirpChat\Views\PostView($post))->show();
        }?></div><?php

        $this->postListView = ob_get_clean();
        return $this;
    }


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

    public function displayNoPostFoundError() : void {
        echo '<p> Aucun Post Trouvé </p>';
    }

    /**
     * @param Category[] $categoriesList
     * @return void
     */
    public function getCategoriesList(array $categoriesList) : void{
        echo sizeof($categoriesList);
        foreach($categoriesList as $category){
            echo '<option>' . $category->getLibelle() . '</option>';
        }
    }
}
