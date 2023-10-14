<?php

namespace ChirpChat\Views;
use ChirpChat\Model\User;

class UserView{

    public function displayUserProfile(User $user){
        ob_start();
        ?><h2>Profil de <?= $user->getUsername() ?> </h2>
        <a href="index.php?action=privateMessageWith&id=<?= $user->getUserID() ?>"><input type="button" value="ENVOYER UN MESSAGE"></a>
        <?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Profil de" . $user->getUsername(), $content))->show([]);
    }
}
