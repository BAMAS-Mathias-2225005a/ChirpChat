<?php

namespace ChirpChat\Controllers;

class Inscription{

    public function execute() : void{
        (new \chirpchat\views\auth\Inscription())->show();
    }

}
