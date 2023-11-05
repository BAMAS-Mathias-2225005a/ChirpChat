<?php

namespace Chirpchat\Views\auth;
/**
 * Vue pour la page de connexion.
 */
class LoginView {
    /**
     * Constructeur de la classe LoginView.
     *
     * @param string $errorMessage Message d'erreur affiché lors de la connexion.
     */
    public function __construct(private string $errorMessage = '') {}
    /**
     * Affiche le formulaire de connexion.
     *
     * @return void
     */
    public function show() : void {
        ob_start();
        if(!empty($this->errorMessage)){?>
            <div class="errorMessage">
                <h2><?= $this->errorMessage ?></h2>
            </div><?php
        }
        ?><form id="loginForm" action="index.php?action=loginUser" method="post">
            <h2>CONNEXION</h2>
            <label>Email
                <input class="inputField" type="text" name="email" placeholder="E-mail"> <br> <!-- L'utilisateur rentre son e-mail ici -->
            </label>

            <label>Mot de passe
                <input class="inputField" type="password" name="password" placeholder="Mot de passe"> <br> <!-- L'utilisateur rentre son mot de passe ici -->
            </label>

            <input class="authButtons" type="submit" value="Se connecter"><br> <!-- Bouton pour valider la connexion -->
            <a href="index.php?action=inscription" class="authButtons">S'inscrire</a>

            <a href="index.php?action=recuperation" id="lienForgetPassword">Mot de passe oublié?</a> <!-- Bouton pour aller vers la page pour récupérer le mot de passe -->
        </form>

        <!-- Background shapes -->
        <svg class="backgroundShapes" style="width: 800px; top: 5%; left: -10%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#72A6D7" d="M38.9,-41.8C52.6,-34.8,67.6,-24.7,72.2,-10.9C76.7,2.8,70.8,20.1,61.1,33.6C51.3,47.1,37.7,56.7,21.8,64.4C5.9,72,-12.2,77.8,-26.1,72.4C-39.9,67.1,-49.4,50.6,-58.3,34.2C-67.1,17.8,-75.3,1.5,-74.9,-15.3C-74.4,-32.2,-65.3,-49.6,-51.4,-56.6C-37.5,-63.6,-18.8,-60.1,-3.1,-56.4C12.6,-52.7,25.1,-48.8,38.9,-41.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="backgroundShapes" style="width: 600px; top: -10%; right: 0%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#325A90" d="M50.8,-43.4C67.4,-34.2,83.6,-17.1,86.3,2.7C89,22.5,78.3,45,61.7,57.7C45,70.3,22.5,72.9,-0.2,73.1C-22.9,73.3,-45.8,71.1,-58.3,58.5C-70.7,45.8,-72.7,22.9,-71.9,0.8C-71,-21.3,-67.5,-42.6,-55,-51.8C-42.6,-61,-21.3,-58.1,-2.1,-56C17.1,-53.9,34.2,-52.6,50.8,-43.4Z" transform="translate(100 100)" />
        </svg>

        <svg class="backgroundShapes" style="width: 1200px; top: 40%; left: 30%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#143762" d="M50.8,-43.4C67.4,-34.2,83.6,-17.1,86.3,2.7C89,22.5,78.3,45,61.7,57.7C45,70.3,22.5,72.9,-0.2,73.1C-22.9,73.3,-45.8,71.1,-58.3,58.5C-70.7,45.8,-72.7,22.9,-71.9,0.8C-71,-21.3,-67.5,-42.6,-55,-51.8C-42.6,-61,-21.3,-58.1,-2.1,-56C17.1,-53.9,34.2,-52.6,50.8,-43.4Z" transform="translate(100 100)" />
        </svg>

        <?php
        $content = ob_get_clean();
        (new \chirpchat\views\layout\MainLayout("Connexion", $content))->show(['authentification.css']);
    }
}
?>
