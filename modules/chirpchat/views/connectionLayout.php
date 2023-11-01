<?php

namespace ChirpChat\Views\HomePage;
/**
 * Class MainLayout
 *
 * Cette classe gère la mise en page principale d'une page web.
 */
class MainLayout {
/**
 * Constructeur de la classe MainLayout.
 *
 * @param string $title   Le titre de la page.
 * @param string $content Le contenu de la page.
 */
public function __construct(private string $title, private string $content) { }
/**
 * Affiche la mise en page de la page web.
 *
 * Cette méthode génère le code HTML de la mise en page de la page web, y compris le titre et le contenu.
 *
 * @return void
 */
public function show() : void {
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->title?></title>
</head>
<body>
<?= $this->content; ?>
</body>
</html>
<?php
}
}