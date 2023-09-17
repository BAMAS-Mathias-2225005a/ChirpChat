<?php

namespace ChirpChat\Views;

class HomePage {

    public function show() : void {
        (new \ChirpChat\Views\MainLayout("Acceuil", ""))->show();
    }
}
