<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private \ChirpChat\Model\Database $connection){ }

    public function isAlreadyRegistered(string $uuid){
        $statement =  $this->connection->getConnection()->prepare("SELECT * FROM Utilisateur WHERE ID= ?");
        $statement->execute([$uuid]);

        return $statement->fetch();

    }

    public function register($username, $pseudonyme, $email, $password, $birthdate) {
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
        if(!$statement = $this->connection->getConnection()->query("INSERT INTO Utilisateur (id_utilisateur, username, pseudonyme, email, mot_passe, date_naissance) 
        VALUES (uuid(), '$username', '$pseudonyme', '$email', '$password', '$birthdate')")){
            throw new \PDOException('erreur sql');
        }
    }
}













