<?php

namespace ChirpChat\Controllers;

class HomePage {


    public function execute() : void{
        (new \ChirpChat\Views\HomePage())->show();
    }

}
