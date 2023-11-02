<?php

namespace ChirpChat\Views;
/**
 * Class CategoryCreationView
 *
 * Cette classe gère l'affichage du formulaire de création de catégorie.
 */
class CategoryCreationView {
    /**
     * Affiche le formulaire de création de catégorie.
     *
     * Cette méthode génère et affiche le formulaire permettant de créer une nouvelle catégorie.
     *
     * @return void
     */
    public function displayCategoryCreationForm() : void {
        ob_start();
        ?>
        <form id="creation-category-form" method="post" action="index.php?action=createCategory">
            <h2 id="titreCreation">CREATION DE CATÉGORIES</h2>
            <p class="red">ADMIN</p>
            <label>Libelle
                <input class="inputField" type="text" placeholder="Nom de la catégorie" name="categoryName" required><br/>
            </label>

            <label>Description
            <textarea class="inputField" placeholder="Description de la catégorie" name="categoryDescription" required></textarea><br/>
            </label>

            <label>Couleur
                <input type="color" name="color">
            </label>
            <input class="authButtons" type="submit" value="VALIDER">
        </form>
        <?php
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Creation catégorie", $pageContent))->show(['categoryCreation.css']);
    }

}

