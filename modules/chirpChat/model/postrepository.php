<?php

namespace ChirpChat\Model;

use Includes\DatabaseConnection;

class Post{
    public function __construct(public string $idPost,string $titre, public string $message,string $datePubli,string $categorie,$idUtilisateur  ){ }
}

class PostRepository{

    public function __construct(private \ChirpChat\Model\Database $connection){ }

    public function getPost(){
        $statement =  $this->connection->getConnection()->prepare("SELECT * FROM Post");
        $statement->execute();

        $postList = [];

        while ($row = $statement->fetch()){
            $post = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $row['id_utilisateur']);
            $postList[] = new Post($row['id_post'], $row['titre'], $row['message'], $row['date_publi'], $row['categories'], $row['id_utilisateur']);
        }


        return $postList;

    }
}
