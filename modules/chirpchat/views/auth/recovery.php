<?php

namespace chirpchat\views\auth;
/**
 * Vue pour la page de récupération de mot de passe.
 */
class Recovery {
/**
 * Constructeur de la classe Recovery.
 *
 * @param string $errorMessage Message d'erreur affiché lors de la récupération de mot de passe.
 */
    public function __construct(private string $errorMessage = '') {}
/**
 * Affiche le formulaire de récupération de mot de passe.
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
        ?>

    <form id="loginForm" action="index.php?action=loginUser" method="post">
        <p>
            <br>
            <input id="recoveryChamps" type="text" name="email" placeholder="E-mail de récuperation"> <br> <!-- L'utilisateur rentre son e-mail ici -->

            <br>
            <input id="recoveryChamps" type="text" name="placeholder" placeholder="placeholder"> <br>

            <br>
            <input id="submitRecovery" type="submit" value="Réinitialiser mot de passe"><br> <!-- Bouton pour valider les champs -->

        <?php
        $content = ob_get_clean();

        $styles = array("styles.css");

        (new \ChirpChat\Views\MainLayout("Mot de passe oublié", $content))->show($styles);
    }
}
?>
