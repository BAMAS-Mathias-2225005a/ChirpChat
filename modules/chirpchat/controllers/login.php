<?php

namespace ChirpChat\Controllers;
class Login{

    public function execute() : void {
        (new \ChirpChat\Views\auth\LoginView())->show();
    }
}