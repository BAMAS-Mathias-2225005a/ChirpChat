<?php

namespace ChirpChat\Views;

class Post{

    /**
     * @param \ChirpChat\Model\Post $post
     */
    public function __construct(private \ChirpChat\Model\Post $post) {}


    public function show() : void{
        ob_start();
        ?><div class="post">
            <a id="<?php echo $this->post->idPost?>"></a>
            <img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" />
            <a href="index.php?action=comment&id=<?=$this->post->postID?> ">
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
                            <input type="submit" value="LIKE">
                        </form>
                        <p><?php echo $this->post->likeAmount ?></p>
                    </div>
                    <div><img alt="comment image" src="https://icon-library.com/images/speech-bubble-icon/speech-bubble-icon-13.jpg"/>
                        <p><?php echo $this->post->commentAmount ?></p>
                    </div>
                </div>
            </a>
        </div><?php

        echo ob_get_clean();
    }
}
