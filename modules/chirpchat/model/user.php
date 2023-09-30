<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private \PDO $connection){ }

    public function doesUserExist(string $email) : bool{
        $statement = $this->connection->prepare("SELECT * FROM Utilisateur WHERE EMAIL= ?");
        $statement->execute([$email]);
        return $statement->fetch();
    }

    public function isUserIdValid(string $email, string $password) : bool{
        if(!$this->doesUserExist($email)) return false;
        $statement = $this->connection->prepare("SELECT password FROM Utilisateur WHERE EMAIL = ?");
        $statement->execute([$email]);
        return password_verify($password, $statement->fetch());
    }

    public function register($username, $pseudonyme, $email, $password, $birthdate) : void{
        if(!$statement = $this->connection->getConnection()->query("INSERT INTO Utilisateur (id_utilisateur, username, pseudonyme, email, mot_passe, date_naissance) 
        VALUES (uuid(), '$username', '$pseudonyme', '$email', '$password', '$birthdate'")){
            throw new \PDOException('erreur sql');
        }
    }

    public function getID(string $email, $password) : string{
        if(!$this->isUserIdValid($email, $password)){
            require '_assets/exception/UserDoesNotExistException.php';
        }

        $statement = $this->connection->prepare("SELECT ID FROM Utilisateur WHERE EMAIL = ? AND PASSWORD = ?");
        $statement->execute([$email, $password]);

        return $statement->fetch()['ID'];

    }

    public function getUserName($uuid){

    }





}







