<?php
    require 'navbar.php';
    startPage('Accueil');
?>

<main>
    <h2>INSCRIPTION 1/2</h2>

    <form>
        <div class="champ-saisie">
            <h3>Pseudo</h3>
            <input type="text">
        </div>

        <div class="champ-saisie">
            <h3>E-mail</h3>
            <input type="text">
        </div>

        <div class="champ-saisie">
            <h3>Mot de passe</h3>
            <input type="password">
        </div>

        <div class="champ-saisie">
            <h3>Confirmer mot de passe</h3>
            <input type="password">
        </div>

        <input type="button" value="SUIVANT" id="btnSuivant">
    </form>

    <p id="loginPageLink"><a href="lienPageLogin"> Vous avez déja un compte ? </a></p>

    <svg width="1080" height="145" viewBox="0 0 1080 145" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M751.961 32.3728C948.981 -66.2328 1134 91.8762 1134 91.8762V477.798L-207.636 505L-257.606 73.1944C-293.212 61.5776 -301.999 50.801 -259.641 55.6075L-257.606 73.1944C-192.635 94.3918 -38.3701 118.387 57.3907 55.6075C205.631 -41.5768 386.924 21.0388 444.43 40.3066C501.936 59.5744 554.941 130.978 751.961 32.3728Z" fill="#6887D5" fill-opacity="0.33"/>
    </svg>
</main>

