<?php ?>

<doctype html>
    <html lang="fr">
    <head>
        <!-- Page d'accueil -->
        <title> Connexion </title>
        <link rel="stylesheet" href="style.css"> <!-- CSS -->
        <link href='https://fonts.googleapis.com/css?family=League Spartan' rel='stylesheet'> <!-- Importation font League Spartan -->
    </head>

    <body>
    <img src="Images/Logo.png" alt="Logo" style="width:100px;height:75px;">
    <h1> CONNEXION </h1>

    <form id="form" action="mailto:matteo.sciacca@etu.univ-amu.fr" method="post" enctype="text/plain"> <!-- Mail a laquelle seront envoyées les informations -->
        <p>
            <label for="email">E-mail</label> <br>
            <input id="email" type="text" name="email" value=" "> <br> <!-- L'utilisateur rentre son e-mail ici -->

            <label for="password">Mot de passe</label> <br>
            <input id="password" type="text" name="password" value=" "> <br> <!-- L'utilisateur rentre son mot de passe ici -->

            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
            <p> Se souvenir de moi </p><br>

            <a href="menu.php">SE CONNECTER</a><br>
            <a href="inscription1.php">S'INSCRIRE</a><br>

            <a href="recovery.php">Mot de passe oublié?</a>

        </p>
    </form>

    </html>