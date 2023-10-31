<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Post;
use ChirpChat\Model\User;

class UserView{

    /**
     * @param User $user
     * @param Post[] $userPostList
     * @return void
     */
    public function displayUserProfile(User $user, array $userPostList) : void{
        ob_start();
        ?>
        <div id="profile-page-container">
            <header id="profile-page-header">
                <img id="profile-picture" alt="profile picture" src="<?= $user->getProfilPicPath() ?>">
                <h2><?= $user->getUsername() ?></h2>

                <div id="profile-buttons">
                    <a href="index.php?action=privateMessageWith&id=<?= $user->getUserID() ?>"><input id="send-message-button" type="button" value="Message"></a>
                    <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] === $user->getUserID())
                        {
                            echo '<input type="button" value="Modifier Profil" onclick="openUserSettings()"></input>';
                        }
                    /*if(isset($_SESSION['ID']) && $_SESSION['ID'] === $user->getUserID()) { ?>
                        <form action="index.php?action=uploadProfilePicture" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['ID']; ?>">
                            <label>Votre fichier</label>
                            <input type="file" name="img_upload"> <br>
                            <input type="submit" name="img_submit">
                        </form> <br>
                    <?php } */?>
                </div>

                <p><?= $user->getDescription() ?></p>
            </header>

            <script src="/_assets/js/userProfile.js"></script>
            <div id="profile-settings-menu">
                <svg id='close-settings' onclick="closeUserSettings()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <form method="post" action="index.php?action=modifyProfile" enctype="multipart/form-data">
                    <h3>Modifier le profil</h3>
                    <label>Pseudo
                        <input type="text" value="<?= $user->getUsername() ?>" class="inputField" name="username">
                    </label>

                    <label>Description
                        <textarea class="inputField" name="description"><?= $user->getDescription() ?></textarea>
                    </label>

                    <label>Photo de profil
                        <input type="file" name="img_upload">
                    </label>

                    <input type="submit" name="img_submit" value="Modifier" class="authButtons">
                </form>
            </div>

            <?php

            foreach($userPostList as $post){
                (new PostView($post))->show();
            }
        ?>
        </div>
        <?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Profil de " . $user->getUsername(), $content))->show(['profile.css', 'post.css']);
    }
}
