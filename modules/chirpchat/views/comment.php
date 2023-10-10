<?php

namespace ChirpChat\Views;
use ChirpChat\Model\Post;

class Comment{

    private string $content = "";

    public function displayCommentPage() : void {
        $this->content = '<main id="commentPage">' . $this->content . '</main>';
        (new \ChirpChat\Views\MainLayout("Commentaire", $this->content))->show();
    }

    public function displayMainPost($post) : Comment{
        ob_start();
        ?><h2 id="commentSectionTitle">Répondre à <?php echo $post->getUser()->getUsername()?></h2>
            <?php (new \ChirpChat\Views\Post($post))->show(); ?>
            <form action="index.php?action=addComment&id=<?php echo $post->postID?>" method="post">
                <img alt="profilePicture" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
                <textarea type="text" name="comment" placeholder="Donnez votre avis !"></textarea>
                <input type="submit" name"ENVOYER">
            </form>
        <?php
        $this->content = $this->content . ob_get_clean();
        return $this;
    }

    public function displayPostComments($commentList) : Comment{
        ?><div id="commentList">
                <?php
                foreach ($commentList as $comment){
                    (new \ChirpChat\Views\Post($comment))->show();
                }?>
            </div>
        <?php
        $this->content = $this->content . ob_get_clean();
        return $this;
    }
}