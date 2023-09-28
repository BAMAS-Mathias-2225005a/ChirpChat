<?php

namespace chirpChat\views;

class Recovery {

    public function show() : void {
        ob_start();
        ?>

        <?php
        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Mot de passe oublié", $content))->show();
    }
}
?>
