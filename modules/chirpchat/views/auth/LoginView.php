<?php

namespace Chirpchat\Views\auth;

class LoginView {

    public function __construct(private string $errorMessage = '') {}

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
            <a href="index.php?action=inscription"><button class="authButtons">S'inscrire</button></a>

            <a href="index.php?action=recuperation" id="liensLogin">Mot de passe oublié?</a> <!-- Bouton pour aller vers la page pour récupérer le mot de passe -->

            </p>
        </form><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Connexion", $content))->show(['login.css']);
    }
}
?>
