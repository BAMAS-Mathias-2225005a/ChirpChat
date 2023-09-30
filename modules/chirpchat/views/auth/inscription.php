<?php

namespace chirpchat\views\auth;

class Inscription{

    public function show() : void{
        ob_start();
        ?><main>

            <form action="index.php?action=registerUser" method="post">

                <h2 id="inscriptionTitle">INSCRIPTION</h2>

                <div class="champ-saisie">
                    <input placeholder="Nom d'utilisateur" type="text" name="username">
                </div>

                <div class="champ-saisie">
                    <input placeholder="Pseudo" type="text" name="pseudonyme">
                </div>

                <div class="champ-saisie">
                    <input placeholder="E-mail" type="text" name="email">
                </div>

                <div class="champ-saisie">
                    <input placeholder="Date de naissance" type="date" name="birthdate">
                </div>

                <div class="champ-saisie">
                    <input placeholder="Mot de passe" type="password" name="password">
                </div>

                <div class="champ-saisie">
                    <input placeholder="Confirmer mot de passe" type="password">
                </div>

                <input type="submit" value="SUIVANT" id="btnSuivant">
            </form>

            <p id="loginPageLink"><a href="index.php?action=connexion"> Vous avez déja un compte ? </a></p>

            <svg width="1080" height="145" viewBox="0 0 1080 145" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M751.961 32.3728C948.981 -66.2328 1134 91.8762 1134 91.8762V477.798L-207.636 505L-257.606 73.1944C-293.212 61.5776 -301.999 50.801 -259.641 55.6075L-257.606 73.1944C-192.635 94.3918 -38.3701 118.387 57.3907 55.6075C205.631 -41.5768 386.924 21.0388 444.43 40.3066C501.936 59.5744 554.941 130.978 751.961 32.3728Z" fill="#6887D5" fill-opacity="0.33"/>
            </svg>
        </main><?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Inscription 1/2", $content))->show();
    }

}
