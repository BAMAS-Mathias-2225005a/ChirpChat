<?php ?>

<doctype html>
    <html lang="fr">
    <head>
        <!-- Page d'accueil -->
        <title> Connexion </title>
        <link rel="stylesheet" href="/_assets/styles/styles.css"> <!-- CSS -->
        <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'> <!-- Importation font League Spartan -->
    </head>

    <body>
    <img src="/_assets/images/Logo.png" alt="Logo" style="width:100px;height:75px;"> <!-- Logo -->
    <h1 id="connectionTitle"> CONNEXION </h1>

    <form id="loginForm" action="mailto:matteo.sciacca@etu.univ-amu.fr" method="post" enctype="text/plain"> <!-- Mail a laquelle seront envoyées les informations -->
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

        <a href="menu.php">SE CONNECTER</a><br> <!-- Bouton pour valider la connexion -->
        <a href="inscription1.php">S'INSCRIRE</a><br> <!-- Bouton pour aller a la page d'inscription  -->

        <a href="recovery.php">Mot de passe oublié?</a> <!-- Bouton pour aller vers la page pour récupérer le mot de passe -->

        </p>
    </form>

    </html>