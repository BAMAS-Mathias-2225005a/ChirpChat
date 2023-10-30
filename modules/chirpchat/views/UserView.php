<?php

namespace ChirpChat\Views;
use ChirpChat\Model\User;

class UserView{

    public function displayUserProfile(User $user) : void{
        ob_start();
        ?><h2>Profil de <?= $user->getUsername() ?> </h2>
        <a href="index.php?action=privateMessageWith&id=<?= $user->getUserID() ?>"><input id="send" type="button" value="ENVOYER UN MESSAGE"></a>
        <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] === $user->getUserID()) { ?>
            <form action="index.php?action=uploadProfilePicture" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['ID']; ?>">
                <label>Votre fichier</label>
                <input type="file" name="img_upload"> <br>
                <input type="submit" name="img_submit">
            </form> <br>
        <?php } ?>
        <?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Profil de " . $user->getUsername(), $content))->show(['userView.css']);
    }
}
