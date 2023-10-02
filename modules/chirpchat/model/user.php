<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private string $id, private string $username, private string $email, private string $pseudo){}

    public function getID(){
        return htmlspecialchars($this->id);
    }

    public function getUsername(){
        return htmlspecialchars($this->username);
    }

    public function getEmail(){
        return htmlspecialchars($this->email);
    }

    public function getPseudo() : string{
        return htmlspecialchars($this->pseudo);
    }


}
