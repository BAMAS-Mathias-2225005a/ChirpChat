<?php

namespace ChirpChat\Controllers;

class Inscription{

    public function execute() : void{
        (new \ChirpChat\Views\Inscription())->show();
    }

}
