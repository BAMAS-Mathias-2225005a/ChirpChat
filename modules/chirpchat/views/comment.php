<?php

namespace ChirpChat\Views;
use ChirpChat\Model\Post;

class Comment{

    /**
     * @param Post $post
     * @param Post[] $commentList
     * @return void
     */
    public function show($post, $commentList) : void{
        ob_start();
        ?>
        <div class="post">
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
        </div>

        <form action="index.php?action=addComment&id=<?php echo $post->idPost?>" method="post">
            <input type="text" name="comment">
            <input type="submit" name"ENVOYER">
        </form>


        <?php
        foreach ($commentList as $comment){
            ?><div class="post">
    <div id="postHeader">
        <img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" />
        <div id="authorInfo">
            <?php
            echo '<h2> ' . $comment->getUser()->getPseudo() . '</h2>';
            echo '<h3> ' . $comment->getUser()->getUsername() . '</h3>';
            ?>
        </div>
    </div>
    <div id="postContent">
        <p>
            <?php echo $comment->message?>
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
</div><?php
        }
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Commentaire", $content))->show();
    }
}