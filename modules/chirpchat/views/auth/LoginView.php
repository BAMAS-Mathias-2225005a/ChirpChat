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
            <p>
                <br>
                <input id="loginChamps" type="text" name="email" placeholder="E-mail"> <br> <!-- L'utilisateur rentre son e-mail ici -->

                <br>
                <input id="loginChamps" type="password" name="password" placeholder="Mot de passe"> <br> <!-- L'utilisateur rentre son mot de passe ici -->

             <br>
            <div class="form-group">
                <label class="toggle-switch">
                    <input class="toggle-switch-check" type="checkbox" />
                    <span class="toggle-switch-label">Se souvenir de moi</span>
                    <span aria-hidden="true" class="toggle-switch-bar">
                        <span class="toggle-switch-handle" data-label-off="" data-label-on="ON">
                        </span>
                    </span>
                </label>
            </div> <br>

            <input id="submit" type="submit" value="SE CONNECTER"><br> <!-- Bouton pour valider la connexion -->

            <a href="index.php?action=inscription" id="liensLogin">S'INSCRIRE</a> <!-- Bouton pour aller a la page d'inscription  -->

            <a href="index.php?action=recuperation" id="liensLogin">Mot de passe oublié?</a> <!-- Bouton pour aller vers la page pour récupérer le mot de passe -->

            </p>
        </form><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Connexion", $content))->show();
    }
}
?>
