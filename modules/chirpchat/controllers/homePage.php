<?php

namespace ChirpChat\Controllers;

use chirpchat\model\Database;

class HomePage {


    public function execute() : void{
        $postList = (new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection()))->getPostList();
        (new \ChirpChat\Views\HomePage())->show($postList);
    }

}
