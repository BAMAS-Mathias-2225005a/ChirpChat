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

    public function setCategoriesView() : HomePageView{
        ob_start();
        ?> <div id="categories">
            <h3 class="sectionTitle"> Catégories </h3><br/>
            <a href="index.php?action=categorieAnimaux" id="lienCategorieAnimaux">ANIMAUX</a><br/>
            <a href="index.php?action=categorieSport" id="lienCategorieSport">SPORT</a><br/>
            <a href="index.php?action=categorieAuto" id="lienCategorieAuto">VOITURES</a><br/>
            <a href="index.php?action=categorieGaming" id="lienCategorieGaming">GAMING</a>
            <a href="index.php?action=categoryList"><p id="voirPlus">Voir plus</p></a>
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
                    <input type="submit" value="POSTER">
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
