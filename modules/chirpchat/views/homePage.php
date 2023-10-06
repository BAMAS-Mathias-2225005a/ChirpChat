<?php

namespace ChirpChat\Views;

use Chirpchat\Model\Database;
use ChirpChat\Model\Post;
use ChirpChat\Model\User;
use ChirpChat\Model\UserRepository;

class HomePage {

    /**
     * @param Post[] $postList
     * @return void
     */
    public function show(array $postList, ?User $user) : void {
        ob_start();

        ?><
        <main style="display: flex;justify-content: space-around">
        <div id="categories">

            <a href="index.php?action=categorie" id="liensCategories">ANIMAUX</a><br> <!-- Bouton qui raméne a la catégorie -->

        </div>

        <div id="postList">
        <?php if(isset($_SESSION['ID'])){?>
        <form action="index.php?action=sendPost" id="writePostSection" method="post">
            <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/436/436299.png">
            <div id="userInputContent">
                <input type="text" placeholder="Donnez un titre !" name="titre"></input>
                <textarea spellcheck="false" maxlength="160" placeholder="Envoyez un message !" name="message"></textarea>
                <input type="submit" value="POSTER">
            </div>
        </form>



    <?php } foreach($postList as $post)
        {
            (new \ChirpChat\Views\Post($post))->show();
        }
    ?></div>

            <div id="bestPost">

            </div>


        </main>

        <?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Accueil", $content))->show($user);
    }
}
