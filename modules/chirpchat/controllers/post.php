<?php

namespace ChirpChat\Controllers;

use ChirpChat\Model\CategoryRepository;
use Chirpchat\Model\Database;
use ChirpChat\Model\PostRepository;
use ChirpChat\Views\HomePageView;
/**
 * Contrôleur de gestion des publications (posts).
 */
class Post{
    /**
     * Ajoute une nouvelle publication (post) avec des catégories associées.
     *
     * Cette méthode récupère les données du formulaire POST, puis crée une nouvelle publication
     * en utilisant le PostRepository. Les catégories associées à la publication sont également gérées.
     * Ensuite, elle redirige l'utilisateur vers la page d'accueil.
     *
     * @return void
     */
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
    /**
     * Recherche des publications (posts) en fonction du filtre.
     *
     * Cette méthode effectue une recherche de publications en fonction du filtre fourni dans le formulaire POST.
     * Elle affiche les résultats de la recherche sur la page d'accueil en utilisant la vue HomePageView.
     *
     * @return void
     */
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
    /**
     * Supprime une publication (post) en fonction de son identifiant.
     *
     * Cette méthode supprime une publication en utilisant le PostRepository, en fonction de l'identifiant fourni.
     * Ensuite, elle redirige l'utilisateur vers la page d'accueil.
     *
     * @param string $postID L'identifiant de la publication à supprimer.
     *
     * @return void
     */
    public function deletePost(string $postID) : void {
        $postRepo = new PostRepository(Database::getInstance()->getConnection());
        $postRepo->deletePost($postID);
        header('Location:index.php'); // Redirection vers la page d'accueil
    }
}
