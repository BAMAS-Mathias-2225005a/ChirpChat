<?php

namespace ChirpChat\Controllers;

use Chirpchat\Model\Database;
use ChirpChat\Model\PostRepository;
use ChirpChat\Model\UserRepository;
use chirpchat\utils\Notification;
use chirpchat\views\auth\RecoveryPageView;
use ChirpChat\Views\UserView;
/**
 * Contrôleur de gestion des utilisateurs.
 */
class User {

    /**
     * Connecte l'utilisateur et gère la session.
     *
     * Cette méthode vérifie les informations de connexion fournies par l'utilisateur,
     * puis crée une session si les informations sont valides.
     *
     * @return void
     */
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
            Notification::createSuccessMessage("Connecté avec succès");
            header('Location:index.php');
        }else{
            header('Location:index.php?action=connexion&error=wrongID');
        }
    }
    /**
     * Enregistre un nouvel utilisateur.
     *
     * Cette méthode vérifie les informations fournies lors de l'inscription,
     * puis enregistre l'utilisateur si elles sont valides.
     *
     * @return void
     */
    public function register() : void{
        if(!$this->isRegisterValid($_POST['username'],$_POST['pseudonyme'], $_POST['email'], $_POST['password'], $_POST['birthdate'])) return;
        if((new \ChirpChat\Model\UserRepository(Database::getInstance()->getConnection()))->register($_POST['username'],$_POST['pseudonyme'],$_POST['email'],$_POST['password'],$_POST['birthdate'])){
            $userRepo = new \ChirpChat\Model\UserRepository(Database::getInstance()->getConnection());
            $ID = $userRepo->getID($_POST['email'], $_POST['password']);
            $this->createUserSession($ID);

            Notification::createSuccessMessage("Inscription validée");
        }
        header("Location:index.php");
    }
    /**
     * Crée une session pour l'utilisateur.
     *
     * Cette méthode initialise une session et stocke l'ID de l'utilisateur connecté.
     *
     * @param string $ID L'ID de l'utilisateur.
     * @return void
     */
    private function createUserSession(string $ID) : void{
        session_start();
        $_SESSION['ID'] = $ID;
    }
    /**
     * Affiche le profil d'un utilisateur.
     *
     * Cette méthode affiche le profil d'un utilisateur avec ses publications.
     *
     * @param string $userID L'ID de l'utilisateur.
     * @return void
     */
    public function displayUserProfile($userID) : void{
        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        $postRepo = new PostRepository(Database::getInstance()->getConnection());

        $userPost = $postRepo->getUserPost($userID);
        (new UserView())->displayUserProfile($userRepo->getUser($userID), $userPost);
    }
    /**
     * Déconnecte l'utilisateur en mettant fin à la session.
     *
     * Cette méthode met fin à la session en détruisant la session existante.
     *
     * @return void
     */
    public function logout() : void{
        session_destroy();
        header("Location:index.php");
    }
    /**
     * Vérifie si les informations d'inscription sont valides.
     *
     * Cette méthode effectue des vérifications sur les informations d'inscription fournies par l'utilisateur.
     * Elle génère des exceptions en cas d'informations non valides.
     *
     * @param string $username Le nom d'utilisateur.
     * @param string $pseudonyme Le pseudonyme.
     * @param string $email L'adresse e-mail.
     * @param string $password Le mot de passe.
     * @param string $birthdate La date de naissance.
     * @return bool True si les informations sont valides, false sinon.
     * @throws \Exception En cas d'informations non valides.
     */
    public function isRegisterValid($username, $pseudonyme, $email, $password, $birthdate)
    {
        //a vérifier
        if (strlen($password) < 8) {
            Notification::createErrorMessage("Le mot de passe doit contenir au moins 8 caractères.");
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
    /**
     * Modifie le profil de l'utilisateur.
     *
     * Cette méthode permet à l'utilisateur de modifier son profil, y compris le nom d'utilisateur, la description et l'image de profil.
     *
     * @return void
     */
    function modifyProfile() : void{
        if(!isset($_SESSION['ID'])) return;

        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        $user = $userRepo->getUser($_SESSION['ID']);
        $username = $_POST['username'];
        $description = $_POST['description'];

        if(!empty($_FILES['img_upload']['name'])){
            $this->uploadProfilePicture();
        }

        if(!empty($username)){
            $userRepo->setUsername($user, $username);
        }

        if(!empty($description)){
            $userRepo->setDescription($user, $description);
        }

        Notification::createSuccessMessage("Profil modifié avec succès");

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

    public function sendVerificationMail() : void{
        if(!isset($_POST['email'])) return;
        $userEmail = $_POST['email'];
        $code = substr(uniqid(),0,5);
        $subject = '[ChirpChat] Recupération du mot de passe';
        $message = 'Cliquez sur ce lien pour récupérer votre mot de passe : https://chirpchatdev.alwaysdata.net/index.php?action=changePasswordView&code=' . $code . '&email=' . $userEmail;

        $userRepo = new UserRepository(Database::getInstance()->getConnection());
        if($userRepo->doesUserExist($userEmail)){
            mail($userEmail, $subject, $message);
            $userRepo->addVerificationCode($userEmail,$code);
        }else{
            // SEND ERROR
        }

        Notification::createInformationMessage("Email envoyé - Merci de consulter votre boite mail");

        header('Location:index.php');
    }

    public function displayChangePasswordPage() : void{
        if(!isset($_GET['code'])) (new RecoveryPageView())->displayEmailSendView();
        if(!isset($_GET['email'])) (new RecoveryPageView())->displayEmailSendView();
        (new RecoveryPageView())->displayPasswordChangeView($_GET['code'],$_GET['email']);
    }

    public function changePassword() : void{
        if(!isset($_POST['code'])) return;
        if(!isset($_POST['password']) || !isset($_POST['passwordConfirm'])) return;
        if(!isset($_POST['email'])) return;

        if($_POST['password'] != $_POST['passwordConfirm']) return;

        $userRepo = new UserRepository(Database::getInstance()->getConnection());

        if($userRepo->isRecuperationCodeValid($_POST['email'], $_POST['code'])){
            $userRepo->updateUserPassword($_POST['email'], $_POST['password']);
        }

        Notification::createSuccessMessage("Mot de passe changé avec succès");

        header('Location:index.php?action=connexion');
    }

    public function banUser() : void{
        if(!\ChirpChat\Model\User::isSessionUserAdmin()) return;
        if(!isset($_GET['id'])) return;
        (new UserRepository(Database::getInstance()->getConnection()))->deleteUser($_GET['id']);
        header('Location:index.php');
    }



}