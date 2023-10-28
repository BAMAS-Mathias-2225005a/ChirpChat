<?php

namespace ChirpChat\Controllers;

use chirpchat\model\Database;

class HomePage {


    public function execute() : void{
        $postList = (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->getPostList();
        $categoriesList = (new \ChirpChat\Model\CategoryRepository(Database::getInstance()->getConnection()))->getAllCategories();
        if(isset($_SESSION['ID'])) {
            $user = (new \ChirpChat\Model\UserRepository(Database::getInstance()->getConnection()))->getUser($_SESSION['ID']);
        }
        else{
            $user = null;
        }
        $homePageView = new \ChirpChat\Views\HomePageView();
        $homePageView
            ->setCategoriesView($categoriesList)
            ->setPostListView($postList, $categoriesList)
            ->setBestPostView()
            ->displayHomePageView($user);
    }

}
