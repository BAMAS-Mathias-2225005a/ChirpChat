<?php

namespace ChirpChat\Model;

class UserRepository{

    public function __construct(private \PDO $connection){ }

    public function doesUserExist(string $email) : bool{
        $statement = $this->connection->prepare("SELECT * FROM Utilisateur WHERE EMAIL= ?");
        $statement->execute([$email]);
        if($statement->fetch()) return true;
        return false;
    }

    public function isUserIdValid(string $email, string $password) : bool{
        if(!$this->doesUserExist($email)) return false;
        $statement = $this->connection->prepare("SELECT password FROM Utilisateur WHERE EMAIL = ?");
        $statement->execute([$email]);
        return password_verify($password, $statement->fetch()['password']);
    }

    public function register($username, $pseudonyme, $email, $password, $birthdate) : void{
        if($this->doesUserExist($email)); //ERREUR
        $statement = $this->connection->prepare("INSERT INTO Utilisateur VALUES (?, ?, ?, ?, ?, ?, NULL, ?, ? )" );
        $statement->execute([uniqid(),$email,$username, $pseudonyme, password_hash($password,PASSWORD_BCRYPT), $birthdate,  date('Y-m-d H:i:s'),  date('Y-m-d H:i:s')]);
    }

    public function getID(string $email, $password) : string{
        if(!$this->isUserIdValid($email, $password)){
            require '_assets/exception/UserDoesNotExistException.php';
        }

        $statement = $this->connection->prepare("SELECT ID FROM Utilisateur WHERE EMAIL = ?");
        $statement->execute([$email]);
        return $statement->fetch()['ID'];
    }

    public function getUser(string $id) : ?user {
        $statement = $this->connection->prepare("SELECT EMAIL, USERNAME, PSEUDONYME, DESCRIPTION FROM Utilisateur WHERE ID = ?");
        $statement->execute([$id]);

        if($row = $statement->fetch()){
            return new User($id, $row['USERNAME'], $row['EMAIL'], $row['PSEUDONYME'], $row['DESCRIPTION']);
        }
        return null;
    }

    public function setUsername(User $user, string $newUsername) : void{
        $statement = $this->connection->prepare("UPDATE Utilisateur SET USERNAME=? WHERE ID=?");
        $statement->execute([$newUsername, $user->getUserID()]);
    }

    public function setDescription(User $user, string $newDescription) : void{
        $statement = $this->connection->prepare("UPDATE Utilisateur SET DESCRIPTION=? WHERE ID=?");
        $statement->execute([$newDescription, $user->getUserID()]);
    }



    public function getUserName($uuid){

    }





}







