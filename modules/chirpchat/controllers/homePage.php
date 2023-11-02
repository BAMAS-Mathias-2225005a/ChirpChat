<?php

namespace ChirpChat\Controllers;

use chirpchat\model\Database;

class HomePage {

    private int $pageNb = 1;

    public function setPageNb(int $newNbPage) : HomePage{
        $this->pageNb = $newNbPage;
        return $this;
    }

    public function execute() : void{
        $postList = (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->getPostList($this->pageNb * 5);
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
            ->setPostListView($postList, $categoriesList, $this->pageNb)
            ->setBestPostView()
            ->displayHomePageView($user);
    }

}
