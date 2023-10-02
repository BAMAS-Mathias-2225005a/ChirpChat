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
        <main id="commentPage">
            <h2 id="commentSectionTitle">Répondre à <?php echo $post->getUser()->getUsername()?></h2>
             <?php (new \ChirpChat\Views\Post($post))->show(); ?>
            <form action="index.php?action=addComment&id=<?php echo $post->idPost?>" method="post">
                <img alt="profilePicture" src="https://cdn-icons-png.flaticon.com/512/168/168724.png">
                <textarea type="text" name="comment" placeholder="Donnez votre avis !"></textarea>
                <input type="submit" name"ENVOYER">
            </form>
            <div id="commentList">
                <?php
                foreach ($commentList as $comment){
                    (new \ChirpChat\Views\Post($comment))->show();
                }?>
            </div>
        </main><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Commentaire", $content))->show();
    }
}