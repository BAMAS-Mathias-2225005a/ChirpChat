<?php

namespace ChirpChat\Controllers;

use chirpchat\model\Database;

class HomePage {


    public function execute() : void{
        $postList = (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->getPost();
        (new \ChirpChat\Views\HomePage())->show($postList);
    }

}
