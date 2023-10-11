<?php

namespace ChirpChat\Views;
use ChirpChat\Model\Post;

class PostCommentView{

    private string $content;
    private string $mainPostView;
    private string $commentListView;

    public function setMainPost($post) : PostCommentView{
        ob_start();
        ?> <h2 id="commentSectionTitle">Répondre à <?php echo $post->getUser()->getUsername()?></h2>
            <?php (new \ChirpChat\Views\PostView($post))->show(); ?>
            <form id="ChampReponse" action="index.php?action=addComment&id=<?php echo $post->idPost?>" method="post">
                <img alt="profilePicture" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
                <textarea type="text" name="comment" placeholder="Donnez votre avis !"></textarea>
                <input type="submit" name"ENVOYER">
            </form>
        <?php
        $this->mainPostView = ob_get_clean();
        return $this;
    }

    public function setPostComments($commentList) : PostCommentView {
        ob_start();
        ?><div id="commentList">
            <?php
            foreach ($commentList as $comment){
                (new \ChirpChat\Views\PostView($comment))->show();
            }?>
        </div>
        <?php
        $this->commentListView = ob_get_clean();
        return $this;
    }

    public function displayCommentPage() : void {
        $this->content =
            '<main id="commentPage">' .
            $this->mainPostView .
            $this->commentListView .
            '</main>';

        (new \ChirpChat\Views\MainLayout("Commentaire", $this->content))->show(['postComment.css', 'post.css']);
    }
}