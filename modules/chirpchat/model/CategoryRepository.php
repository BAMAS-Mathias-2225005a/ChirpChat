<?php

namespace ChirpChat\Model;
/**
 * Repository pour la gestion des catégories.
 */
class CategoryRepository
{

    /**
     * Crée une nouvelle instance de CategoryRepository.
     *
     * @param \PDO $connection Une instance de PDO pour la connexion à la base de données.
     */
    public function __construct(private \PDO $connection){ }
    /**
     * Récupère une catégorie en fonction de son ID.
     *
     * @param int $idCat L'ID de la catégorie à récupérer.
     * @return Category|null Une instance de Category si elle existe, sinon null.
     */
    public function getCategory($idCat) : ?Category{
        $statement = $this->connection->prepare("SELECT * FROM Categorie WHERE id_cat = ?");
        $statement->execute([$idCat]);

        if($row = $statement->fetch()){
            return new Category($row['id_cat'], $row['libelle'], $row['description']);
        }

        return null;
    }

    /**
     * Récupère l'ID d'une catégorie en fonction de son libellé.
     *
     * @param string $catLibelle Le libellé de la catégorie.
     * @return int L'ID de la catégorie si elle existe, sinon -1.
     */
    public function getCategoryId($catLibelle) : int {
        $statement = $this->connection->prepare("SELECT id_cat FROM Categorie WHERE libelle = ?");
        $statement->execute([$catLibelle]);

        if($row = $statement->fetch()){
            return $row['id_cat'];
        }
        return -1;
    }
    /**
     * Récupère les catégories associées à un post en fonction de son ID.
     *
     * @param int $postId L'ID du post.
     * @return Category[] Un tableau d'instances de Category associées au post.
     */
    public function getCategoriesForPost($postId): array
    {
        $statement = $this->connection->prepare("SELECT id_cat FROM PostCategory WHERE id_post = ?");
        $statement->execute([$postId]);

        $categories = [];

        while ($row = $statement->fetch()) {
            $categories[] = $this->getCategory($row['id_cat']);
        }

        return $categories;
    }

    /**
     * Récupère toutes les catégories disponibles.
     *
     * @return Category[] Un tableau d'instances de Category représentant toutes les catégories disponibles.
     */
    public function getAllCategories() : array{
        $statement = $this->connection->prepare("SELECT * FROM Categorie");
        $statement->execute();

        $categoriesList = [];

        while($row = $statement->fetch()){
            $categoriesList[] = $this->getCategory($row['id_cat']);
        }

        return $categoriesList;
    }
    /**
     * Ajoute un post à une catégorie.
     *
     * @param int $idPost L'ID du post.
     * @param int $idCategories L'ID de la catégorie.
     */
    public function addPostToCategory($idPost, $idCategories) : void{
        $statement = $this->connection->prepare('INSERT INTO PostCategory VALUES (?,?)');
        $statement->execute([$idCategories, $idPost]);
    }
    /**
     * Crée une nouvelle catégorie.
     *
     * @param string $categoryName Le nom de la catégorie.
     * @param string $categoryDescription La description de la catégorie.
     */
    public function createCategory(string $categoryName, string $categoryDescription) : void{
        $statement = $this->connection->prepare('INSERT INTO Categorie (libelle, description) VALUE (?,?)');
        $statement->execute([$categoryName, $categoryDescription]);
    }

}