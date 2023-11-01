<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Category;
/**
 * Class CategoryCreationView
 *
 * Cette classe gère l'affichage du formulaire de création de catégorie.
 */
class CategoryListView{

    /**
     * Affiche le formulaire de création de catégorie.
     *
     * Cette méthode génère et affiche le formulaire permettant de créer une nouvelle catégorie.
     *
     * @return void
     */
    public function displayCreationButton() : void{
        echo '<a href="index.php?action=categoryCreation"><p id="creation">Créer une nouvelle catégorie</p></a>';
    }

    /**
     * Affiche la liste de catégories.
     *
     * @param Category[] $categories Un tableau d'objets Category représentant les catégories à afficher.
     * @return void
     */
    public function displayAllCategories(array $categories) : void {
        ob_start();
        foreach($categories as $category){
            echo $category->getLibelle();
        }
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Liste des catégories", $pageContent))->show(['categoryList.css']);
    }
}
