<?php

namespace ChirpChat\Controllers;

use chirpchat\model\Database;
/**
 * Contrôleur de la page d'accueil.
 */
class HomePage {

    /**
     * Exécute le contrôleur de la page d'accueil.
     *
     * Cette méthode récupère la liste des publications (posts) et des catégories depuis la base de données.
     * Si l'utilisateur est connecté, elle récupère également les informations de l'utilisateur connecté.
     * Ensuite, elle utilise la vue HomePageView pour afficher la page d'accueil avec les données récupérées.
     *
     * @return void
     */
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
