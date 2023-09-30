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

?><h1>Dernier commentaire : </h1>
<h2><a href="index.php?action=inscription">INSCRIPTION</a></h2>
<h2><a href="index.php?action=connexion">LOGIN</a></h2>
        <?php if(isset($_SESSION['ID'])){
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
    <?php foreach($postList as $post){
?>  <div class="post">
        <div id="postHeader">
            <img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" />
            <div id="authorInfo">
                <?php
                    echo '<h2> ' . $post->getUser()->getPseudo() . '</h2>';
                    echo '<h3> ' . $post->getUser()->getUsername() . '</h3>';
                ?>
            </div>
        </div>
        <div id="postContent">
            <p>
                <?php echo $post->message?>
            </p>
        </div>
        <div id="postFooter">
            <div>
                <img alt="hearth image" src="https://static-00.iconduck.com/assets.00/heart-icon-512x441-zviestnn.png"/>
                <p>500</p>
            </div>
            <div><img alt="comment image" src="https://icon-library.com/images/speech-bubble-icon/speech-bubble-icon-13.jpg"/>
                <p>500</p>
            </div>
        </div>
    </div><?php } ?>
</div><?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Accueil", $content))->show();
    }
}
