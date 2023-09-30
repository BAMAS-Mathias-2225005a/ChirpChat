<?php

namespace ChirpChat\Model;

use Includes\DatabaseConnection;
use \ChirpChat\Model\Post;
use \ChirpChat\Model\Post as Comment;

class PostRepository{

    public function __construct(private \PDO $connection){ }

    public function getPostList(){
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement =  $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID IS NULL");
        $statement->execute();

        $postList = [];

        while ($row = $statement->fetch()){
            $post = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']));
            $postList[] = $post;
        }

        return $postList;
    }

    public function add(?string $titre, string $message, string $userID, string $parent_id=null) : void {
        $statement = $this->connection->prepare("INSERT INTO Post (titre, message, date_publi, categories, id_utilisateur, PARENT_ID)VALUES (?,?,?,NULL,?,?)");
        $statement->execute([$titre, $message,date('D M Y'), $userID, $parent_id]);
    }

    public function getPostComment(string $id) : array {
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID=? LIMIT 10");
        $statement->execute([$id]);

        $commentList = [];
        while($row = $statement->fetch()){
            $commentList[] = new Comment($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']));
        }
        return $commentList;
    }

    public function getPost(string $postId) : ?Post{
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM Post WHERE PARENT_ID IS NULL AND ID_POST = ? LIMIT 1");
        $statement->execute([$postId]);

        if($row = $statement->fetch()){
            return new Comment($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']));
        }

        return null;
    }

}
