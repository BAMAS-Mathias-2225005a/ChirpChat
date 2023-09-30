<?php

namespace ChirpChat\Model;

use Includes\DatabaseConnection;
use \ChirpChat\Model\Post;

class PostRepository{

    public function __construct(private \PDO $connection){ }

    public function getPost(){
        $userRepo = new \ChirpChat\Model\UserRepository($this->connection);
        $statement =  $this->connection->prepare("SELECT * FROM Post");
        $statement->execute();

        $postList = [];

        while ($row = $statement->fetch()){
            $post = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $userRepo->getUser($row['id_utilisateur']));
            $postList[] = $post;
        }

        return $postList;
    }

    public function add(string $titre, string $message, string $userID) : void {
        $statement = $this->connection->prepare("INSERT INTO Post VALUES (?,?,?,?,NULL,?)");
        $statement->execute([uniqid(),$titre, $message,date('D M Y'), $userID]);
    }

}
