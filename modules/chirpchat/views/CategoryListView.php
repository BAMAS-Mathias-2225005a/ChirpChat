<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Category;

class CategoryListView{

    /**
     * @param Category[] $categories
     * @return void
     */

    public function displayCreationButton() : void{
        echo '<a href="index.php?action=categoryCreation"><p>Creation de nouvelles catégories</p></a>';
    }

    /**
     * @param Category[] $categories
     * @return void
     */
    public function displayAllCategories(array $categories) : void {
        ob_start();
        foreach($categories as $category){
            echo $category->getLibelle();
        }
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Liste des catégories", $pageContent))->show([]);
    }
}
