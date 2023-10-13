<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;

class Post{

    public function addPost() : void{

        $categoryRepo = new \ChirpChat\Model\CategoryRepository(Database::getInstance()->getConnection());
        $postRepo = new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection());
        $titre = htmlspecialchars($_POST['titre']);
        $message = htmlspecialchars($_POST['message']);
        $categoriesNames = $_POST['categories'];

        $postRepo->add($titre, $message, $_SESSION['ID']);

        foreach ($categoriesNames as $caterory){
            $catId = $categoryRepo->getCategoryId($caterory);
            if($catId != -1){
               $categoryRepo->addPostToCategory($postRepo->getLastPostID(), $catId);
            }
        }

        header("Location:index.php");
    }

    public function searchPost() : void{
        $filter = str_replace( ' ', '+', $_POST['filter']);
        $postList = (new \Chirpchat\Model\PostRepository(Database::getInstance()->getConnection()))->searchPost($filter);

        if(!empty($postList)) {
            (new \ChirpChat\Views\HomePageView())->show($postList, null);
        }
    }
}
