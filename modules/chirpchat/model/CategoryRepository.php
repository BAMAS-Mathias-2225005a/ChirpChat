<?php

namespace ChirpChat\Model;

class CategoryRepository
{

    public function getCategoriesForPost($postId): array
    {
        $statement = $this->connection->prepare("SELECT id_cat FROM PostCategory WHERE post_id = ?");
        $statement->execute([$postId]);

        $categories = [];

        while ($row = $statement->fetch()) {
            $categories[] = $row['id_cat'];
        }

        return $categories;
    }

    public function deletePostWithCategories(int $postId): void
    {
        $this->connection->beginTransaction();


        $deleteCategoriesStatement = $this->connection->prepare("DELETE FROM PostCategory WHERE post_id = ?");
        $deleteCategoriesStatement->execute([$postId]);

        $deletePostStatement = $this->connection->prepare("DELETE FROM Post WHERE id_post = ?");
        $deletePostStatement->execute([$postId]);

        $this->connection->commit();
    }

}