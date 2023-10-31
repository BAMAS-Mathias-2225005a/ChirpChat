<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private readonly string $userID, private readonly string $username, private readonly string $email, private readonly string $pseudo, private readonly ?string $description){}

    public function getUserID() : string{
        return htmlspecialchars($this->userID);
    }

    public function getUsername() : string{
        return htmlspecialchars($this->username);
    }

    public function getEmail() : string{
        return htmlspecialchars($this->email);
    }

    public function getPseudo() : string{
        return htmlspecialchars($this->pseudo);
    }

    public function getDescription() : string{
        return htmlspecialchars($this->description);
    }

    public function getProfilPicPath() : string {
        foreach(new \DirectoryIterator('_assets/images/user_pic/') as $userPIC){
            if($userPIC->getFilename() === $this->userID . ".jpg"){
                return '_assets/images/user_pic/' . $this->userID . ".jpg";
            }
        }
        return  "_assets/images/user_pic/default.png";
    }


}
