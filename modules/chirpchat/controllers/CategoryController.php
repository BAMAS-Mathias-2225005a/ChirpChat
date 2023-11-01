<?php

namespace ChirpChat\Controllers;

use \ChirpChat\Model\CategoryRepository;
use \ChirpChat\Views\CategoryListView;
use \ChirpChat\Views\CategoryCreationView;
use Chirpchat\Model\Database;
/**
 * Contrôleur de gestion des catégories.
 */
class CategoryController{
    /**
     * Crée une nouvelle catégorie à partir des données POST.
     *
     * Cette méthode crée une nouvelle catégorie en utilisant les données POST
     * fournies, puis dirige l'utilisateur vers la page de la liste des catégories.
     *
     * @return void
     */
    public function createCategory() : void {
        $categoriesRepo = new CategoryRepository(Database::getInstance()->getConnection());
        $categoryName = ucfirst($_POST['categoryName']);
        $categoryDescription = $_POST['categoryDescription'];

        $categoriesRepo->createCategory($categoryName, $categoryDescription);
        header('Location:index.php?action=categoryList');
    }
    /**
     * Affiche la page de création de catégories.
     *
     * Cette méthode génère et affiche le formulaire de création de catégories.
     *
     * @return void
     */
    public function displayCategoryCreationPage() : void{
        $categoryCreationView = new CategoryCreationView();

        $categoryCreationView->displayCategoryCreationForm();
    }
    /**
     * Affiche la liste des catégories.
     *
     * Cette méthode récupère la liste de toutes les catégories depuis la base de données
     * et les affiche sur la page. Elle vérifie également si l'utilisateur est un administrateur
     *
     * @return void
     */
    public function displayCategoryListPage() : void{
        $categoriesRepo = new CategoryRepository(Database::getInstance()->getConnection());
        $categoryListView = new CategoryListView();
        $categoriesList = $categoriesRepo->getAllCategories();

        //TODO CHECK SI ADMIN
        if(isset($_SESSION['ID'])) {
            $categoryListView->displayCreationButton();
        }

        $categoryListView->displayAllCategories($categoriesList);
    }

}
