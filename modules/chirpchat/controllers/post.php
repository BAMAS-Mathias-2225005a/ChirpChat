<?php

namespace ChirpChat\Controllers;

use ChirpChat\Model\CategoryRepository;
use Chirpchat\Model\Database;
use ChirpChat\Model\PostRepository;
use ChirpChat\Views\HomePageView;

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
        $categorieList = (new CategoryRepository(Database::getInstance()->getConnection()))->getAllCategories();
        $postList = (new \Chirpchat\Model\PostRepository(Database::getInstance()->getConnection()))->searchPost($filter);
        $homePageView = new HomePageView();

        if(!empty($postList)) {
            $homePageView->setPostListView($postList, $categorieList);
        }else{
            $homePageView->displayNoPostFoundError();
        }

        $homePageView->displayHomePageView(null);
    }

    public function deletePost(string $postID) : void {
        $postRepo = new PostRepository(Database::getInstance()->getConnection());
        $postRepo->deletePost($postID);
        header('Location:index.php'); // Redirection vers la page d'accueil
    }
}
