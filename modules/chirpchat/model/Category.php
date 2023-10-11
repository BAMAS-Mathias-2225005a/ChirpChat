<?php

namespace ChirpChat\Model;

class Category
{
    public function __construct(public string $idPost,?string $titre, public string $message,string $datePubli,?string $categorie,private $utilisateur, public int $commentAmount, public int $likeAmount ){ }


}

