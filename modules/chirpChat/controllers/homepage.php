<?php

namespace ChirpChat\Controllers;

use ChirpChat\Model\Database;

class HomePage {


    public function execute() : void{
        //(new \ChirpChat\Views\HomePage())->show();

        echo (new \ChirpChat\Model\User(\ChirpChat\Model\Database::getInstance()))->isAlreadyRegistered("test");
    }

}
