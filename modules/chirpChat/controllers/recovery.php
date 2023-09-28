<?php

namespace chirpChat\controllers;

class Recovery {

    public function execute() : void {
        (new \ChirpChat\Views\Recovery())->show();
    }
}
