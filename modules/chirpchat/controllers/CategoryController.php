<?php

namespace ChirpChat\Controllers;

use \ChirpChat\Model\CategoryRepository;
use \ChirpChat\Views\CategoryListView;
use \ChirpChat\Views\CategoryCreationView;
use Chirpchat\Model\Database;

class CategoryController{

    public function createCategory() : void {
        $categoriesRepo = new CategoryRepository(Database::getInstance()->getConnection());
        $categoryName = ucfirst($_POST['categoryName']);
        $categoryDescription = $_POST['categoryDescription'];

        $categoriesRepo->createCategory($categoryName, $categoryDescription);
        header('Location:index.php?action=categoryList');
    }

    public function displayCategoryCreationPage() : void{
        $categoryCreationView = new CategoryCreationView();

        $categoryCreationView->displayCategoryCreationForm();
    }

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
