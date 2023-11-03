<?php

namespace chirpChat\controllers;
/**
 * Contrôleur de la page de récupération de mot de passe.
 */
class Recovery {

    /**
     * Exécute le contrôleur de la page de récupération de mot de passe.
     *
     * Cette méthode affiche la page de récupération de mot de passe en utilisant la vue Recovery.
     *
     * @return void
     */
    public function execute() : void {
        (new \chirpchat\views\auth\RecoveryPageView())->displayEmailSendView();
    }
}
