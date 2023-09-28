<?php

    require '_assets/utils/autoloader.php';

    if(filter_input(INPUT_GET, 'action')){
        if($_GET['action'] === 'inscription'){
            (new \ChirpChat\Controllers\Inscription())->execute();
        }
        else if($_GET['action'] === 'connexion'){
            (new \ChirpChat\Controllers\Login())->execute();
        }
        else if($_GET['action'] === 'registerUser'){
            (new \ChirpChat\Controllers\User)->registerUser();
        }    }else{
        (new \ChirpChat\Controllers\Homepage)->execute();
    }

?>

