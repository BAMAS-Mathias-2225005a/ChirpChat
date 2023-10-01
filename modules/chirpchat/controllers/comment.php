<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;

class Comment{

    public function execute() : void {
        $postRepository = (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()));
        $postID = $_GET['id'];
        $post = $postRepository->getComment($postID);
        $commentList = $postRepository->getPostComment($postID);
        (new \ChirpChat\Views\Comment())->show($post, $commentList);
    }

    public function addComment() : void {
        $comment = $_POST['comment'];
        if(!isset($_GET['id'])) return;

        $parentId = $_GET['id'];
        (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->add(null, $comment, $_SESSION['ID'], $parentId);
        header("Location:index.php?action=comment&id=" . $parentId);
    }
}
