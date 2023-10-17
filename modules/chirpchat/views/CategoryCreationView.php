<?php

namespace ChirpChat\Views;

class CategoryCreationView {

    public function displayCategoryCreationForm() : void {
        ob_start();
        ?>
        <h2 id="titreCreation">Création catégorie</h2>
        <form id="zoneCreation" method="post" action="index.php?action=createCategory">
            <input id="nomCategorie" type="text" placeholder="Nom de la catégorie" name="categoryName" required><br/>
            <br/>
            <textarea id="descriptionCategorie" placeholder="Description de la catégorie" name="categoryDescription" required></textarea><br/>
            <br/>
            <input id="envoiCreation" type="submit">
        </form>
        <?php
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Creation catégorie", $pageContent))->show(['categoryCreation.css']);
    }

}

