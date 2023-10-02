<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;

class Post{

    public function addPost() : void{
        $titre = htmlspecialchars($_POST['titre']);
        $message = htmlspecialchars($_POST['message']);
        (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->add($titre, $message, $_SESSION['ID']);
        header("Location:index.php");
    }
}
