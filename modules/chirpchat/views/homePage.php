<?php

namespace ChirpChat\Views;

class HomePage {

    public function show(array $postList) : void {
        ob_start();

?><h1>Dernier commentaire : </h1>
<h2><a href="index.php?action=inscription">INSCRIPTION</a></h2>
<h2><a href="index.php?action=connexion">LOGIN</a></h2>
        <?php if(isset($_SESSION['ID'])){
            echo "<h2>" . $_SESSION['ID'] . "</h2>";
        }?>
        <div id="postList">
    <?php foreach($postList as $post){
?>  <div class="post">
        <div id="postHeader">
            <img alt="author profile picture" id="profilePicture" src="https://cdn-icons-png.flaticon.com/512/436/436299.png" />
            <div id="authorInfo">
                <h2> PSEUDO </h2>
                <h3> Prénom </h3>
            </div>
        </div>
        <div id="postContent">
            <p>
                <?php echo $post->message?>
            </p>
        </div>
        <div id="postFooter">
            <div>
                <img alt="hearth image" src="https://static-00.iconduck.com/assets.00/heart-icon-512x441-zviestnn.png"/>
                <p>500</p>
            </div>
            <div><img alt="comment image" src="https://icon-library.com/images/speech-bubble-icon/speech-bubble-icon-13.jpg"/>
                <p>500</p>
            </div>
        </div>
    </div><?php } ?>
</div><?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Accueil", $content))->show();
    }
}
