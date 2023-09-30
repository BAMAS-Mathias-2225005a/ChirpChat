<?php

namespace ChirpChat\Model;

class Post{
    public function __construct(public string $idPost,string $titre, public string $message,string $datePubli,?string $categorie,private $utilisateur ){ }

    public function getUser() : User{
        return $this->utilisateur;
    }
}