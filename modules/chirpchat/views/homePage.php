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
    public function show(array $postList) : void {
        ob_start();


        if(isset($_SESSION['ID'])){
            $user =  (new UserRepository(Database::getInstance()->getConnection()))->getUser($_SESSION['ID']);
            echo "<h2> Bonjour " . $user->getUsername() . "</h2>";
            ?>
                <form action="index.php?action=sendPost" method="post">
                    <input type="text" name="titre" placeholder="Titre">
                    <input type="text" name="message" placeholder="Message">
                    <input type="submit" value="ENVOYER">
                </form>
            <?php
        }
        ?><div id="postList">
        <div id="writePostSection">
            <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/436/436299.png">
            <div id="userInputContent">
                <input type="text" placeholder="Envoyez un message !">
                <input type="button" value="POSTER">
            </div>
        </div>
    <?php foreach($postList as $post)
        {
            (new \ChirpChat\Views\Post($post))->show();
        }
    ?></div><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Accueil", $content))->show();
    }
}
