<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;

class User {

    public function login() : void{
        $user = new \ChirpChat\Model\User(Database::getInstance()->getConnection());

        if($_POST['email'] == ""){
            header('Location:index.php?action=connexion&error=emptyEmail');
            return;
        }

        if($_POST['password'] == ""){
            header('Location:index.php?action=connexion&error=emptyPassword');
            return;
        }

        if($user->isUserIdValid($_POST['email'], $_POST['password'])){
            $ID = $user->getID($_POST['email'], $_POST['password']);
            $this->createUserSession($ID);
        }else{
            header('Location:index.php?action=connexion&error=wrongID');
        }
    }

    public function register() : void{
        (new \ChirpChat\Model\User(Database::getInstance()->getConnection()))->register($_POST['username'],$_POST['pseudonyme'],$_POST['email'],$_POST['password'],$_POST['birthdate']);
        header("Location:index.php");
    }

    private function createUserSession(string $ID) : void{
        session_start();
        $_SESSION['ID'] = $ID;
    }
}