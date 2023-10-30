<?php

if(isset($_POST['img_submit'])) {
    $user_id = $_POST['user_id'];
    $file = $_FILES['img_upload'];
    $fileName = $_FILES['img_upload']['name'];
    $fileTmpName = $_FILES['img_upload']['tmp_name'];
    $fileSize = $_FILES['img_upload']['size'];
    $newFileName = $user_id . ".jpg";
    $fileExtension = explode('.', $fileName);
    $ActualFileExension = strtolower(end($fileExtension));

    if($fileSize > 2097152) {
        echo "L'image est trop volumineuse. La taille maximale autorisée est 2 Mo.";
        exit();
    }
    if($ActualFileExension !== 'jpg'){
        echo "L'image doit être sous format jpg.";
        exit();
    }

    $uploadDir = '/home/devchirpchat/www/_assets/images/user_pic/';

    if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
        echo "Image de profile changée !";
    } else {
        echo "Une erreur s'est produite lors de l'upload de l'image." . "<br>";
    }
}