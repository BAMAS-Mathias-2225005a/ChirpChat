<?php

namespace ChirpChat\Controllers;

use Chirpchat\Views\auth\LoginView;

class ConnectionPage{

    public function execute() : void {
        if(isset($_GET['error'])){
            switch ($_GET['error']){
                case 'emptyEmail':
                    (new LoginView("Vous devez entrer un email"))->show();
                    break;
                case 'emptyPassword':
                    (new LoginView("Vous devez entrer un mot de passe"))->show();
                    break;
                case 'wrongID':
                    (new LoginView("Les identifiants ne sont pas valides"))->show();
                    break;
            }
        }else{
            (new LoginView())->show();
        }
    }

}
