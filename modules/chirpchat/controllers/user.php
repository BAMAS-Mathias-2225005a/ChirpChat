<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;
use ChirpChat\Model\PostRepository;
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
        $postRepo = new PostRepository(Database::getInstance()->getConnection());

        $userPost = $postRepo->getUserPost($userID);

        (new UserView())->displayUserProfile($userRepo->getUser($userID), $userPost);
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

    function modifyProfile() : void{
        if(!isset($_SESSION['ID'])) return;

        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        $user = $userRepo->getUser($_SESSION['ID']);
        $username = $_POST['username'];
        $description = $_POST['description'];

        if(isset($_POST['img_submit'])){
            $this->uploadProfilePicture();
        }

        if(!empty($username)){
            $userRepo->setUsername($user, $username);
        }

        if(!empty($description)){
            $userRepo->setDescription($user, $description);
        }

        header('Location:index.php?action=profile&id=' . $_SESSION['ID']);

    }
    function uploadProfilePicture() : void{
        $user_id = $_SESSION['ID'];
        $file = $_FILES['img_upload'];
        $fileName = $_FILES['img_upload']['name'];
        $fileTmpName = $_FILES['img_upload']['tmp_name'];
        $fileSize = $_FILES['img_upload']['size'];
        $newFileName = $user_id . ".jpg";
        $fileExtension = explode('.', $fileName);
        $ActualFileExtension = strtolower(end($fileExtension));

        if($fileSize > 2097152) {
            echo "L'image est trop volumineuse. La taille maximale autorisée est 2 Mo.";
            exit();
        }
        if($ActualFileExtension !== 'jpg'){
            echo "L'image doit être sous format jpg.";
            exit();
        }

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/_assets/images/user_pic/';

        if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
            echo "Image de profile changée !";
        } else {
            echo "Une erreur s'est produite lors de l'upload de l'image." . "<br>";
        }
    }



}