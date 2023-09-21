<?php

    require '_assets/utils/autoloader.php';

    if(!isset($_GET['action'])){
        (new \ChirpChat\Controllers\Homepage)->execute();
    }
?>

