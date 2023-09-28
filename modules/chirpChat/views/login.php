<?php

namespace ChirpChat\Views;

class Login {

    public function show() : void {
        ob_start();
        ?><form id="loginForm" action="mailto:matteo.sciacca@etu.univ-amu.fr" method="post" enctype="text/plain"> <!-- Mail a laquelle seront envoyées les informations -->
            <p>
                <label for="email">E-mail</label> <br>
                <input id="email" type="text" name="email" value=" "> <br> <!-- L'utilisateur rentre son e-mail ici -->

                <label for="password">Mot de passe</label> <br>
                <input id="password" type="password" name="password" value=""> <br> <!-- L'utilisateur rentre son mot de passe ici -->

            <div class="form-group">
                <label class="toggle-switch">
                    <input class="toggle-switch-check" type="checkbox" />
                    <span class="toggle-switch-label">Se souvenir de moi</span>
                    <span aria-hidden="true" class="toggle-switch-bar">
                        <span class="toggle-switch-handle" data-label-off="" data-label-on="ON">
                        </span>
                    </span>
                </label>
            </div>

            <input id="submit" type="submit" value="SE CONNECTER"><br> <!-- Bouton pour valider la connexion -->

            <a href="index.php?action=inscription">S'INSCRIRE</a><br> <!-- Bouton pour aller a la page d'inscription  -->

            <a href="index.php?action=recuperation">Mot de passe oublié?</a> <!-- Bouton pour aller vers la page pour récupérer le mot de passe -->

            </p>
        </form><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Connexion", $content))->show();
    }
}
?>
