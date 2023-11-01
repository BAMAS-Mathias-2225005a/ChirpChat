<?php

namespace chirpchat\views\auth;
/**
 * Vue pour la page d'inscription.
 */
class InscriptionView{
    /**
     * Affiche le formulaire d'inscription.
     *
     * @return void
     */
    public function show() : void{
        ob_start();
        ?>
        <form id="registerForm" action="index.php?action=registerUser" method="post">

            <h2 id="inscriptionTitle">INSCRIPTION</h2>

            <label>Nom d'utilisateur
                <input class="inputField" type="text" name="username">
            </label>

            <label>Pseudo
                <input class="inputField" type="text" name="pseudonyme">
            </label>

            <label>Email
                <input class="inputField" type="text" name="email">
            </label>

            <label>Date de naissance
                <input class="inputField" type="date" name="birthdate">
            </label>

            <label>Mot de passe
                <input class="inputField" type="password" name="password">
            </label>

            <input class="authButtons" type="submit" value="S'inscrire">

            <p id="liensLogin"><a href="index.php?action=connexion"> Vous avez déja un compte ? </a></p>
        </form>

        <!-- Background shapes -->
        <svg class="backgroundShapes" style="width: 800px; top: 0%; left: -15%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#72A6D7" d="M38.9,-41.8C52.6,-34.8,67.6,-24.7,72.2,-10.9C76.7,2.8,70.8,20.1,61.1,33.6C51.3,47.1,37.7,56.7,21.8,64.4C5.9,72,-12.2,77.8,-26.1,72.4C-39.9,67.1,-49.4,50.6,-58.3,34.2C-67.1,17.8,-75.3,1.5,-74.9,-15.3C-74.4,-32.2,-65.3,-49.6,-51.4,-56.6C-37.5,-63.6,-18.8,-60.1,-3.1,-56.4C12.6,-52.7,25.1,-48.8,38.9,-41.8Z" transform="translate(100 100)" />
        </svg>

        <svg class="backgroundShapes" style="width: 600px; top: -5%; right: -10%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#325A90" d="M63.2,-39.3C74.2,-17.6,69.8,10.1,56.8,34.2C43.7,58.4,21.8,78.9,2.8,77.3C-16.3,75.7,-32.5,51.9,-41.7,30C-51,8.1,-53.2,-11.9,-45.1,-32.1C-36.9,-52.2,-18.5,-72.4,3.8,-74.6C26.2,-76.8,52.3,-61.1,63.2,-39.3Z" transform="translate(100 100)" />
        </svg>

        <svg class="backgroundShapes" style="width: 1200px; top: 50%; left: 30%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#143762" d="M50.8,-43.4C67.4,-34.2,83.6,-17.1,86.3,2.7C89,22.5,78.3,45,61.7,57.7C45,70.3,22.5,72.9,-0.2,73.1C-22.9,73.3,-45.8,71.1,-58.3,58.5C-70.7,45.8,-72.7,22.9,-71.9,0.8C-71,-21.3,-67.5,-42.6,-55,-51.8C-42.6,-61,-21.3,-58.1,-2.1,-56C17.1,-53.9,34.2,-52.6,50.8,-43.4Z" transform="translate(100 100)" />
        </svg>

        <?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Inscription", $content))->show(['authentification.css']);
    }

}
