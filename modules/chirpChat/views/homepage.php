<?php

namespace ChirpChat\Views;

class HomePage {

    public function show() : void {
        ob_start();

?><h1>Dernier commentaire : </h1>
<div id="postList">
    <?php for($i = 0; $i < 15; $i++){
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
        </div>
        <div id="postFooter">
            <div>
                <img alt="hearth image" src="https://image.freepik.com/icones-gratis/como-simbolo-do-coracao-de-ios-interface-de-7_318-36651.jpg"/>
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
