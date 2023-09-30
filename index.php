<?php

    require '_assets/includes/autoloader.php';

    session_start();

    if(filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'inscription') {
            (new \ChirpChat\Controllers\Inscription())->execute();
        } else if ($_GET['action'] === 'connexion') {
            (new \ChirpChat\Controllers\ConnectionPage())->execute();
        } else if ($_GET['action'] === 'recuperation') {
            (new \ChirpChat\Controllers\Recovery())->execute();
        } else if ($_GET['action'] === 'registerUser') {
            (new \ChirpChat\Controllers\User)->register();
        } else if ($_GET['action'] === 'loginUser') {
            (new \ChirpChat\Controllers\User)->login();
        } else if ($_GET['action'] === 'sendPost') {
            (new \ChirpChat\Controllers\Post)->addPost();
        }
    }
    else {
        (new \ChirpChat\Controllers\HomePage)->execute();
    }



