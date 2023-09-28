<?php

namespace ChirpChat\Controllers;

use ChirpChat\Model\Database;

class HomePage {


    public function execute() : void{
        $postList = (new \ChirpChat\Model\PostRepository(Database::getInstance()))->getPost();
        (new \ChirpChat\Views\HomePage())->show($postList);
        echo (new \ChirpChat\Model\User(\ChirpChat\Model\Database::getInstance()))->isAlreadyRegistered("test");
    }

}
