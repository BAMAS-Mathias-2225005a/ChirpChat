<?php

namespace chirpChat\controllers;

class Recovery {

    public function execute() : void {
        (new \chirpchat\views\auth\Recovery())->show();
    }
}
