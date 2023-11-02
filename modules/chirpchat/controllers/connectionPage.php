<?php

namespace ChirpChat\Controllers;

use Chirpchat\Views\auth\LoginView;

/**
 * Contrôleur de la page de connexion.
 */
class ConnectionPage{
    /**
     * Exécute le contrôleur de la page de connexion.
     *
     * Cette méthode vérifie si des erreurs sont présentes dans l'URL, puis en fonction de l'erreur,
     * elle affiche un message d'erreur approprié à l'aide de la vue LoginView. Si aucune erreur n'est
     * présente, elle affiche simplement la page de connexion.
     *
     * @return void
     */
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
