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
        }  else if ($_GET['action'] === 'comment'){
            if(isset($_GET['id'])){
                (new \ChirpChat\Controllers\Comment())->displayComment();
            }
        }  else if ($_GET['action'] === 'search'){
            (new \ChirpChat\Controllers\Post())->searchPost();
        }

        // ---- A BESOIN QUE L'UTILISATEUR SOIT CONNECTÉ ----

        else if (!isset($_SESSION['ID'])){
            header("Location:index.php?action=connexion");
        }
        else if ($_GET['action'] === 'sendPost') {
            (new \ChirpChat\Controllers\Post)->addPost();
        } else if ($_GET['action'] === 'like'){
            (new \ChirpChat\Model\PostRepository(\Chirpchat\Model\Database::getInstance()->getConnection()))->addLike($_GET['id'],$_SESSION['ID']);
            header("Location:index.php#" . $_GET['id']);
        }
        else if ($_GET['action'] === 'addComment') {
            (new \ChirpChat\Controllers\Comment())->addComment();
        }
    }
    else {
        (new \ChirpChat\Controllers\HomePage)->execute();
    }



