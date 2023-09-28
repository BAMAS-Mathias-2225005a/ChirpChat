<?php

namespace ChirpChat\Controllers;

use ChirpChat\Model\Database;

class User {

    public function registerUser(){
        (new \ChirpChat\Model\User(Database::getInstance()))->register($_POST['username'],$_POST['pseudonyme'],$_POST['email'],$_POST['password'],$_POST['birthdate']);
    }
}