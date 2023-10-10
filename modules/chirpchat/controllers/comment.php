<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;
use Chirpchat\Model\PostRepository;

class Comment{

    /**
     * Display all comments of a post from the post id in the URL
     * @return void
     */
    public function displayComment() : void {
        if(!isset($_GET['id'])) return;

        $postRepository = new PostRepository(Database::getInstance()->getConnection());
        $postID = $_GET['id'];
        $post = $postRepository->getPost($postID);
        $commentList = $postRepository->getPostComment($postID);
        $commentPage = (new \ChirpChat\Views\PostCommentView());

        $commentPage
            ->setMainPost($post)
            ->setPostComments($commentList)
            ->displayCommentPage();
    }

    /**
     * Add a comment if the user is connected
     * @return void
     */
    public function addComment() : void {
        $comment = $_POST['comment'];
        if(!isset($_GET['id'])) return;

        $parentId = $_GET['id'];
        (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->add(null, $comment, $_SESSION['ID'], $parentId);
        header("Location:index.php?action=comment&id=" . $parentId);
    }
}
