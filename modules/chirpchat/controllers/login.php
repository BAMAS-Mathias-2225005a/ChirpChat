<?php

namespace ChirpChat\Controllers;
/**
 * Contrôleur de la page de connexion.
 */
class Login{
    /**
     * Exécute le contrôleur de la page de connexion.
     *
     * Cette méthode affiche la page de connexion en utilisant la vue LoginView.
     *
     * @return void
     */
    public function execute() : void {
        (new \ChirpChat\Views\auth\LoginView())->show();
    }
}