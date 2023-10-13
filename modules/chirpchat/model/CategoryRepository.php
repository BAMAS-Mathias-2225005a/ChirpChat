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

}