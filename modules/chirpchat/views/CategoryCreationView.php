<?php

namespace ChirpChat\Views;

class CategoryCreationView {

    public function displayCategoryCreationForm() : void {
        ob_start();
        ?>
        <h2>CREATION DE CATÉGORIE</h2>
        <form method="post" action="index.php?action=createCategory">
            <input type="text" placeholder="Nom de la catégorie" name="categoryName" required>
            <textarea placeholder="Description de la catégorie" name="categoryDescription" required></textarea>
            <input type="submit">
        </form>
        <?php
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Creation de catégorie", $pageContent))->show(['categoryCreation.css']);
    }

}

