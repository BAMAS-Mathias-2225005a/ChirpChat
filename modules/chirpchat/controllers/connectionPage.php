<?php

namespace ChirpChat\Controllers;

use Chirpchat\Views\auth\Login;

class ConnectionPage{

    public function execute() : void {
        if(isset($_GET['error'])){
            switch ($_GET['error']){
                case 'emptyEmail':
                    (new Login("Vous devez entrer un email"))->show();
                    break;
                case 'emptyPassword':
                    (new Login("Vous devez entrer un mot de passe"))->show();
                    break;
                case 'wrongID':
                    (new Login("Les identifiants ne sont pas valides"))->show();
                    break;
            }
        }else{
            (new Login())->show();
        }
    }

}
