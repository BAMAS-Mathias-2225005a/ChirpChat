<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;
use ChirpChat\Model\UserRepository;
use ChirpChat\Views\UserView;

class User {

    public function login() : void{
        $user = new \ChirpChat\Model\UserRepository(Database::getInstance()->getConnection());

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
            header('Location:index.php');
        }else{
            header('Location:index.php?action=connexion&error=wrongID');
        }
    }

    public function register() : void{
        if(!$this->isRegisterValid($_POST['username'],$_POST['pseudonyme'], $_POST['email'], $_POST['password'], $_POST['birthdate'])) return;
        (new \ChirpChat\Model\UserRepository(Database::getInstance()->getConnection()))->register($_POST['username'],$_POST['pseudonyme'],$_POST['email'],$_POST['password'],$_POST['birthdate']);
        header("Location:index.php");
    }

    private function createUserSession(string $ID) : void{
        session_start();
        $_SESSION['ID'] = $ID;
    }

    public function displayUserProfile($userID) : void{
        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        (new UserView())->displayUserProfile($userRepo->getUser($userID));
    }

    public function logout() : void{
        session_destroy();
        header("Location:index.php");
    }

    public function isRegisterValid($username, $pseudonyme, $email, $password, $birthdate)
    {
        //a vérifier
        if (strlen($password) < 8) {
            throw new \Exception("Le mot de passe doit contenir au moins 8 caractères.");
        }

        $containsUppercase = false;
        $containsLowercase = false;
        $containsSpecialCharacter = false;
        $containsNumber = false;

        for ($i = 0; $i < strlen($password); ++$i) {
            if (ctype_upper($password[$i])) {
                $containsUppercase = true;
            } elseif (ctype_lower($password[$i])) {
                $containsLowercase = true;
            } elseif ($password[$i] == '~' || $password[$i] == '@' || $password[$i] == '_' || $password[$i] == '/' || $password[$i] == '+' ||
                $password[$i] == ':' || $password[$i] == '*' || $password[$i] == '!') {
                $containsSpecialCharacter = true;
            } elseif (ctype_digit($password[$i])) {
                $containsNumber = true;
            }

            if ($containsUppercase && $containsLowercase && $containsSpecialCharacter && $containsNumber) {
                break;
            }
        }

        if (!$containsUppercase || !$containsLowercase) {
            throw new \Exception("Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.");
        }
        if (!$containsSpecialCharacter) {
            throw new \Exception("Le mot de passe doit contenir au moins un caractère spécial parmi : \"~ , @ , _ , / , + , : , * , !\".");
        }
        if (!$containsNumber) {
            throw new \Exception("Le mot de passe doit contenir au moins un chiffre.");
        }
        //...
        return true;
    }
}