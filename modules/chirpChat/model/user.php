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
        if(!$statement = $this->connection->getConnection()->query("INSERT INTO Utilisateur (id_utilisateur, username, pseudonyme, email, mot_passe, date_naissance) 
        VALUES (uuid(), '$username', '$pseudonyme', '$email', '$password', '$birthdate'")){
            throw new \PDOException('erreur sql');
        }
    }

    public function getUserName($uuid){

    }





}







