<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private string $id, private string $username, private string $email){}

    public function getID(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }


}
