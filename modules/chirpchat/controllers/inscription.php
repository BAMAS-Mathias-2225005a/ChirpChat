<?php

namespace ChirpChat\Controllers;
/**
 * Contrôleur de la page d'inscription.
 */
class Inscription{
    /**
     * Exécute le contrôleur de la page d'inscription.
     *
     * Cette méthode affiche la page d'inscription en utilisant la vue InscriptionView.
     *
     * @return void
     */
    public function execute() : void{
        (new \chirpchat\views\auth\InscriptionView())->show();
    }

}
