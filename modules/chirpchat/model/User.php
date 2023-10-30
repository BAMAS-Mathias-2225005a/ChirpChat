<?php

namespace ChirpChat\Model;

class User{

    public function __construct(private readonly string $userID, private readonly string $username, private readonly string $email, private readonly string $pseudo){}

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

    public function getProfilPic() : string {
        foreach(new \DirectoryIterator('_assets/images/user_pic/') as $userPIC){
            if($userPIC->getFilename() === $this->userID . ".jpg"){
                return '_assets/images/user_pic/' . $this->userID . ".jpg";
            }
        }
        return  "_assets/images/user_pic/default.png";
    }


}
