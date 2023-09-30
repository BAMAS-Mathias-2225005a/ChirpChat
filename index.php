<?php

    require '_assets/includes/autoloader.php';

    if(filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'inscription') {
            (new \ChirpChat\Controllers\Inscription())->execute();
        } else if ($_GET['action'] === 'connexion') {
            (new \ChirpChat\Controllers\ConnectionPage())->execute();
        } else if ($_GET['action'] === 'recuperation') {
            (new \ChirpChat\Controllers\Recovery())->execute();
        } else if ($_GET['action'] === 'registerUser') {
            (new \ChirpChat\Controllers\user)->registerUser();
        } else if ($_GET['action'] === 'loginUser') {
            (new \ChirpChat\Controllers\User)->login();
        }
    }
    else {
        (new \ChirpChat\Controllers\HomePage)->execute();
    }



