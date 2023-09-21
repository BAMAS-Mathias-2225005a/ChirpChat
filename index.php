<?php

    require '_assets/utils/autoloader.php';

    if(filter_input(INPUT_GET, 'action')){
        if($_GET['action'] === 'inscription'){
            (new \ChirpChat\Controllers\Inscription())->execute();
        }
    }else{
        (new \ChirpChat\Controllers\Homepage)->execute();
    }

?>

