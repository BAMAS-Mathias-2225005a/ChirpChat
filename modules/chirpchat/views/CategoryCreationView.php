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
        <h2 id="titreCreation">Création catégorie</h2>
        <form id="zoneCreation" method="post" action="index.php?action=createCategory">
            <input id="nomCategorie" type="text" placeholder="Nom de la catégorie" name="categoryName" required><br/>
            <br/>
            <textarea id="descriptionCategorie" placeholder="Description de la catégorie" name="categoryDescription" required></textarea><br/>
            <br/>
            <input id="envoiCreation" type="submit" value="VALIDER">
        </form>
        <?php
        $pageContent = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Creation catégorie", $pageContent))->show(['categoryCreation.css']);
    }

}

