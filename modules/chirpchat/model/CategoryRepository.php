<?php

namespace ChirpChat\Model;

class CategoryRepository
{

    public function __construct(private \PDO $connection){ }

    public function getCategory($idCat) : ?Category{
        $statement = $this->connection->prepare("SELECT * FROM Categorie WHERE id_cat = ?");
        $statement->execute([$idCat]);

        if($row = $statement->fetch()){
            return new Category($row['id_cat'], $row['libelle'], $row['description']);
        }

        return null;
    }

    /**
     * @param $catLibelle
     * @return int return -1 if category don't exist
     */
    public function getCategoryId($catLibelle) : int {
        $statement = $this->connection->prepare("SELECT id_cat FROM Categorie WHERE libelle = ?");
        $statement->execute([$catLibelle]);

        if($row = $statement->fetch()){
            return $row['id_cat'];
        }
        return -1;
    }

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

    /** Return all categories available
     * @return Category[]
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

    public function addPostToCategory($idPost, $idCategories) : void{
        $statement = $this->connection->prepare('INSERT INTO PostCategory VALUES (?,?)');
        $statement->execute([$idCategories, $idPost]);
    }

    public function createCategory(string $categoryName, string $categoryDescription) : void{
        $statement = $this->connection->prepare('INSERT INTO Categorie (libelle, description) VALUE (?,?)');
        $statement->execute([$categoryName, $categoryDescription]);
    }

    public function getNbPostForCategory($id_cat) : int{
        $statement = $this->connection->prepare("SELECT COUNT(*) nb FROM PostCategory WHERE id_cat = ?");
        $statement->execute([$id_cat]);
        if($row = $statement->fetch()){
            return $row['nb'];
        }
        return 0;
    }

}