<?php

namespace ChirpChat\Views;

class PostView{

    /**
     * @param \ChirpChat\Model\Post $post
     */
    public function __construct(private \ChirpChat\Model\Post $post) {}


    public function show() : void{
        ob_start();
        ?><div class="post">
            <img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" />
            <a href="index.php?action=comment&id=<?=$this->post->idPost?>" style="width: 100%">
            <div id="postHeader">
                    <div id="authorInfo">
                        <?php
                        echo '<h2> ' . $this->post->getUser()->getPseudo() . '</h2>';
                        echo '<h3>- ' . $this->post->getUser()->getUsername() . '</h3>';
                        ?>
                    </div>
                </div>
                <div id="postContent">
                    <p>
                        <?php echo $this->post->message?>
                    </p>
                </div>
                <div id="postFooter">
                    <div>
                        <form action="index.php?action=like&id=<?php echo $this->post->idPost?>" method="post">
                            <button id="likeButton" type="submit">
                                <?= $this->getLikeButton() ?>
                            </button>
                        </form>
                        <p><?php echo $this->post->likeAmount ?></p>
                    </div>
                    <div><img alt="comment image" src="https://icon-library.com/images/speech-bubble-icon/speech-bubble-icon-13.jpg"/>
                        <p><?php echo $this->post->commentAmount ?></p>
                    </div>
                </div>

                <div id="postCategories">
                    <?php foreach ($this->post->getCategories() as $cat){
                        echo '<p class="category">#' . strtoupper($cat->getLibelle()) . '</p>';
                    }?>
                </div>
            </a>
        </div><?php

        echo ob_get_clean();
    }

    /** Return the like button with the correct image depending on the likes of the user
     * @return string
     */
    public function getLikeButton() : string{
        // User not connected or hasn't liked
        if(isset($_SESSION['ID']) && $this->post->isLikedByUser($_SESSION['ID'])){
            return '<img alt="like icon" src="https://cdn-icons-png.flaticon.com/512/753/753252.png">';
        }else{
            return '<img alt="like icon" src="https://cdn-icons-png.flaticon.com/512/159/159774.png">';
        }
    }
}
